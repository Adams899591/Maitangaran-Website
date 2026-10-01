<?php

namespace App\Livewire\Help;

use Livewire\Component;

class TermsAndConditions extends Component
{
    public function render()
    {
        return view('livewire.help.terms-and-conditions')->layout("layouts.pages.app");
    }
}
