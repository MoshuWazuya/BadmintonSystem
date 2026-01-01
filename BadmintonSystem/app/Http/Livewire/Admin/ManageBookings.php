<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;

class ManageBookings extends Component
{
    public function render()
    {
        $bookings = Booking::with(['user', 'court'])->orderBy('booking_date', 'desc')->get();

        return view('livewire.admin.manage-bookings', [
            'bookings' => $bookings
        ])->layout('layouts.app');
    }
}
