<?php

// namespace App\Livewire\Pages;

// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Log;
// use Livewire\Component;
 
// class SingleProductPage extends Component
// {

//     public $productId;

//     public function mount()
//     {
//         // $id will hold "b832f712-614a-4c0b-b233-b3e2697c597d"
//         $this->productId = request()->query('id');

//         $this->fetchSingleProducts();
//     }

//      public function fetchSingleProducts()
//     {
//         // $this->isLoading = true;
//         // $this->networkError = false;

//         try {
//             $baseUrl = config('services.ecommerce.url');
//             $apiKey  = config('services.ecommerce.api');

//             $response = Http::withHeaders([
//                 'X-Api-Key'    => $apiKey,
//                 'Content-Type' => 'application/json',
//                 'Accept'       => 'application/json',
//             ])->get("{$baseUrl}/products/{$this->productId}");

//             Log::info($response->json());

//             if ($response->successful() && $response->json('Success')) {

//             } else {

//             }
//         } catch (\Throwable $th) {
//             Log::error('Error fetching featured products: ' . $th->getMessage());

//         } finally {

//         }
//     }













//     public function render()
//     {
//         return view('livewire.pages.single-product-page')->layout("layouts.pages.app");
//     }
// }



namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SingleProductPage extends Component
{
    public ?string $productId = null;
    public ?array $product = null;
    public ?array $selectedVariant = null;
    public ?string $activeImageUrl = null;
    public int $quantity = 1;

    public bool $isLoading = true;
    public bool $networkError = false;

    public function mount()
    {
        $this->productId = request()->query('id');

        if ($this->productId) {
            $this->fetchSingleProduct();
        } else {
            $this->isLoading = false;
        }
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
                $this->product = $response->json('Data');

                // Default selected variant if variants exist
                if (!empty($this->product['Variants'])) {
                    $this->selectedVariant = $this->product['Variants'][0];
                }

                // Determine initial main image URL
                $this->setInitialImage();
            } else {
                $this->product = null;
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching single product: ' . $th->getMessage());
            $this->networkError = true;
            $this->product = null;
        } finally {
            $this->isLoading = false;
        }
    }

    private function setInitialImage()
    {
        // 1. Check direct large image
        if (!empty($this->product['LargeImage'])) {
            $this->activeImageUrl = $this->product['LargeImage'];
            return;
        }

        // 2. Check images gallery array
        if (!empty($this->product['Images'])) {
            // Find featured image or fallback to first image
            $featured = collect($this->product['Images'])->firstWhere('IsFeatured', true);
            $img = $featured ?? $this->product['Images'][0];

            $this->activeImageUrl = $img['FullImageUrl'] ?? $img['ImagePath'] ?? null;
            return;
        }

        // 3. Fallback to small image
        $this->activeImageUrl = $this->product['SmallImage'] ?? null;
    }

    public function selectImage(string $url)
    {
        $this->activeImageUrl = $url;
    }

    public function selectVariant(array $variant)
    {
        $this->selectedVariant = $variant;
        $this->quantity = 1; // Reset qty when switching variants
    }

    public function adjustQuantity(int $change)
    {
        $stock = $this->getCurrentStock();
        $newQty = $this->quantity + $change;

        if ($newQty >= 1 && ($stock === null || $newQty <= $stock)) {
            $this->quantity = $newQty;
        }
    }

    public function getCurrentStock()
    {
        if ($this->selectedVariant) {
            return $this->selectedVariant['StockLevel'] ?? $this->selectedVariant['Qty'] ?? 0;
        }

        return $this->product['StockLevel'] ?? 0;
    }

    public function addToCart()
    {
        $variantId = $this->selectedVariant['ID'] ?? null;
        
        // Add your cart logic or dispatch Livewire event here
        session()->flash('message', 'Product added to cart!');
    }

    public function render()
    {
        return view('livewire.pages.single-product-page')->layout("layouts.pages.app");
    }
}