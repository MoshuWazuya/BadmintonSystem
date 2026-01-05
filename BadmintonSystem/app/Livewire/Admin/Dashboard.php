<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Booking;
use App\Models\Court;

class Dashboard extends Component
{
    public $totalUsers;
    public $totalBookings;
    public $pendingApprovals;
    public $popularCourts;
    public $recentBookings;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->totalUsers = User::count();
        $this->totalBookings = Booking::count();
        $this->pendingApprovals = Booking::where('status', 'pending')->count();
        // Popular courts: order by booking count
        $this->popularCourts = Court::withCount('bookings')->orderBy('bookings_count','desc')->take(5)->get();
        $this->recentBookings = Booking::latest()->take(5)->get();
    }

    public function approveBooking($id)
    {
        $booking = Booking::find($id);
        if ($booking && $booking->status === 'pending') {
            $booking->status = 'approved';
            $booking->save();
        }
        $this->loadStats();
    }

    public function rejectBooking($id)
    {
        $booking = Booking::find($id);
        if ($booking && $booking->status === 'pending') {
            $booking->status = 'rejected';
            $booking->save();

            // Reactivate court if no pending bookings
            $court = $booking->court;
            if ($court && $court->status === 'inactive') {
                $pending = $court->bookings()->where('status','pending')->count();
                if ($pending == 0) {
                    $court->status = 'active';
                    $court->save();
                }
            }
        }
        $this->loadStats();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}




















