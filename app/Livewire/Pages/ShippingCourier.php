<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShippingCourier extends Component
{

    public array $shippingRates = [];
    public string $shippingRequestToken = '';
    public string $selectedCourierId = '';
    public string $notes = '';
    // public bool $isLoading = true;

    public function mount()
    {
        // Check for session token before firing requests
        if (!session()->has('api_token')) {
            session()->flash('error', 'Please log in to view checkout rates.');
            $this->redirectRoute('login');
            return;
        }

        // $this->fetchShippingDetails();
        $this->fetchShippingRates();
    }

    /**
     * Fetch live courier rates (GET /shipping/rates)
     */
    public function fetchShippingRates(): void
    { 

        $token   = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey  = config('services.ecommerce.api');


        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'X-Api-Key'     => $apiKey,
                'Content-Type'  => 'application/json',         
            ])->withoutVerifying()->get("{$baseUrl}/shipping/rates");

            $data = $response->json();

            // Log::info($data);

            $isSuccess = $data['Success'] ?? $data['success'] ?? false;

            if ($response->successful() && $isSuccess) {
                $rateData = $data['Data'] ?? $data['data'] ?? [];
                
                $this->shippingRequestToken = $rateData['RequestToken'] 
                    ?? $rateData['requestToken'] 
                    ?? '';

                $rawOptions = $rateData['Options'] 
                    ?? $rateData['options'] 
                    ?? [];

                // Normalize options array
                $this->shippingRates = collect($rawOptions)->map(function ($item) {
                    return [
                        'serviceCode'     => $item['ServiceCode'] ?? $item['serviceCode'] ?? '',
                        'courierId'       => (string) ($item['CourierId'] ?? $item['courierId'] ?? ''),
                        'courierName'     => $item['CourierName'] ?? $item['courierName'] ?? '',
                        'courierImage'    => $item['CourierImage'] ?? $item['courierImage'] ?? '',
                        'total'           => (float) ($item['Total'] ?? $item['total'] ?? 0),
                        'vat'             => (float) ($item['Vat'] ?? $item['vat'] ?? 0),
                        'deliveryEta'     => $item['DeliveryEta'] ?? $item['deliveryEta'] ?? 'N/A',
                        'requiresWaybill' => $item['RequiresWaybill'] ?? $item['requiresWaybill'] ?? false,
                        'isCodAvailable'  => $item['IsCodAvailable'] ?? $item['isCodAvailable'] ?? false,
                    ];
                })->all();

                if (!empty($this->shippingRates)) {
                    $this->selectedCourierId = $this->shippingRates[0]['courierId'];
                }
            } else {
                $msg = $data['Message'] ?? $data['message'] ?? 'Unable to fetch shipping rates.';
                session()->flash('error', $msg);
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            Log::error('Error fetching shipping rates: ' . $th->getMessage());
            session()->flash('error', 'Server error while loading shipping rates.');
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

        $selectedCourier = collect($this->shippingRates)->firstWhere('courierId', $this->selectedCourierId);

        if (!$selectedCourier) {
            $this->addError('selectedCourierId', 'Invalid courier selection.');
            return;
        }

        $token   = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey  = config('services.ecommerce.api');

        $payload = [
            'Notes'                => trim($this->notes),
            'shippingRequestToken' => $this->shippingRequestToken,
            'shippingServiceCode'  => $selectedCourier['serviceCode'],
            'shippingCourierId'    => (string) $selectedCourier['courierId'],
            'shippingFee'          => (float) $selectedCourier['total'],
        ];

        Log::info($payload);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'X-Api-Key'     => $apiKey,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->post("{$baseUrl}/checkout", $payload);

            $data = $response->json();

            Log::info($data);


            $isSuccess = $data['Success'] ?? $data['success'] ?? false;

            if ($response->successful() && $isSuccess) {
                // session()->flash('message', 'Checkout successful!');
                 return $this->redirectRoute('cart-success', navigate: true);
            }

            $msg = $data['Message'] ?? $data['message'] ?? 'Checkout failed. Please try again.';
            $this->addError('shipping', $msg);

        } catch (\Throwable $th) {
            Log::error('Error processing checkout: ' . $th->getMessage());
            $this->addError('shipping', 'Unable to process checkout. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.pages.shipping-courier')->layout('layouts.pages.app');
    }
}
