<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class MyReview extends Component
{


    public function render()
    {
        return view('livewire.user.my-review')->layout("layouts.user.app");
    }
} 

