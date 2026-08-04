<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class CartSuccess extends Component
{
    public function render()
    {
        return view('livewire.pages.cart-success')->layout("layouts.pages.app");
    }
}
