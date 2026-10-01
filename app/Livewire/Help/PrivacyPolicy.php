<?php

namespace App\Livewire\Help;

use Livewire\Component;

class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.help.privacy-policy')->layout("layouts.pages.app");
    }
}
