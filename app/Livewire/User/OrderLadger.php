<?php

namespace App\Livewire\User;

use Livewire\Component;

class OrderLadger extends Component
{
    public function render()
    {
        return view('livewire.user.order-ladger')->layout("layouts.user.app");
    }
}
