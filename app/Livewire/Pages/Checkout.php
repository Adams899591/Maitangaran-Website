<?php

// namespace App\Livewire\Pages;

// use Livewire\Component;

// class Checkout extends Component
// {
//     public function render()
//     {
//         return view('livewire.pages.checkout')->layout("layouts.pages.app");
//     }
// }










// namespace App\Livewire\Pages;

// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Log;
// use Livewire\Component;

// class Checkout extends Component
// {


//     public function render()
//     {
//         return view('livewire.pages.checkout')->layout('layouts.pages.app');
//     }
// }





namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Checkout extends Component
{
    public array $shippingRates = [];
    public string $shippingRequestToken = '';
    public string $selectedCourierId = '';
    public string $notes = '';
    public bool $isLoading = true;

    public function mount()
    {
        $this->fetchShippingRates();
    }

    /**
     * Fetch live courier rates (GET /shipping/rates)
     */
    public function fetchShippingRates()
    {
        $this->isLoading = true;

        $token   = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey  = config('services.ecommerce.api');

        if (!$token) {
            session()->flash('error', 'Please log in to view checkout rates.');
            return redirect()->route('login');
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'X-Api-Key'     => $apiKey,
                'Accept'        => 'application/json',
            ])->get("{$baseUrl}/shipping/rates");

            $data = $response->json();

            if ($response->successful() && ($data['success'] ?? $data['Success'] ?? false)) {
                $rateData                   = $data['data'] ?? $data['Data'] ?? [];
                $this->shippingRequestToken = $rateData['requestToken'] ?? $rateData['RequestToken'] ?? '';
                $this->shippingRates        = $rateData['options'] ?? $rateData['Options'] ?? [];

                // Pre-select the first courier option if available
                if (!empty($this->shippingRates)) {
                    $this->selectedCourierId = (string) ($this->shippingRates[0]['courierId'] ?? '');
                }
            } else {
                $msg = $data['message'] ?? $data['Message'] ?? 'Unable to fetch shipping rates.';
                session()->flash('error', $msg);
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching shipping rates: ' . $th->getMessage());
            session()->flash('error', 'Server error while loading shipping rates.');
        } finally {
            $this->isLoading = false;
        }
    }

    /**
     * Complete Order / Convert Cart to Invoice (POST /checkout)
     */
    public function processCheckout()
    {
        if (empty($this->selectedCourierId)) {
            $this->addError('selectedCourierId', 'Please select a courier to continue.');
            return;
        }

        // Find selected courier array data
        $selectedCourier = collect($this->shippingRates)->firstWhere('courierId', $this->selectedCourierId);

        if (!$selectedCourier) {
            $this->addError('selectedCourierId', 'Invalid courier selection.');
            return;
        }

        $token   = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey  = config('services.ecommerce.api');

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'X-Api-Key'     => $apiKey,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->post("{$baseUrl}/checkout", [
                'notes'                => trim($this->notes),
                'shippingRequestToken' => $this->shippingRequestToken,
                'shippingServiceCode'  => $selectedCourier['serviceCode'] ?? '',
                'shippingCourierId'    => (string) $selectedCourier['courierId'],
                'shippingFee'          => (float) ($selectedCourier['total'] ?? 0),
            ]);

            $data = $response->json();

            if ($response->successful() && ($data['success'] ?? $data['Success'] ?? false)) {
                session()->flash('message', 'Checkout successful!');
                
                // Redirect to orders or invoice page
                return redirect()->route('orders');
            } else {
                $msg = $data['message'] ?? $data['Message'] ?? 'Checkout failed. Please try again.';
                $this->addError('shipping', $msg);
            }
        } catch (\Throwable $th) {
            Log::error('Error processing checkout: ' . $th->getMessage());
            $this->addError('shipping', 'Unable to process checkout. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.pages.checkout')->layout('layouts.pages.app');
    }
}