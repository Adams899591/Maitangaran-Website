<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
 
class SingleProductPage extends Component
{

    public $productId;

    public function mount()
    {
        // $id will hold "b832f712-614a-4c0b-b233-b3e2697c597d"
        $this->productId = request()->query('id');

        $this->fetchSingleProducts();
    }

     public function fetchSingleProducts()
    {
        // $this->isLoading = true;
        // $this->networkError = false;

        try {
            $baseUrl = config('services.ecommerce.url');
            $apiKey  = config('services.ecommerce.api');

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/products/{$this->productId}");

            Log::info($response->json());

            if ($response->successful() && $response->json('Success')) {
                // Fix: Target 'Items' inside 'Data'
                // $data = $response->json('Data') ?? [];
                // $this->products = $data['Items'] ?? (is_array($data) && array_is_list($data) ? $data : []);
            } else {
                // $this->products = [];
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching featured products: ' . $th->getMessage());
            // $this->networkError = true;
            // $this->products = [];
        } finally {
            // $this->isLoading = false;
        }
    }













    public function render()
    {
        return view('livewire.pages.single-product-page')->layout("layouts.pages.app");
    }
}
