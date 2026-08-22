<?php
namespace App\Livewire\User;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CompletedReview extends Component
{
    public array $reviews = [];
    public bool $isLoading = true;

    public function mount()
    {
        $this->fetchUserAlreadyReview();
    }

    public function fetchUserAlreadyReview()
    {
        $this->isLoading = true;
        $token = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey = config('services.ecommerce.api');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'X-Api-Key'     => $apiKey,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->get("{$baseUrl}/products/reviews");

            $data = $response->json();
            Log::info($data);

            if ($response->successful() && ($data['Success'] ?? false) === true) {
                // Extracts the nested 'Items' array from Data response
                $this->reviews = $data['Data']['Items'] ?? [];
            } else {
                $this->reviews = [];
            }
        } catch (\Throwable $th) {
            Log::error('Fetch Completed Review Error: ' . $th->getMessage());
            $this->reviews = [];
        } finally {
            $this->isLoading = false;
        }
    }

    public function render()
    {
        return view('livewire.user.completed-review')->layout("layouts.user.app");
    }
}