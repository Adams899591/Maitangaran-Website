<?php

namespace App\Livewire\Pages\Home;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component; 

class BannerSection extends Component
{
    public function mount(){
        $this->fetchHomeBanner();
    }


   public function fetchHomeBanner(){
            $baseUrl = config('services.ecommerce.url');
            $apiKey  = config('services.ecommerce.api');

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/store/banners");

            Log::info($response->json());
   }



    public function render()
    {
        return view('livewire.pages.home.banner-section');
    }
}
