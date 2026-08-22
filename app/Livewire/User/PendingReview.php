<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PendingReview extends Component
{
    public array $products = [];
    public bool $isLoading = true;
    public string $imageDomain = '';

    public function mount()
    {
        $this->imageDomain = config('services.ecommerce.image_domain', '');
        $this->fetchUserAvailableReview();
     
    }

    public function fetchUserAvailableReview(){
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
            ])->get("{$baseUrl}/products/available-for-review");

            $data = $response->json();
            Log::info($data);

            if ($response->successful() && ($data['Success'] ?? false) === true) {
                // If Data comes in as a string, decode it; otherwise use directly
                $this->products = is_string($data['Data'] ?? null) 
                    ? json_decode($data['Data'], true) 
                    : ($data['Data'] ?? []);
            } else {
                $this->products = [];
            }
        } catch (\Throwable $th) {
            Log::error('Fetch Review Error: ' . $th->getMessage());
            $this->products = [];
        } finally {
            $this->isLoading = false;
        }
    }


    public function writeReview($productId)
    {
        $this->redirectRoute('write-review',['productId' => $productId], navigate: true);
    }



    public function render()
    {
        return view('livewire.user.pending-review')->layout("layouts.user.app");
    }
}
