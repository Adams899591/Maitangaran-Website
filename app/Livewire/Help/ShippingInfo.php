<?php

namespace App\Livewire\Help;

use Livewire\Component;

class ShippingInfo extends Component
{
    public function render()
    {
        return view('livewire.help.shipping-info')->layout("layouts.pages.app");
    }
}
