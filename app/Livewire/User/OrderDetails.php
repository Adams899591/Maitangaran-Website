<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderDetails extends Component
{
    public string $invoiceId = '';
    public ?array $orderData = null;
    public bool $isLoading = true;
    public bool $isCancelling = false;
    public ?array $shipmentData = null; // Add this property at the top with other public properties


    public function mount(?string $InvoiceID = null): void
    {
        // Get parameters from route or query string
        $this->invoiceId = $InvoiceID ?? request()->query('InvoiceID', '');
        $reference = request()->query('reference');

        // 1. If Paystack redirected back with a reference parameter, verify payment
        if ($reference) {
            $this->verifyPayment($reference);
        }

        // 2. Fetch latest order and status details
        if ($this->invoiceId) {
            $this->fetchOrderDetails();
            $this->fetchStatusNote();
        } else {
            $this->isLoading = false;
        }
    }

    protected function verifyPayment(string $reference): void
    {

        $baseUrl = config('services.ecommerce.url');

        try {
            // According to docs: GET /payment/verify is PUBLIC and exempt from X-Api-Key
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->get("{$baseUrl}/payment/verify", [
                'reference' => $reference,
            ]);

            $data = $response->json();

            Log::info($data);

            if ($response->successful()) {
                session()->flash('success', 'Payment verified successfully!');
            } else {
                session()->flash('error', $data['Message'] ?? $data['message'] ?? 'Payment verification failed.');
            }
        } catch (\Throwable $th) {
            Log::error('Payment Verification Error: ' . $th->getMessage());
        }
    }


    public function fetchStatusNote(): void
    {
        $token = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey = config('services.ecommerce.api');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'X-Api-Key'     => $apiKey,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->get("{$baseUrl}/orders/{$this->invoiceId}/status-note");

            $data = $response->json();

            if ($response->successful() && ($data['Success'] ?? false) === true) {
                // Parse the JSON string contained inside 'Data'
                $this->shipmentData = is_string($data['Data'] ?? null) 
                    ? json_decode($data['Data'], true) 
                    : ($data['Data'] ?? null);
            }
        } catch (\Throwable $th) {
            Log::error('Fetch Status Note Error: ' . $th->getMessage());
        }
    }


    public function fetchOrderDetails(): void
    {
        $token = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey = config('services.ecommerce.api');

        if (!$token || !$this->invoiceId) {
            $this->orderData = null;
            $this->isLoading = false;
            return;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'X-Api-Key'     => $apiKey,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->get("{$baseUrl}/orders/{$this->invoiceId}");

            $data = $response->json();
            Log::info($data);

            if ($response->successful() && ($data['Success'] ?? false) === true) {
                $this->orderData = $data['Data'] ?? null;
            } else {
                $this->orderData = null;
            }
        } catch (\Throwable $th) {
            $this->orderData = null;
        } finally {
            $this->isLoading = false;
        }
    }

    public function payNow()
    {
        if (!$this->invoiceId || !$this->orderData) return;

        $token   = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey  = config('services.ecommerce.api');

        try {
            // Success & Failure redirect URL back to this Livewire route
            $redirectUrl = route('orders-details', ['InvoiceID' => $this->invoiceId]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'X-Api-Key'     => $apiKey,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->post("{$baseUrl}/payment/initialize", [
                'invoiceID'  => $this->invoiceId, 
                'successUrl' => $redirectUrl,
                'failureUrl' => $redirectUrl,
            ]);

            $data = $response->json();

            Log::info($data);

            if ($response->successful() && ($data['Success'] ?? $data['success'] ?? false) === true) {
                $authUrl = $data['Data']['AuthorizationUrl'] 
                    ?? $data['Data']['authorizationUrl'] 
                    ?? $data['authorizationUrl'] 
                    ?? null;

                if ($authUrl) {
                    // Redirect user to Paystack payment gateway
                    return redirect()->away($authUrl);
                }

                session()->flash('error', 'Authorization URL not found.');
            } else {
                session()->flash('error', $data['Message'] ?? $data['message'] ?? 'Could not initialize payment.');
            }
        } catch (\Throwable $th) {
            Log::error('Pay Now Error: ' . $th->getMessage());
            session()->flash('error', 'Failed to start checkout process.');
        }
    }


    public function cancelOrder()
    {
        if (!$this->orderData) return;

        $status = $this->orderData['Status'] ?? null;
        $total = $this->orderData['Total'] ?? 0;
        $amountPaid = $this->orderData['AmountPaid'] ?? 0;

        if ($status === 0) {
            session()->flash('error', 'This order is already cancelled.');
            return;
        }

        if ($amountPaid >= $total && $total > 0) {
            session()->flash('error', 'Paid orders cannot be cancelled.');
            return;
        }

        if ($status === 2) {
            session()->flash('error', 'Orders already processing cannot be cancelled.');
            return;
        }

        $token = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey = config('services.ecommerce.api');

        $this->isCancelling = true;

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'X-Api-Key'     => $apiKey,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->put("{$baseUrl}/orders/{$this->invoiceId}/cancel");

            $data = $response->json();

            if ($response->successful() && ($data['Success'] ?? false) === true) {
                $this->orderData['Status'] = 0;
                session()->flash('success', $data['Message'] ?? 'Order has been cancelled.');
                return redirect()->route('order-ladger');
            } else {
                session()->flash('error', $data['Message'] ?? 'Failed to cancel order.');
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Failed to cancel order. Please try again later.');
        } finally {
            $this->isCancelling = false;
        }
    }

    public function render()
    {
        return view('livewire.user.order-details')->layout("layouts.user.app");
    }
}