<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;

class QRCheckIn extends Component
{
    public $qr_code;
    public $message;

    public function checkIn()
    {
        $booking = Booking::where('qr_code', $this->qr_code)->first();

        if (!$booking) {
            $this->message = 'Invalid QR Code';
            return;
        }

        $booking->checked_in = true;
        $booking->save();

        $this->message = 'Check-in successful';
    }

    public function render(): mixed
    {
        return view('livewire.admin.qr-check-in');
    }
}
