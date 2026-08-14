<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Shop extends Component
{
    // API & Dataset state
    public array $products = [];
    public array $categories = []; // <-- Added to hold categories array
    public int $apiPage = 1;
    public bool $hasMore = true;
    public bool $isLoading = true; // Set to true initially for skeleton display
    public bool $isMoreLoading = false;
    public bool $networkError = false;

    // Local Pagination state (4 products per view page)
    public int $currentPage = 1;
    public int $perPage = 4;

    // Filter properties (sidebar)
    public string $categorySearch = '';
    public string $category = '';
    public int $rangePrice = 500000;

    public function mount()
    {  
        // DO NOT call fetchProducts(1) here. 
        // Wire-init will trigger it asynchronously once the skeleton is rendered on screen.
    }

    /**
     * Fetch Categories API Endpoint
     */
    public function fetchCategory()
    {
        try {
            $baseUrl = config('services.ecommerce.url');
            $apiKey  = config('services.ecommerce.api');

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/categories");

            if ($response->successful() && ($response->json('Success') || $response->json('success'))) {
                $this->categories = $response->json('Data') ?? $response->json('data') ?? [];
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching categories in Shop: ' . $th->getMessage());
        }
    }

    /**
     * Fetch products strictly by Selected Category ID
     */
    public function searchByCategory()
    {
        if (empty($this->category)) {
            $this->hasMore = true;
            $this->fetchProducts(1);
            return;
        }

        $this->isLoading = true;
        $this->networkError = false;
        $this->currentPage = 1;

        try {
            $baseUrl = config('services.ecommerce.url');
            $apiKey  = config('services.ecommerce.api');

            Log::info("Fetching products for Category ID: '{$this->category}'");


            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/search", [
                "category"   => $this->category
            ]);

            Log::info($response->json());


            if ($response->successful() && ($response->json('Success') || $response->json('success'))) {
                $this->products = $response->json('Data') ?? $response->json('data') ?? [];
                $this->hasMore = false; 
            } else {
                $this->products = [];
                $this->hasMore = false;
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching products by category ID in Shop: ' . $th->getMessage());
            $this->networkError = true;
            $this->products = [];
        } finally {
            $this->isLoading = false;
        }
    }
    

    /**
     * Search products strictly by Text Query
     */
    public function searchCategory()
    {
        $query = trim($this->categorySearch);

        // If search input is blank, reload default shop products
        if (empty($query)) {
            $this->hasMore = true;
            $this->fetchProducts(1);
            return;
        }

        $this->isLoading = true;
        $this->networkError = false;
        $this->currentPage = 1;

        try {
            $baseUrl = config('services.ecommerce.url');
            $apiKey  = config('services.ecommerce.api');

            Log::info("Searching products by query: '{$query}'");

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/search", [
                'query' => $query,
            ]);

            if ($response->successful() && ($response->json('Success') || $response->json('success'))) {
                $this->products = $response->json('Data') ?? $response->json('data') ?? [];
                $this->hasMore = false; 
            } else {
                $this->products = [];
                $this->hasMore = false;
            }
        } catch (\Throwable $th) {
            Log::error('Error searching products in Shop: ' . $th->getMessage());
            $this->networkError = true;
            $this->products = [];
        } finally {
            $this->isLoading = false;
        }
    }

    /**
     * Search products strictly by Price Range (Independent API call)
     */
    public function searchByPrice()
    {
        $this->isLoading = true;
        $this->networkError = false;
        $this->currentPage = 1;

        try {
            $baseUrl = config('services.ecommerce.url');
            $apiKey  = config('services.ecommerce.api');

            Log::info("Searching products by maxPrice: {$this->rangePrice}");

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/search", [
                'maxPrice' => $this->rangePrice,
            ]);

            if ($response->successful() && ($response->json('Success') || $response->json('success'))) {
                $this->products = $response->json('Data') ?? $response->json('data') ?? [];
                $this->hasMore = false;
            } else {
                $this->products = [];
                $this->hasMore = false;
            }
        } catch (\Throwable $th) {
            Log::error('Error searching products by price in Shop: ' . $th->getMessage());
            $this->networkError = true;
            $this->products = [];
        } finally {
            $this->isLoading = false;
        }
    }

    /**
     * Fetch products chunk (20 products) from API
     */
    public function fetchProducts(int $pageNumber = 1)
    {
        if ($pageNumber === 1) {
            $this->isLoading = true;
            // Also fetch categories on initial load if not fetched yet
            if (empty($this->categories)) {
                $this->fetchCategory();
            }
        } else {
            $this->isMoreLoading = true;
        }

        $this->networkError = false;

        try {
            $baseUrl = config('services.ecommerce.url');
            $apiKey  = config('services.ecommerce.api');

            Log::info("Fetching products page: {$pageNumber} from {$baseUrl}/products");

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/products", [
                'page'  => $pageNumber,
                'limit' => 20,
            ]);

            if ($response->successful() && ($response->json('Success') || $response->json('success'))) {
                $newData = $response->json('Data') ?? $response->json('data') ?? [];

                if (count($newData) < 20) {
                    $this->hasMore = false;
                }

                if ($pageNumber === 1) {
                    $this->products = $newData;
                } else {
                    $this->products = array_merge($this->products, $newData);
                }

                $this->apiPage = $pageNumber;
            } else {
                if ($pageNumber === 1) {
                    $this->products = [];
                }
                $this->hasMore = false;
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching products in Shop: ' . $th->getMessage());
            $this->networkError = true;
            if ($pageNumber === 1) {
                $this->products = [];
            }
        } finally {
            $this->isLoading = false;
            $this->isMoreLoading = false;
        }
    }

    public function goToPage($page)
    {
        if ($page === '...' || !is_numeric($page)) {
            return;
        }

        $page = (int) $page;
        if ($page < 1) return;

        $targetStartIndex = ($page - 1) * $this->perPage;

        if ($targetStartIndex >= count($this->products) && $this->hasMore && !$this->isMoreLoading) {
            $this->fetchProducts($this->apiPage + 1);
        }

        $this->currentPage = $page;
    }

    public function nextPage()
    {
        $totalLoaded = count($this->products);
        $maxLocalPage = (int) ceil($totalLoaded / $this->perPage);

        if ($this->currentPage < $maxLocalPage) {
            $this->currentPage++;
        } elseif ($this->hasMore && !$this->isMoreLoading) {
            $this->fetchProducts($this->apiPage + 1);
            $this->currentPage++;
        }
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function getPaginationRangeProperty(): array
    {
        $totalLoaded = count($this->products);
        $totalPages = (int) ceil($totalLoaded / $this->perPage);

        if ($this->hasMore && $totalPages > 0 && ($totalPages * $this->perPage) === $totalLoaded) {
            $totalPages++;
        }

        $totalPages = max(1, $totalPages);

        if ($totalPages <= 7) {
            return range(1, $totalPages);
        }

        $current = $this->currentPage;
        $range = [];
        $range[] = 1;

        if ($current > 3) {
            $range[] = '...';
        }

        $start = max(2, $current - 1);
        $end   = min($totalPages - 1, $current + 1);

        for ($i = $start; $i <= $end; $i++) {
            $range[] = $i;
        }

        if ($current < $totalPages - 2) {
            $range[] = '...';
        }

        $range[] = $totalPages;

        return $range;
    }

    public function filterCategories() {}

    public function render()
    {
        $startIndex = ($this->currentPage - 1) * $this->perPage;
        $currentProducts = array_slice($this->products, $startIndex, $this->perPage);

        $totalLoaded = count($this->products);
        $totalPages = (int) ceil($totalLoaded / $this->perPage);

        if ($this->hasMore && $totalPages > 0 && ($totalPages * $this->perPage) === $totalLoaded) {
            $totalPages++;
        }

        return view('livewire.pages.shop', [
            'currentProducts' => $currentProducts,
            'totalPages'      => max(1, $totalPages),
            'paginationRange' => $this->paginationRange,
        ])->layout("layouts.pages.app");
    }
}