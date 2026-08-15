<?php

// namespace App\Livewire\Pages;

// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Log;
// use Livewire\Component;

// class DeliveryMethod extends Component
// {
//     public $fulfillmentType;

//     public function saveFulfillmentOption()
//     {
//         // 1. Validate that a fulfillment method is selected
//         $this->validate([
//             'fulfillmentType' => 'required|in:delivery,pickup',
//         ]);

//         // 2. Save the selection to the session
//         session(['fulfillment_type' => $this->fulfillmentType]);

//         // 4. Redirect conditionally based on their choice
//         if ($this->fulfillmentType === 'delivery') {
//             // Redirect to a page where they pick a courier or confirm shipping address
//             return $this->redirectRoute('shipping-courier', navigate: true);
//         } else {

//               $this->processCheckout();
//             // Redirect to a page where they choose a pickup location station
//             return $this->redirectRoute('cart-success', navigate: true);
//         }
//     }




//     /**
//      * Complete Order / Convert Cart to Invoice (POST /checkout)
//      */
//     // NOTE:    this function is only called if the user do not select delivery
//     public function processCheckout()
//     {

//         $token   = session('api_token');
//         $baseUrl = config('services.ecommerce.url');
//         $apiKey  = config('services.ecommerce.api');


//         try {
//             $response = Http::withHeaders([
//                 'Authorization' => 'Bearer ' . $token,
//                 'X-Api-Key'     => $apiKey,
//                 'Content-Type'  => 'application/json',
//                 'Accept'        => 'application/json',
//             ])->post("{$baseUrl}/checkout");

//             $data = $response->json();

//             Log::info($data);


//             $isSuccess = $data['Success'] ?? $data['success'] ?? false;

//             if ($response->successful() && $isSuccess) {
//                 // session()->flash('message', 'Checkout successful!');
//                  return $this->redirectRoute('cart-success', navigate: true);
//             }

//             $msg = $data['error'] ?? $data['error'] ?? 'Checkout failed. Please try again.';
//             session()->flash('error', $msg);

//         } catch (\Throwable $th) {
//             Log::error('Error processing checkout: ' . $th->getMessage());
//             session()->flash('error', 'Unable to process checkout. Please try again.');

//         }
//     }


//     public function render()
//     {
//         return view('livewire.pages.delivery-method')->layout('layouts.pages.app');
//     }
// }

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DeliveryMethod extends Component
{
    public $fulfillmentType;

    public function saveFulfillmentOption()
    {
        // 1. Validate that a fulfillment method is selected
        $this->validate([
            'fulfillmentType' => 'required|in:delivery,pickup',
        ]);

        // 2. Save the selection to the session
        session(['fulfillment_type' => $this->fulfillmentType]);

        // 3. Redirect conditionally based on their choice
        if ($this->fulfillmentType === 'delivery') {
            // Redirect to a page where they pick a courier or confirm shipping address
            return $this->redirectRoute('shipping-courier', navigate: true);
        } else {
            // Return the result of processCheckout so it handles success/failure properly
            return $this->processCheckout();
        }
    }

    /**
     * Complete Order / Convert Cart to Invoice (POST /checkout)
     */
    public function processCheckout()
    {
        $token   = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey  = config('services.ecommerce.api');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'X-Api-Key'     => $apiKey,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->post("{$baseUrl}/checkout");

            $data = $response->json();

            Log::info('Checkout Response:', $data);

            $isSuccess = $data['Success'] ?? $data['success'] ?? false;

            if ($response->successful() && $isSuccess) {
                // Return the redirect here so it only redirects on success
                return $this->redirectRoute('cart-success', navigate: true);
            }

            // If it failed, extract the error message and stay on the page
            $msg = $data['Message'] ?? $data['message'] ?? $data['error'] ?? 'Checkout failed. Please try again.';
            session()->flash('error', $msg);
            
            return null; // Stop execution/redirection

        } catch (\Throwable $th) {
            Log::error('Error processing checkout: ' . $th->getMessage());
            session()->flash('error', 'Unable to process checkout. Please try again.');
            
            return null; // Stop execution/redirection
        }
    }

    public function render()
    {
        return view('livewire.pages.delivery-method')->layout('layouts.pages.app');
    }
}