<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;

class QrCheckIn extends Component
{
    public $booking; // the booking object
    public $showQr = false;

    // Receive booking from parent
    public function mount(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function toggleQr()
    {
        $this->showQr = !$this->showQr;
    }

    public function render()
    {
        return view('livewire.admin.qr-check-in');
    }
}








