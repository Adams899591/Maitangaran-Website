<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShippingDetails extends Component
{

    public $fullname = '';
    public $email = '';
    public $phone = '';
    public $state = '';
    public $address = '';

    public $isLoading = true;

    protected $rules = [
        'fullname' => 'required|string|min:2',
        'email'    => 'required|email',
        'phone'    => 'required|string|min:8',
        'state'    => 'required|string',
        'address'  => 'required|string|min:5',
    ];

    public function mount()
    {
        $this->fetchShippingDetails();
    }

    /**
     * Fetch existing saved shipping info (GET /customer/shipping)
     */
    public function fetchShippingDetails()
    {
        $this->isLoading = true;

        $token   = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey  = config('services.ecommerce.api');

        if (!$token) {
            session()->flash('error', 'Please log in to manage shipping details.');
            return redirect()->route('login');
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'X-Api-Key'     => $apiKey,
                'Accept'        => 'application/json',
            ])->get("{$baseUrl}/customer/shipping");

            $data = $response->json();

            if ($response->successful() && ($data['success'] ?? $data['Success'] ?? false)) {
                $shipping = $data['data'] ?? $data['Data'] ?? [];

                $this->fullname = $shipping['nameOfUser'] ?? $shipping['NameOfUser'] ?? '';
                $this->email    = $shipping['emailAddress'] ?? $shipping['EmailAddress'] ?? '';
                $this->phone    = $shipping['phoneNo'] ?? $shipping['PhoneNo'] ?? '';
                $this->state    = $shipping['stateOfResidence'] ?? $shipping['StateOfResidence'] ?? '';
                $this->address  = $shipping['address'] ?? $shipping['Address'] ?? '';
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching shipping details: ' . $th->getMessage());
            session()->flash('error', 'Unable to fetch shipping information.');
        } finally {
            $this->isLoading = false;
        }
    }

    /**
     * Create or update shipping info (PUT /customer/shipping)
     * Then proceed to the Delivery Rates / Checkout selection step.
     */
    public function updateShippingDetails()
    {
        $this->validate();

        $token   = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey  = config('services.ecommerce.api');

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'X-Api-Key'     => $apiKey,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->put("{$baseUrl}/customer/shipping", [
                'nameOfUser'       => trim($this->fullname),
                'address'          => trim($this->address),
                'phoneNo'          => trim($this->phone),
                'stateOfResidence' => trim($this->state),
                'emailAddress'     => trim($this->email),
            ]);

            $data = $response->json();

            if ($response->successful() && ($data['success'] ?? $data['Success'] ?? false)) {
                session()->flash('message', 'Shipping details updated successfully!');

                // Navigate to the next step (Shipping Rates / Final Checkout page)
                return redirect()->route('checkout');
            } else {
                $msg = $data['message'] ?? $data['Message'] ?? 'Failed to update shipping details.';
                $this->addError('address', $msg);
            }
        } catch (\Throwable $th) {
            Log::error('Error updating shipping details: ' . $th->getMessage());
            $this->addError('address', 'Unable to connect to server. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.pages.shipping-details')->layout('layouts.pages.app');
    }
}
