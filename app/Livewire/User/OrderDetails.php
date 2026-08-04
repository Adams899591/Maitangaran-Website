<?php

namespace App\Livewire\User;

use Livewire\Component;

class OrderDetails extends Component
{
    public function render()
    {
        return view('livewire.user.order-details')->layout("layouts.user.app");
    }
}
