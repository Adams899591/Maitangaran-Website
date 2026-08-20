<?php

// namespace App\Livewire\Pages;

// use Livewire\Component;

// class ForgotPassword extends Component
// {
//     public function render()
//     {
//         return view('livewire.pages.forgot-password')->layout("layouts.pages.app");
//     }
// }





namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ForgotPassword extends Component
{
    public string $email = '';
    public bool $isLoading = false;
    public ?string $successMessage = null;
    public ?string $errorMessage = null;

    protected array $rules = [
        'email' => 'required|email',
    ];

    public function sendResetLink()
    {
        $this->validate();

        $this->isLoading = true;
        $this->successMessage = null;
        $this->errorMessage = null;

        try {
            $baseUrl = config('services.ecommerce.url');
            $apiKey  = config('services.ecommerce.api');

            // Set the frontend URL where users will be redirected to reset their password
            $resetLinkBaseUrl = url('/auth/reset-password');

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->post("{$baseUrl}/auth/forgot-password", [
                'email'            => $this->email,
                'resetLinkBaseUrl' => $resetLinkBaseUrl,
            ]);

            Log::info($response->json());


            if ($response->successful()) {
                $this->successMessage = $response->json('message') ?? 'A password reset link has been sent to your email address.';
                $this->reset('email');
            } else {
                $this->errorMessage = $response->json('message') ?? 'Unable to process your request. Please check the email provided.';
            }
        } catch (\Throwable $th) {
            Log::error('Error requesting password reset link: ' . $th->getMessage());
            $this->errorMessage = 'A network error occurred. Please try again later.';
        } finally {
            $this->isLoading = false;
        }
    }

    public function render()
    {
        return view('livewire.pages.forgot-password')->layout("layouts.pages.app");
    }
}