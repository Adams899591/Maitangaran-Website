<?php

namespace App\Livewire\Pages\Home;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductsSection extends Component
{
    public array $products = [];
    public int $page = 1;
    public bool $hasMore = true;
    public bool $isLoading = false;
    public bool $isMoreLoading = false;
    public bool $networkError = false;

    public function mount()
    {
        $this->fetchProducts(1);
    }

    public function fetchProducts(int $pageNumber = 1)
    {
        if ($pageNumber === 1) {
            $this->isLoading = true;
        } else {
            $this->isMoreLoading = true;
        }

        $this->networkError = false;

        try {
            $baseUrl = config('services.ecommerce.url');
            $apiKey  = config('services.ecommerce.api');

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/products", [
                'page'  => $pageNumber,
                'limit' => 20,
            ]);

            // Log::info($response->json());


            if ($response->successful() && $response->json('Success')) {
                $newData = $response->json('Data') ?? [];

                if (count($newData) < 20) {
                    $this->hasMore = false;
                }

                if ($pageNumber === 1) {
                    $this->products = $newData;
                } else {
                    $this->products = array_merge($this->products, $newData);
                }

                $this->page = $pageNumber;
            } else {
                if ($pageNumber === 1) {
                    $this->products = [];
                }
                $this->hasMore = false;
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching products: ' . $th->getMessage());
            $this->networkError = true;
            if ($pageNumber === 1) {
                $this->products = [];
            }
        } finally {
            $this->isLoading = false;
            $this->isMoreLoading = false;
        }
    }

    public function loadMore()
    {
        if ($this->hasMore && !$this->isMoreLoading && !$this->isLoading) {
            $this->fetchProducts($this->page + 1);
        }
    }

    public function render()
    {
        return view('livewire.pages.home.products-section');
    }
}