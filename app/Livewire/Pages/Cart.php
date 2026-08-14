<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Cart extends Component
{
    public array $cartItems = [];
    public array $quantities = [];
    public float $subtotal = 0;
    public float $totalAmount = 0;
    public int $totalQuantity = 0;
    // public string $imageDomain;

    public bool $isLoading = true;
    public bool $networkError = false;

    public function mount(Request $request)
    {
        // $variantId = $request->query('id');         // NOTE: this is not used
        $productId = $request->query('product_id');
        $variantId = $request->query('variant_id');
        $quantity  = (int) $request->query('quantity', 1);

        if ($productId) {
            $this->addToCart($productId, $variantId, $quantity);
        } else {
            $this->fetchCart();
        }

        // $this->imageDomain = config('services.ecommerce.image_domain');
    }

    public function sessionCartQuantity(){
        session([
            "totalCartQuantity" => $this->totalQuantity,
        ]);
    }

    private function getHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . session('api_token'),
            'X-Api-Key'     => config('services.ecommerce.api'),
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ];
    }

    public function fetchCart()
    {
        $this->isLoading = true;
        $this->networkError = false;

        try {
            $baseUrl = config('services.ecommerce.url');
            $response = Http::withHeaders($this->getHeaders())->get($baseUrl . '/cart');
            //             Log::info("00000000000000000000000000000000000000000000");
            Log::info($response->json());
            $data = $response->json();

            if ($response->successful() && ($data['Success'] ?? false)) {
                $this->cartItems = $data['Data']['Items'] ?? [];
                $this->subtotal = (float) ($data['Data']['Total'] ?? 0);
                $this->totalAmount = $this->subtotal;

                // Sync quantities array & total items count
                $this->quantities = [];
                $this->totalQuantity = 0;

                foreach ($this->cartItems as $item) {
                    $itemId = $item['ID'];
                    $this->quantities[$itemId] = $item['Quantity'] ?? 1;
                    $this->totalQuantity += $item['Quantity'] ?? 1;
                }

                $this->sessionCartQuantity();
                $this->dispatch('cart-updated', totalQuantity: $this->totalQuantity);
            } else {
                $this->networkError = true;
            }
        } catch (\Throwable $th) {
            $this->networkError = true;
        } finally {
            $this->isLoading = false;
        }
    }

    public function addToCart($productId, $variantId = null, $quantity = 1)
    {
        try {
            $baseUrl = config('services.ecommerce.url');
            $response = Http::withHeaders($this->getHeaders())->post($baseUrl . '/cart/add', [
                [
                    'productID' => $productId,
                    'quantity'  => $quantity,
                    'variantID' => $variantId,
                ]
            ]);

            Log::info("00000000000 Add tocart response 00000000000000");
            Log::info($response->json());

            if ($response->successful()) {
                session()->flash('success', 'Item added to cart.');
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Failed to add item to cart.');
        }

        $this->fetchCart();
    }

    public function updateQuantity($itemId)
    {
        $targetedItem = collect($this->cartItems)->firstWhere('ID', $itemId);
        if (!$targetedItem) return;

        $newQty = (int) ($this->quantities[$itemId] ?? 1);

        try {
            $baseUrl = config('services.ecommerce.url');
            $response = Http::withHeaders($this->getHeaders())->put($baseUrl . '/cart/update', [
                'productID' => $targetedItem['ProductID'],
                'quantity'  => $newQty,
                'variantID' => $targetedItem['VariantID'] ?? null,
            ]);

            if ($response->successful() && ($response->json('Success') || $response->json('success'))) {
                session()->flash('success', 'Cart updated successfully.');
                $this->fetchCart();
            } else {
                session()->flash('error', 'Failed to update quantity.');
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Error connecting to server.');
        }
    }

    public function removeItem($itemId)
    {
        $targetedItem = collect($this->cartItems)->firstWhere('ID', $itemId);
        if (!$targetedItem) return;

        try {
            $baseUrl = config('services.ecommerce.url');
            $response = Http::withHeaders($this->getHeaders())->delete($baseUrl . '/cart/remove', [
                'productIDs' => [$targetedItem['ProductID']]
            ]);

            if ($response->successful() && ($response->json('Success') || $response->json('success'))) {
                session()->flash('success', 'Item removed.');
                $this->fetchCart();
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Failed to remove item.');
        }
    }

    public function clearCart()
    {
        try {
            $baseUrl = config('services.ecommerce.url');
            $response = Http::withHeaders($this->getHeaders())->delete($baseUrl . '/cart/clear');

            if ($response->successful() && ($response->json('Success') || $response->json('success'))) {
                $this->cartItems = [];
                $this->quantities = [];
                $this->subtotal = 0;
                $this->totalAmount = 0;
                $this->totalQuantity = 0;
                $this->sessionCartQuantity();
                $this->dispatch('cart-updated', totalQuantity: 0);
                session()->flash('success', 'Cart cleared.');
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Unable to clear cart.');
        }
    }

    public function render()
    {
        return view('livewire.pages.cart')->layout("layouts.pages.app");
    }
}