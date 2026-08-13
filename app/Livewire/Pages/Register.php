<?php

// namespace App\Livewire\Pages;

// use Livewire\Component;

// class Register extends Component
// {
//     public function render()
//     {
//         return view('livewire.pages.register')->layout("layouts.pages.app");
//     }
// }











namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Register extends Component
{
    public $fullname = '';
    public $username = '';
    public $email = '';
    public $phone = '';
    public $address = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'fullname' => 'required|string|min:2',
        'username' => 'required|string|min:3',
        'email' => 'required|email',
        'phone' => 'required|string|min:8',
        'address' => 'required|string|min:5',
        'password' => 'required|min:6|same:password_confirmation',
    ];

    protected $messages = [
        'password.same' => 'Passwords do not match.',
    ];

    public function register()
    {
        $this->validate();

        $baseUrl = config('services.ecommerce.url');
        $apiKey  = config('services.ecommerce.api');

        try {
            // Match the exact API payload used in React Native handleSignUp
            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->post("{$baseUrl}/auth/signup", [
                'customerName' => trim($this->fullname),
                'email'        => trim($this->email),
                'phone'        => trim($this->phone),
                'username'     => trim($this->username),
                'password'     => trim($this->password),
                'address'      => trim($this->address),
            ]);

            Log::info('Registration response: ', $response->json() ?? []);

            $data = $response->json();

            // Match structural success check from React Native code
            if ($response->successful() && (($data['Success'] ?? false) || isset($data['customerName']))) {
                session()->flash('message', 'Account created successfully! Please sign in.');
                return redirect()->route('login');
            } else {
                $serverMessage = $data['Message'] ?? $data['message'] ?? 'Registration failed. Please try again.';
                $this->addError('email', $serverMessage);
            }

        } catch (\Throwable $th) {
            Log::error('Registration Error: ' . $th->getMessage());
            $this->addError('email', 'Unable to connect to server. Please check your connectivity.');
        }
    }

    public function render()
    {
        return view('livewire.pages.register')->layout('layouts.pages.app');
    }
}