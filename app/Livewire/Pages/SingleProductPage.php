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
    public $selectedImageId = null;
    public $selectedVariantId = null;

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
            $imageDomain = config('services.ecommerce.image_domain');


            // $imageDomain = "https://swiftclouderp.com";

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/products/{$this->productId}");

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
                $this->selectedVariantId = null;

                // Set initial image to base product image
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
        if ($this->selectedVariantId === $variantId) {
            // Unselect variant -> revert to base product
            $this->selectedVariantId = null;
            $images = $this->product['Images'] ?? [];
            $featured = collect($images)->firstWhere('IsFeatured', true) ?? ($images[0] ?? null);
            $this->selectedImageId = $featured['ID'] ?? null;
        } else {
            $this->selectedVariantId = $variantId;
            $variants = $this->product['Variants'] ?? [];
            $selectedVariant = collect($variants)->firstWhere('ID', $variantId);

            // Switch to variant's primary image if available
            if ($selectedVariant && !empty($selectedVariant['Images'][0]['ID'])) {
                $this->selectedImageId = $selectedVariant['Images'][0]['ID'];
            }
        }

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

    // Dynamic filtering for active gallery images
    public function getGalleryImages()
    {
        if (!$this->product) return [];

        // If a variant is selected, show variant images (or fallback to product images if empty)
        if ($this->selectedVariantId) {
            $variants = $this->product['Variants'] ?? [];
            $selectedVariant = collect($variants)->firstWhere('ID', $this->selectedVariantId);
            $variantImages = $selectedVariant['Images'] ?? [];

            if (!empty($variantImages)) {
                return $variantImages;
            }
        }

        // Show base product images
        return $this->product['Images'] ?? [];
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
        $galleryImages = $this->getGalleryImages();

        $selectedImage = collect($galleryImages)->firstWhere('ID', $this->selectedImageId)
            ?? collect($galleryImages)->firstWhere('IsFeatured', true)
            ?? ($galleryImages[0] ?? []);

        $id        = $selectedImage['ID'] ?? null;
        $productID = $this->product['ID'] ?? $this->productId;
        $variantID = $this->selectedVariantId;
        $quantity  = $this->quantity;

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

    public function render()
    {
        return view('livewire.pages.single-product-page')->layout("layouts.pages.app");
    }
}
