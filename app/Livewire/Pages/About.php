<?php

// namespace App\Livewire\Pages;

// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Log;
// use Livewire\Component;

// class About extends Component
// {

//        public function mount()
//     {
//         $this->about();
       
//     }

//    public function about(){
//             $baseUrl = config('services.ecommerce.url');
//             $apiKey  = config('services.ecommerce.api');

//             // Log::info("Fetching products page: {$pageNumber} from {$baseUrl}/products");

//             $response = Http::withHeaders([
//                 'X-Api-Key'    => $apiKey,
//                 'Content-Type' => 'application/json',
//                 'Accept'       => 'application/json',
//             ])->get("{$baseUrl}/company");

//             Log::info($response->json());
//    }


//     public function render()
//     {
//         return view('livewire.pages.about')->layout("layouts.pages.app");
//     }
// }





namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class About extends Component
{
    public array $company = [];
    public bool $isLoading = true;
    public bool $networkError = false;

    public function mount()
    {
        $this->about();
        // $this->Policy();
      
    }


//        public function Policy(){
//             $baseUrl = config('services.ecommerce.url');
//             $apiKey  = config('services.ecommerce.api');

//             // Log::info("Fetching products page: {$pageNumber} from {$baseUrl}/products");

//             $response = Http::withHeaders([
//                 'X-Api-Key'    => $apiKey,
//                 'Content-Type' => 'application/json',
//                 'Accept'       => 'application/json',
//             ])->get("{$baseUrl}/store/online-detail");

//             Log::info($response->json());
//    }










    public function about()
    {
        $this->isLoading = true;
        $this->networkError = false;

        try {
            $baseUrl = config('services.ecommerce.url');
            $apiKey  = config('services.ecommerce.api');

            $response = Http::withHeaders([
                'X-Api-Key'    => $apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->get("{$baseUrl}/company");

            if ($response->successful() && $response->json('Success')) {
                $this->company = $response->json('Data') ?? [];
            } else {
                $this->company = [];
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching company info in About component: ' . $th->getMessage());
            $this->networkError = true;
            $this->company = [];
        } finally {
            $this->isLoading = false;
        }
        //   $this->Policy();
    }

    public function render()
    {
        return view('livewire.pages.about')->layout("layouts.pages.app");
    }
}
