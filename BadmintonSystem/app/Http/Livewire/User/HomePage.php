<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Court;

class HomePage extends Component
{
    public function render(): mixed
    {
        return view('livewire.home-page', [
            'courts' => Court::all()
        ]);
    }
}
