<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingHistory extends Component
{
    use WithPagination;

    public function render()
    {
        $bookings = Booking::with('court')
            ->where('user_id', Auth::id())
            ->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate(10);

        return view('livewire.user.booking-history', [
            'bookings' => $bookings
        ]);
    }
}
