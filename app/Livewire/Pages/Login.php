<?php

namespace App\Livewire\Pages;

use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Login extends Component
{
    public $email; // (Note: You can keep the variable name $email from your form, but pass it as 'username' to the API)
    public $password;

    public function login()
    {
        $baseUrl = config('services.ecommerce.url');
        $apiKey = config('services.ecommerce.api');

        try {

        // Make the HTTP POST request matching your working React Native structure
        $response = Http::withHeaders([
            'X-Api-Key' => $apiKey, 
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($baseUrl . '/auth/login', [
            'username' => trim($this->email), // Sent as 'username' just like React Native
            'password' => trim($this->password),
        ]);
      

        if ($response->successful() && $response->json('Success')) {

                $customer = $response->json('Data.Customer');
                $token = $response->json('Data.Token');

                Log::info($response->json());

                // Save directly to session (like setting global state)
                session([
                    'user' => $customer,
                    'api_token' => $token
                ]);

                    session()->flash('message', 'Login successful!');
                    return redirect()->intended(route('dashboard'));
        }else {
                // Handle failed login
                $this->addError('email', 'Invalid credentials provided.');
        }

       } catch (\Throwable $th) {
                // Handle failed login
                $this->addError('email', 'Unable to connect to server.');
        }


    }

    public function render()
    {
        return view('livewire.pages.login')->layout('layouts.pages.app');
    }
}