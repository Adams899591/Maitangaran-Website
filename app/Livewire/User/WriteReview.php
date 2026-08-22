<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class WriteReview extends Component
{
    public string $productId = '';
    public int $rating = 3;
    public string $comment = '';
    
    // UI state variables
    public bool $isSubmitting = false;
    public string $errorMessage = '';
    public string $successMessage = '';

    protected $queryString = [
        'productId' => ['except' => ''],
    ];

    public function mount()
    {
        // Capture productId from query string if passed via route parameter
        if (request()->has('productId')) {
            $this->productId = request()->query('productId');
        }
    }

    public function rules()
    {
        return [
            'productId' => 'required|string',
            'rating'    => 'required|integer|min:1|max:5',
            'comment'   => 'nullable|string|max:1000',
        ];
    }

    public function submitReview()
    {
        $this->validate();
        $this->resetMessages();
        $this->isSubmitting = true;

        $token   = session('api_token');
        $baseUrl = config('services.ecommerce.url');
        $apiKey  = config('services.ecommerce.api');
       
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'X-Api-Key'     => $apiKey,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->post("{$baseUrl}/products/reviews", [
                'productID' => $this->productId,
                'rating'    => $this->rating,
                'comment'   => $this->comment ?? '',
            ]);


            $data = $response->json();

            Log::info($response);
        
            if ($response->successful() && ($data['Success'] ?? false) === true) {
                $this->successMessage = $data['Message'] ?? 'Review submitted successfully!';
                
                // Redirect back to pending reviews list after 2 seconds
                // $this->dispatch('review-submitted');
                // return redirect()->route('my-review')->with('success', 'Review submitted successfully!');
            } else {
                // Parse API business/validation error message
                $this->errorMessage = $data['Message'] ?? $data['Message'] ?? 'Failed to submit review. Please try again.';
            }
        } catch (\Throwable $th) {
            Log::error('Submit Review Error: ' . $th->getMessage());
            $this->errorMessage = 'An unexpected error occurred while submitting your review.';
        }
        
        finally {
            $this->isSubmitting = false;
        }
    }

    public function setRating(int $value)
    {
        $this->rating = $value;
    }

    private function resetMessages()
    {
        $this->errorMessage = '';
        $this->successMessage = '';
    }

    public function render()
    {
        return view('livewire.user.write-review')->layout("layouts.user.app");
    }
}
