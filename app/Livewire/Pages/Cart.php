<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Cart extends Component
{
    public function render()
    {
        return view('livewire.pages.cart')->layout("layouts.pages.app");
    }
}
