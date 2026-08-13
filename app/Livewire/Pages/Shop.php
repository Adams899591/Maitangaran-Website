<?php


namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Shop extends Component
{
    // API & Dataset state
    public array $products = [];
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
    public int $rangePrice = 9000;

    public function mount()
    {
        // DO NOT call fetchProducts(1) here. 
        // Wire-init will trigger it asynchronously once the skeleton is rendered on screen.
    }

    /**
     * Search products by search query input
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

            Log::info("Searching products with query: '{$query}'");

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/search", [
                'query' => $query,
            ]);

            if ($response->successful() && $response->json('Success')) {
                $this->products = $response->json('Data') ?? [];
                // Search endpoint returns all matches, so disable infinite API scroll pagination for search results
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
     * Fetch products chunk (20 products) from API
     */
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

            Log::info("Fetching products page: {$pageNumber} from {$baseUrl}/products");

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/products", [
                'page'  => $pageNumber,
                'limit' => 20,
            ]);

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