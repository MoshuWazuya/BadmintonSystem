<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class BookingHistory extends Component
{
    use WithPagination;

    public function render()
    {
        // Fetch bookings for the logged-in user, ordered by most recent
        $bookings = Booking::where('user_id', Auth::id())
            ->with('court') // Eager load court data to avoid N+1 problem
            ->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate(10);

        return view('livewire.user.booking-history', [
            'bookings' => $bookings
        ]);
    }
}