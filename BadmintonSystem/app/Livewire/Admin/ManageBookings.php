<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;

class ManageBookings extends Component
{
    public $bookings;

    public function mount()
    {
        $this->loadBookings();
    }

    public function loadBookings()
    {
        $this->bookings = Booking::with(['user', 'court'])->orderBy('booking_date', 'desc')->get();
    }

    public function approveBooking($id)
    {
        $booking = Booking::find($id);
        if ($booking && $booking->status === 'pending') {
            $booking->status = 'approved';
            $booking->save();
            $this->loadBookings();
        }
    }

    public function rejectBooking($id)
    {
        $booking = Booking::find($id);
        if ($booking && $booking->status === 'pending') {
            $booking->status = 'rejected';
            $booking->save();
            $this->loadBookings();
        }
    }

    public function deleteBooking($id)
    {
        $booking = Booking::find($id);
        if ($booking) {
            $booking->delete();
            $this->loadBookings();
        }
    }

    public function render()
    {
        return view('livewire.admin.manage-bookings');
    }
}


