<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class SingleProductPage extends Component
{
    public function render()
    {
        return view('livewire.pages.single-product-page')->layout("layouts.pages.app");
    }
}
