<?php

namespace App\Livewire\User;

use Livewire\Component;

class AccountProfile extends Component
{
    public function render()
    {
        return view('livewire.user.account-profile')->layout("layouts.user.app");
    }
}
