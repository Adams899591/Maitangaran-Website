<?php
namespace App\Livewire\Pages\Home;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FeaturedSection extends Component
{
    public array $products = [];
    public bool $isLoading = true;
    public bool $networkError = false;
    public string $imageDomain;

    public function mount()
    {
        $this->fetchFeaturedProducts();
        $this->imageDomain = config('services.ecommerce.image_domain');
    }

    public function fetchFeaturedProducts()
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
            ])->get("{$baseUrl}/products/featured");

            if ($response->successful() && $response->json('Success')) {
                // Fix: Target 'Items' inside 'Data'
                $data = $response->json('Data') ?? [];
                $this->products = $data['Items'] ?? (is_array($data) && array_is_list($data) ? $data : []);
            } else {
                $this->products = [];
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching featured products: ' . $th->getMessage());
            $this->networkError = true;
            $this->products = [];
        } finally {
            $this->isLoading = false;
        }
    }

    public function render()
    {
        return view('livewire.pages.home.featured-section');
    }
}