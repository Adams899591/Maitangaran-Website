<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Contact extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $message = '';

    public bool $networkError = false;
    public ?string $successMessage = null;
    public ?string $errorMessage = null;

    protected array $rules = [
        'name'    => 'required|string',
        'email'   => 'required|email',
        'phone'   => 'nullable|string',
        'message' => 'required|string',
    ];

    public function submit()
    {
        $this->validate();

        $this->networkError = false;
        $this->successMessage = null;
        $this->errorMessage = null;

        try {
            $baseUrl = config('services.ecommerce.url');
            $apiKey  = config('services.ecommerce.api');

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->post("{$baseUrl}/contact-us", [
                'name'    => $this->name,
                'email'   => $this->email,
                'phone'   => $this->phone,
                'message' => $this->message,
            ]);

            Log::info($response->json());


            if ($response->successful()) {
                $this->successMessage = $response->json('message') ?? 'Your message has been sent successfully!';
                $this->reset(['name', 'email', 'phone', 'message']);
            } else {
                $this->errorMessage = $response->json('message') ?? 'Failed to send message. Please try again.';
            }
        } catch (\Throwable $th) {
            Log::error('Error submitting contact form: ' . $th->getMessage());
            $this->errorMessage = 'A network error occurred. Please try again later.';
        }
    }

    public function render()
    {
        return view('livewire.pages.contact')->layout("layouts.pages.app");
    }
}