<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
 
class SingleProductPage extends Component
{
    public $productId;
    public $product = null;
    public $isLoading = true;
    public $networkError = false;
    public $quantity = 1;

    public function mount()
    {
        $this->productId = request()->query('id');
        $this->fetchSingleProduct();
    }

    public function fetchSingleProduct()
    {
        $this->isLoading = true;
        $this->networkError = false;

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
                $rawProduct = $response->json('Data');
                
                // Prepend base URL to image paths if they are relative
                if (!empty($rawProduct['Images']) && is_array($rawProduct['Images'])) {
                    foreach ($rawProduct['Images'] as &$img) {
                        if (isset($img['FullImageUrl']) && str_starts_with($img['FullImageUrl'], '/')) {
                            $img['FullImageUrl'] = rtrim($baseUrl, '/') . $img['FullImageUrl'];
                        }
                    }
                }

                $this->product = $rawProduct;

                // Reset quantity to 1 or max stock if available
                $stock = $rawProduct['StockLevel'] ?? 0;
                $this->quantity = $stock > 0 ? 1 : 0;
            } else {
                $this->networkError = true;
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching single product: ' . $th->getMessage());
            $this->networkError = true;
        } finally {
            $this->isLoading = false;
        }
    }

    public function adjustQty($change)
    {
        $maxStock = $this->product['StockLevel'] ?? 1;
        $newQty = $this->quantity + $change;
        
        if ($newQty >= 1 && $newQty <= $maxStock) {
            $this->quantity = $newQty;
        }
    }

    public function addToCart()
    {
        // Add your cart implementation logic here
        session()->flash('message', 'Product added to cart successfully!');
    }

    public function render()
    {
        return view('livewire.pages.single-product-page')->layout("layouts.pages.app");
    }
}