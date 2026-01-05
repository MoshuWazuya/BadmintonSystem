<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingHistory extends Component
{
    public $bookings;
    public $showQrId = null;

    public function mount()
    {
        $this->loadBookings();
    }

    public function loadBookings()
    {
        $this->bookings = Booking::where('user_id', Auth::id())
            ->with('court')
            ->orderByDesc('booking_date')
            ->get();
    }

    public function deleteBooking($bookingId)
    {
        $booking = Booking::where('booking_id', $bookingId)
            ->where('user_id', Auth::id())
            ->first();

        if ($booking && !$booking->checked_in) {
            $booking->delete();
            $this->loadBookings();
        }
    }

    public function toggleQr($bookingId)
    {
        $this->showQrId = $this->showQrId === $bookingId ? null : $bookingId;
    }

    public function render()
    {
        return view('livewire.user.booking-history');
    }
}



