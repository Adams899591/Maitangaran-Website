<?php

// namespace App\Livewire\Pages;

// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Log;
// use Livewire\Component;

// class SingleProductPage extends Component
// {
//     public $productId;
//     public $product = null;
//     public $isLoading = true;
//     public $networkError = false;
//     public $quantity = 1;
//     public $selectedImageId = null; // Changed to track selected Image ID

//     public function mount()
//     {
//         $this->productId = request()->query('id');
//         $this->fetchSingleProduct();
//     }

//     public function fetchSingleProduct()
//     {
//         $this->isLoading = true;
//         $this->networkError = false;

//         try {
//             $baseUrl = config('services.ecommerce.url');
//             $apiKey  = config('services.ecommerce.api');
//             $imageDomain = "https://swiftclouderp.com";

//             $response = Http::withHeaders([
//                 'X-Api-Key'    => $apiKey,
//                 'Content-Type' => 'application/json',
//                 'Accept'       => 'application/json',
//             ])->get("{$baseUrl}/products/{$this->productId}");

//             Log::info($response->json());

//             if ($response->successful() && $response->json('Success')) {
//                 $rawProduct = $response->json('Data');
                
//                 if (!empty($rawProduct['Images']) && is_array($rawProduct['Images'])) {
//                     foreach ($rawProduct['Images'] as &$img) {
//                         if (isset($img['FullImageUrl'])) {
//                             if (str_starts_with($img['FullImageUrl'], '/')) {
//                                 $img['FullImageUrl'] = $imageDomain . $img['FullImageUrl'];
//                             } elseif (!str_starts_with($img['FullImageUrl'], 'http')) {
//                                 $img['FullImageUrl'] = $imageDomain . '/' . $img['FullImageUrl'];
//                             }
//                         }

//                         if (isset($img['ImagePath'])) {
//                             if (str_starts_with($img['ImagePath'], '/')) {
//                                 $img['ImagePath'] = $imageDomain . $img['ImagePath'];
//                             } elseif (!str_starts_with($img['ImagePath'], 'http')) {
//                                 $img['ImagePath'] = $imageDomain . '/' . $img['ImagePath'];
//                             }
//                         }
//                     }
//                 }

//                 $this->product = $rawProduct;

//                 // Set initial selectedImageId from featured image or default to first image ID
//                 $images = $rawProduct['Images'] ?? [];
//                 $featured = collect($images)->firstWhere('IsFeatured', true) ?? ($images[0] ?? null);
//                 $this->selectedImageId = $featured['ID'] ?? null;

//                 $stock = $rawProduct['StockLevel'] ?? 0;
//                 $this->quantity = $stock > 0 ? 1 : 0;
//             } else {
//                 $this->networkError = true;
//             }
//         } catch (\Throwable $th) {
//             Log::error('Error fetching single product: ' . $th->getMessage());
//             $this->networkError = true;
//         } finally {
//             $this->isLoading = false;
//         }
//     }

//     public function selectImage($imageId)
//     {
//         $this->selectedImageId = $imageId;
//     }

//     public function adjustQty($change)
//     {
//         $maxStock = $this->product['StockLevel'] ?? 1;
//         $newQty = $this->quantity + $change;
        
//         if ($newQty >= 1 && $newQty <= $maxStock) {
//             $this->quantity = $newQty;
//         }
//     }

//     public function addToCart()
//     {
//         $images = $this->product['Images'] ?? [];

//         // Find selected image by its unique ID
//         $selectedImage = collect($images)->firstWhere('ID', $this->selectedImageId)
//             ?? collect($images)->firstWhere('IsFeatured', true)
//             ?? ($images[0] ?? []);

//         $id        = $selectedImage['ID'] ?? null;
//         $productID = $this->product['ProductID'] ?? $this->productId;
//         $variantID = $selectedImage['VariantID'] ?? null;
//         $quantity  = $this->quantity;

        
//         Log::info("Adding to cart...", [
//             'ID'        => $id,
//             'ProductID' => $productID,
//             'VariantID' => $variantID,
//             'quantity'  => $quantity,
//         ]);


//         // Check if the user session key exists
//         if (!session()->has('user')) {
//             return  session()->flash('error', 'Please log in to access your cart.');
//         }

//         // Redirect to the named route with query parameters
//         return redirect()->route('cart', [
//             'id'         => $id,
//             'product_id' => $productID,
//             'variant_id' => $variantID,
//             'quantity'   => $quantity,
//         ]);



//     }

//     public function render()
//     {
//         return view('livewire.pages.single-product-page')->layout("layouts.pages.app");
//     }
// }








// namespace App\Livewire\Pages;

// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Log;
// use Livewire\Component;

// class SingleProductPage extends Component
// {
//     public $productId;
//     public $product = null;
//     public $isLoading = true;
//     public $networkError = false;
//     public $quantity = 1;
//     public $selectedImageId = null;
//     public $selectedVariantId = null; // Track selected variant

//     public function mount()
//     {
//         $this->productId = request()->query('id');
//         $this->fetchSingleProduct();
//     }

//     public function fetchSingleProduct()
//     {
//         $this->isLoading = true;
//         $this->networkError = false;

//         try {
//             $baseUrl = config('services.ecommerce.url');
//             $apiKey  = config('services.ecommerce.api');
//             $imageDomain = "https://swiftclouderp.com";

//             $response = Http::withHeaders([
//                 'X-Api-Key'    => $apiKey,
//                 'Content-Type' => 'application/json',
//                 'Accept'       => 'application/json',
//             ])->get("{$baseUrl}/products/{$this->productId}");

//             Log::info($response->json());

//             if ($response->successful() && $response->json('Success')) {
//                 $rawProduct = $response->json('Data');
                
//                 // Format root product images
//                 if (!empty($rawProduct['Images']) && is_array($rawProduct['Images'])) {
//                     foreach ($rawProduct['Images'] as &$img) {
//                         $img['FullImageUrl'] = $this->formatImageUrl($img['FullImageUrl'] ?? '', $imageDomain);
//                         $img['ImagePath']    = $this->formatImageUrl($img['ImagePath'] ?? '', $imageDomain);
//                     }
//                 }

//                 // Format nested variant images
//                 if (!empty($rawProduct['Variants']) && is_array($rawProduct['Variants'])) {
//                     foreach ($rawProduct['Variants'] as &$variant) {
//                         if (!empty($variant['Images']) && is_array($variant['Images'])) {
//                             foreach ($variant['Images'] as &$vImg) {
//                                 $vImg['FullImageUrl'] = $this->formatImageUrl($vImg['FullImageUrl'] ?? '', $imageDomain);
//                                 $vImg['ImagePath']    = $this->formatImageUrl($vImg['ImagePath'] ?? '', $imageDomain);
//                             }
//                         }
//                     }
//                 }

//                 $this->product = $rawProduct;

//                 // Auto-select first variant if available
//                 $variants = $rawProduct['Variants'] ?? [];
//                 if (!empty($variants)) {
//                     $firstVariant = $variants[0];
//                     $this->selectedVariantId = $firstVariant['ID'] ?? null;

//                     // If variant has an image, select its image ID
//                     if (!empty($firstVariant['Images'][0]['ID'])) {
//                         $this->selectedImageId = $firstVariant['Images'][0]['ID'];
//                     }
//                 }

//                 // Fallback to primary product images if no variant image was set
//                 if (!$this->selectedImageId) {
//                     $images = $rawProduct['Images'] ?? [];
//                     $featured = collect($images)->firstWhere('IsFeatured', true) ?? ($images[0] ?? null);
//                     $this->selectedImageId = $featured['ID'] ?? null;
//                 }

//                 $stock = $this->getAvailableStock();
//                 $this->quantity = $stock > 0 ? 1 : 0;
//             } else {
//                 $this->networkError = true;
//             }
//         } catch (\Throwable $th) {
//             Log::error('Error fetching single product: ' . $th->getMessage());
//             $this->networkError = true;
//         } finally {
//             $this->isLoading = false;
//         }
//     }

//     private function formatImageUrl($url, $domain)
//     {
//         if (empty($url)) return '';
//         if (str_starts_with($url, '/')) {
//             return $domain . $url;
//         } elseif (!str_starts_with($url, 'http')) {
//             return $domain . '/' . $url;
//         }
//         return $url;
//     }

//     public function selectVariant($variantId)
//     {
//         $this->selectedVariantId = $variantId;
        
//         $variants = $this->product['Variants'] ?? [];
//         $selectedVariant = collect($variants)->firstWhere('ID', $variantId);

//         // Switch main image to selected variant image if available
//         if ($selectedVariant && !empty($selectedVariant['Images'][0]['ID'])) {
//             $this->selectedImageId = $selectedVariant['Images'][0]['ID'];
//         }

//         // Adjust quantity to fit stock limits of selected variant
//         $maxStock = $this->getAvailableStock();
//         if ($maxStock <= 0) {
//             $this->quantity = 0;
//         } elseif ($this->quantity > $maxStock || $this->quantity == 0) {
//             $this->quantity = 1;
//         }
//     }

//     public function selectImage($imageId)
//     {
//         $this->selectedImageId = $imageId;
//     }

//     public function getAvailableStock()
//     {
//         if (!$this->product) return 0;

//         $variants = $this->product['Variants'] ?? [];
//         if (!empty($variants) && $this->selectedVariantId) {
//             $selectedVariant = collect($variants)->firstWhere('ID', $this->selectedVariantId);
//             return $selectedVariant['Qty'] ?? $selectedVariant['StockLevel'] ?? 0;
//         }

//         return $this->product['StockLevel'] ?? 0;
//     }

//     public function adjustQty($change)
//     {
//         $maxStock = $this->getAvailableStock();
//         $newQty = $this->quantity + $change;
        
//         if ($newQty >= 1 && $newQty <= $maxStock) {
//             $this->quantity = $newQty;
//         }
//     }

//     public function addToCart()
//     {
//         $allImages = $this->getAllImages();

//         // Find selected image or fallback
//         $selectedImage = collect($allImages)->firstWhere('ID', $this->selectedImageId)
//             ?? collect($allImages)->firstWhere('IsFeatured', true)
//             ?? ($allImages[0] ?? []);

//         $id        = $selectedImage['ID'] ?? null;
//         $productID = $this->product['ProductID'] ?? $this->productId;
//         $variantID = $this->selectedVariantId ?? ($selectedImage['VariantID'] ?? null);
//         $quantity  = $this->quantity;

//         Log::info("Adding to cart...", [
//             'ID'        => $id,
//             'ProductID' => $productID,
//             'VariantID' => $variantID,
//             'quantity'  => $quantity,
//         ]);

//         if (!session()->has('user')) {
//             return session()->flash('error', 'Please log in to access your cart.');
//         }

//         return redirect()->route('cart', [
//             'id'         => $id,
//             'product_id' => $productID,
//             'variant_id' => $variantID,
//             'quantity'   => $quantity,
//         ]);
//     }

//     public function getAllImages()
//     {
//         if (!$this->product) return [];

//         $productImages = $this->product['Images'] ?? [];
//         $variantImages = [];

//         if (!empty($this->product['Variants'])) {
//             foreach ($this->product['Variants'] as $v) {
//                 if (!empty($v['Images'])) {
//                     foreach ($v['Images'] as $vImg) {
//                         $variantImages[] = $vImg;
//                     }
//                 }
//             }
//         }

//         return array_merge($productImages, $variantImages);
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
    public $productId;
    public $product = null;
    public $isLoading = true;
    public $networkError = false;
    public $quantity = 1;
    public $selectedImageId = null;
    public $selectedVariantId = null; // Stays null initially so main product is shown first

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
                
                // Format root product images
                if (!empty($rawProduct['Images']) && is_array($rawProduct['Images'])) {
                    foreach ($rawProduct['Images'] as &$img) {
                        $img['FullImageUrl'] = $this->formatImageUrl($img['FullImageUrl'] ?? '', $imageDomain);
                        $img['ImagePath']    = $this->formatImageUrl($img['ImagePath'] ?? '', $imageDomain);
                    }
                }

                // Format nested variant images
                if (!empty($rawProduct['Variants']) && is_array($rawProduct['Variants'])) {
                    foreach ($rawProduct['Variants'] as &$variant) {
                        if (!empty($variant['Images']) && is_array($variant['Images'])) {
                            foreach ($variant['Images'] as &$vImg) {
                                $vImg['FullImageUrl'] = $this->formatImageUrl($vImg['FullImageUrl'] ?? '', $imageDomain);
                                $vImg['ImagePath']    = $this->formatImageUrl($vImg['ImagePath'] ?? '', $imageDomain);
                            }
                        }
                    }
                }

                $this->product = $rawProduct;
                $this->selectedVariantId = null; // Ensure main product is displayed initially

                // Set initial image to the main product's featured or first image
                $images = $rawProduct['Images'] ?? [];
                $featured = collect($images)->firstWhere('IsFeatured', true) ?? ($images[0] ?? null);
                $this->selectedImageId = $featured['ID'] ?? null;

                $stock = $this->getAvailableStock();
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

    private function formatImageUrl($url, $domain)
    {
        if (empty($url)) return '';
        if (str_starts_with($url, '/')) {
            return $domain . $url;
        } elseif (!str_starts_with($url, 'http')) {
            return $domain . '/' . $url;
        }
        return $url;
    }

    public function selectVariant($variantId)
    {
        // Toggle selection: if clicking the already selected variant, unselect it back to main product
        if ($this->selectedVariantId === $variantId) {
            $this->selectedVariantId = null;
            
            // Revert image to main product image
            $images = $this->product['Images'] ?? [];
            $featured = collect($images)->firstWhere('IsFeatured', true) ?? ($images[0] ?? null);
            $this->selectedImageId = $featured['ID'] ?? null;
        } else {
            $this->selectedVariantId = $variantId;
            
            $variants = $this->product['Variants'] ?? [];
            $selectedVariant = collect($variants)->firstWhere('ID', $variantId);

            // Switch main display image to selected variant image if available
            if ($selectedVariant && !empty($selectedVariant['Images'][0]['ID'])) {
                $this->selectedImageId = $selectedVariant['Images'][0]['ID'];
            }
        }

        // Adjust quantity to respect current stock limits
        $maxStock = $this->getAvailableStock();
        if ($maxStock <= 0) {
            $this->quantity = 0;
        } elseif ($this->quantity > $maxStock || $this->quantity == 0) {
            $this->quantity = 1;
        }
    }

    public function selectImage($imageId)
    {
        $this->selectedImageId = $imageId;
    }

    public function getAvailableStock()
    {
        if (!$this->product) return 0;

        $variants = $this->product['Variants'] ?? [];
        if (!empty($variants) && $this->selectedVariantId) {
            $selectedVariant = collect($variants)->firstWhere('ID', $this->selectedVariantId);
            return $selectedVariant['Qty'] ?? $selectedVariant['StockLevel'] ?? 0;
        }

        return $this->product['StockLevel'] ?? 0;
    }

    public function adjustQty($change)
    {
        $maxStock = $this->getAvailableStock();
        $newQty = $this->quantity + $change;
        
        if ($newQty >= 1 && $newQty <= $maxStock) {
            $this->quantity = $newQty;
        }
    }

    public function addToCart()
    {
        $allImages = $this->getAllImages();

        // Find selected image or fallbacks
        $selectedImage = collect($allImages)->firstWhere('ID', $this->selectedImageId)
            ?? collect($allImages)->firstWhere('IsFeatured', true)
            ?? ($allImages[0] ?? []);

        $id        = $selectedImage['ID'] ?? null;
        $productID = $this->product['ID'] ?? $this->productId;
        $variantID = $this->selectedVariantId;
        $quantity  = $this->quantity;

        Log::info("Adding to cart...", [
            'ID'        => $id,
            'ProductID' => $productID,
            'VariantID' => $variantID,
            'quantity'  => $quantity,
        ]);

        if (!session()->has('user')) {
            return session()->flash('error', 'Please log in to access your cart.');
        }

        return redirect()->route('cart', [
            'id'         => $id,
            'product_id' => $productID,
            'variant_id' => $variantID,
            'quantity'   => $quantity,
        ]);
    }

    public function getAllImages()
    {
        if (!$this->product) return [];

        $productImages = $this->product['Images'] ?? [];
        $variantImages = [];

        if (!empty($this->product['Variants'])) {
            foreach ($this->product['Variants'] as $v) {
                if (!empty($v['Images'])) {
                    foreach ($v['Images'] as $vImg) {
                        $variantImages[] = $vImg;
                    }
                }
            }
        }

        return array_merge($productImages, $variantImages);
    }

//     public function getGalleryImages()
// {
//     if (!$this->product) return [];

//     $productImages = $this->product['Images'] ?? [];

//     // If a variant is selected, prioritize/filter to that variant's images
//     if ($this->selectedVariantId) {
//         $variants = $this->product['Variants'] ?? [];
//         $selectedVariant = collect($variants)->firstWhere('ID', $this->selectedVariantId);
        
//         $variantImages = $selectedVariant['Images'] ?? [];

//         // If the variant has its own images, show them; otherwise fallback to main product images
//         return !empty($variantImages) ? $variantImages : $productImages;
//     }

//     // Default: Show only base product images on load
//     return $productImages;
// }

    public function render()
    {
        return view('livewire.pages.single-product-page')->layout("layouts.pages.app");
    }
}
