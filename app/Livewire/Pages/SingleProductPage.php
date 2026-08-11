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
    public $selectedImageId = null; // Changed to track selected Image ID

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
            $imageDomain = "https://swiftclouderp.com";

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/products/{$this->productId}");

            Log::info($response->json());

            if ($response->successful() && $response->json('Success')) {
                $rawProduct = $response->json('Data');
                
                if (!empty($rawProduct['Images']) && is_array($rawProduct['Images'])) {
                    foreach ($rawProduct['Images'] as &$img) {
                        if (isset($img['FullImageUrl'])) {
                            if (str_starts_with($img['FullImageUrl'], '/')) {
                                $img['FullImageUrl'] = $imageDomain . $img['FullImageUrl'];
                            } elseif (!str_starts_with($img['FullImageUrl'], 'http')) {
                                $img['FullImageUrl'] = $imageDomain . '/' . $img['FullImageUrl'];
                            }
                        }

                        if (isset($img['ImagePath'])) {
                            if (str_starts_with($img['ImagePath'], '/')) {
                                $img['ImagePath'] = $imageDomain . $img['ImagePath'];
                            } elseif (!str_starts_with($img['ImagePath'], 'http')) {
                                $img['ImagePath'] = $imageDomain . '/' . $img['ImagePath'];
                            }
                        }
                    }
                }

                $this->product = $rawProduct;

                // Set initial selectedImageId from featured image or default to first image ID
                $images = $rawProduct['Images'] ?? [];
                $featured = collect($images)->firstWhere('IsFeatured', true) ?? ($images[0] ?? null);
                $this->selectedImageId = $featured['ID'] ?? null;

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

    public function selectImage($imageId)
    {
        $this->selectedImageId = $imageId;
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
        $images = $this->product['Images'] ?? [];

        // Find selected image by its unique ID
        $selectedImage = collect($images)->firstWhere('ID', $this->selectedImageId)
            ?? collect($images)->firstWhere('IsFeatured', true)
            ?? ($images[0] ?? []);

        $id        = $selectedImage['ID'] ?? null;
        $productID = $this->product['ProductID'] ?? $this->productId;
        $variantID = $selectedImage['VariantID'] ?? null;
        $quantity  = $this->quantity;

        
        Log::info("Adding to cart...", [
            'ID'        => $id,
            'ProductID' => $productID,
            'VariantID' => $variantID,
            'quantity'  => $quantity,
        ]);


        // Check if the user session key exists
        if (!session()->has('user')) {
            return  session()->flash('error', 'Please log in to access your cart.');
        }

        // Redirect to the named route with query parameters
        return redirect()->route('cart', [
            'id'         => $id,
            'product_id' => $productID,
            'variant_id' => $variantID,
            'quantity'   => $quantity,
        ]);



    }

    public function render()
    {
        return view('livewire.pages.single-product-page')->layout("layouts.pages.app");
    }
}









