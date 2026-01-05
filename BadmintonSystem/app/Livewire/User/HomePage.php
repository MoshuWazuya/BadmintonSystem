<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Court;

class HomePage extends Component
{
    public function render(): mixed
    {
        return view('livewire.user.home-page', [
            'courts' => Court::all()
        ]);
    }
}
