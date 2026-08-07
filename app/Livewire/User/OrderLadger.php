<?php
namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class OrderLadger extends Component
{
    public array $orders = [];
    public bool $isLoading = true;

    //  this triggers the page to fetch data as soon as the page load 
    public function mount(): void
    {
        $this->fetchUserOrders();
    }


    // function that handle the fetching of user order data on api
    public function fetchUserOrders(): void
    {
        $token = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey = config('services.ecommerce.api');

        if (!$token) {
            $this->orders = [];
            $this->isLoading = false;
            return;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'X-Api-Key'     => $apiKey,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->get($baseUrl . '/orders');

            $data = $response->json();

            if ($response->successful() && ($data['Success'] ?? false) === true) {
                $itemsList = $data['Data']['Items'] ?? [];

                // Sort orders by Date (oldest to newest) to match React Native sorting
                usort($itemsList, function ($a, $b) {
                    return strtotime($a['Date'] ?? '') <=> strtotime($b['Date'] ?? '');
                });

                $this->orders = $itemsList;
            } else {
                $this->orders = [];
            }
        } catch (\Throwable $th) {
            $this->orders = [];
        } finally {
            $this->isLoading = false;
        }
    }


    // this function will handle the passing of order to the other page 
    public function viewInvoice($invoiceId)
    {
        return redirect()->route('orders-details', ['InvoiceID' => $invoiceId]);
    }

    public function render()
    {
        return view('livewire.user.order-ladger')->layout("layouts.user.app");
    }
}