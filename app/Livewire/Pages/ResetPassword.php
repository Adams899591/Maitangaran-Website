<?php

// namespace App\Livewire\Pages;

// use Livewire\Component;

// class ResetPassword extends Component
// {
//     public function render()
//     {
//         return view('livewire.pages.reset-password')->layout("layouts.pages.app");
//     }
// }





namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ResetPassword extends Component
{
    public string $token = '';
    public string $password = '';
    public string $password_confirmation = '';

    public bool $isLoading = false;
    public ?string $successMessage = null;
    public ?string $errorMessage = null;

    protected array $rules = [
        'token'                 => 'required|string',
        'password'              => [
            'required',
            'string',
            'min:8',
            'regex:/[A-Z]/',      // Uppercase
            'regex:/[a-z]/',      // Lowercase
            'regex:/[0-9]/',      // Number
            'regex:/[@$!%*?&#]/', // Special character
        ],
        'password_confirmation' => 'required|same:password',
    ];

    protected array $messages = [
        'password.min'                  => 'Password must be at least 8 characters long.',
        'password.regex'                => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        'password_confirmation.same'    => 'Passwords do not match.',
    ];

    public function mount()
    {
        // Automatically grabs the token from the URL query string: domain.com/reset-password?token=XYZ
        $this->token = request()->query('token', '');
    }

    public function resetPassword()
    {
        $this->validate();

        $this->isLoading = true;
        $this->successMessage = null;
        $this->errorMessage = null;

        try {
            $baseUrl = config('services.ecommerce.url');
            $apiKey  = config('services.ecommerce.api');

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->post("{$baseUrl}/auth/reset-password", [
                'token'           => $this->token,
                'newPassword'     => $this->password,
                'confirmPassword' => $this->password_confirmation,
            ]);

            if ($response->successful()) {
                $this->successMessage = $response->json('message') ?? 'Password has been reset successfully.';
                $this->reset(['password', 'password_confirmation']);
            } else {
                $this->errorMessage = $response->json('message') ?? 'Failed to reset password. Token may be invalid or expired.';
            }
        } catch (\Throwable $th) {
            Log::error('Error resetting password: ' . $th->getMessage());
            $this->errorMessage = 'A network error occurred. Please try again later.';
        } finally {
            $this->isLoading = false;
        }
    }

    public function render()
    {
        return view('livewire.pages.reset-password')->layout("layouts.pages.app");
    }
}