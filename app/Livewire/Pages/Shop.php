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
    public bool $isLoading = false;
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
        $this->fetchProducts(1);
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

            Log::info('Products API Response:', $response->json() ?? []);

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

    /**
     * Jump directly to a page number (4 products/page)
     */
    public function goToPage($page)
    {
        // Ignore clicks on '...'
        if ($page === '...' || !is_numeric($page)) {
            return;
        }

        $page = (int) $page;
        if ($page < 1) return;

        $targetStartIndex = ($page - 1) * $this->perPage;

        // Fetch next API chunk if user navigates past currently cached products
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

    /**
     * Computes a condensed/truncated pagination window array
     */
    public function getPaginationRangeProperty(): array
    {
        $totalLoaded = count($this->products);
        $totalPages = (int) ceil($totalLoaded / $this->perPage);

        // Append extra page tab if API has more available data
        if ($this->hasMore && $totalPages > 0 && ($totalPages * $this->perPage) === $totalLoaded) {
            $totalPages++;
        }

        $totalPages = max(1, $totalPages);

        // Show all page numbers if total pages are 7 or fewer
        if ($totalPages <= 7) {
            return range(1, $totalPages);
        }

        $current = $this->currentPage;
        $range = [];

        // Always show page 1
        $range[] = 1;

        if ($current > 3) {
            $range[] = '...';
        }

        // Window of pages surrounding the current page
        $start = max(2, $current - 1);
        $end   = min($totalPages - 1, $current + 1);

        for ($i = $start; $i <= $end; $i++) {
            $range[] = $i;
        }

        if ($current < $totalPages - 2) {
            $range[] = '...';
        }

        // Always show last page
        $range[] = $totalPages;

        return $range;
    }

    public function filterCategories()
    {
        // Category search logic placeholder
    }

    public function searchCategory()
    {
        // Form search logic placeholder
    }

    public function render()
    {
        // Slice the loaded 20-item chunk for the current 4-item view
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