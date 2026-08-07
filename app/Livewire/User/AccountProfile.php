<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AccountProfile extends Component
{

   public $fullname;
   public $username;
   public $email;
   public $phone;
   public $address;
   public $state;
   public $PrefferedAddress;

    public function mount(){

        $user = session("user");    // get the user stored on session

        $this->fullname = $user["CustomerName"];
        $this->username = $user["Username"];
        $this->email = $user["Email"];
        $this->phone = $user["Phone"];
        $this->address = $user["Address"];
        $this->state = $user["PrefferedState"];
        $this->PrefferedAddress = $user["PrefferedAddress"];
    }


    //  function to update user profile
    public function updateProfile(){


            $token = session('api_token'); // Or session('token') depending on how you stored it
            $baseUrl = config('services.ecommerce.url');
            $apiKey = config('services.ecommerce.api');

            try {
                    // Send PUT request matching your React Native Axios setup
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token,
                        'X-Api-Key'     => $apiKey,
                        'Content-Type'  => 'application/json',
                        'Accept'        => 'application/json',
                    ])->put($baseUrl . '/auth/profile/update', [
                        'customerName'     => $this->fullname,
                        'email'            => $this->email,
                        'phone'            => $this->phone,
                        'address'          => $this->address,
                        'prefferedAddress' => $this->prefferedAddress ?? $this->address,
                        'prefferedState'   => $this->state,
                    ]);

                    $data = $response->json();

                    if ($response->successful() && ($data['Success'] ?? false) === true) {
                        // Update the user session with the newly returned details
                        $currentUser = session('user', []);
                        $updatedCustomerDetails = $data['Data'];

                        // Merge updated profile fields into existing session user
                        $mergedUser = array_merge($currentUser, $updatedCustomerDetails);
                        session(['user' => $mergedUser]);

                        session()->flash('success', 'User details updated successfully');
                    } else {
                        session()->flash('error', $data['Message'] ?? 'Unable to update user details');
                    }

            } catch (\Throwable $th) {
        session()->flash('error', 'An error occurred while updating profile.');
            }
    }


    public function render()
    {
        return view('livewire.user.account-profile')->layout("layouts.user.app");
    }
}
