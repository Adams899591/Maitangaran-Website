<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ChangePassword extends Component
{
    public $current_password = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'current_password' => 'required|string',
        'password' => 'required|string|min:6|confirmed',
    ];

    public function updatePassword()
    {
        $this->validate();

        $token = session('api_token'); // Adjust according to how you store your API token
        $baseUrl = config('services.ecommerce.url');
        $apiKey = config('services.ecommerce.api');

        try {
            // Send PUT request to your external API matching your React Native implementation
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'X-Api-Key'     => $apiKey,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->put($baseUrl . '/auth/change-password', [
                'oldPassword' => $this->current_password,
                'newPassword' => $this->password,
            ]);

            $data = $response->json();

            if ($response->successful() && (($data['success'] ?? false) === true || ($data['Success'] ?? false) === true)) {
                // Reset form fields
                $this->reset(['current_password', 'password', 'password_confirmation']);

                session()->flash('success', $data['message'] ?? 'Password changed successfully!');
            } else {
                session()->flash('error', $data['message'] ?? 'Failed to change password. Please verify your current password.');
            }

        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred while changing password. Please check your network connectivity.');
        }
    }

    public function render()
    {
        return view('livewire.user.change-password')->layout("layouts.user.app");
    }
}