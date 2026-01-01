<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $totalBookings;
    public $pendingApprovals;
    public $popularCourts;
    public $peakHours;

    public function mount()
    {
        $this->totalBookings = Booking::count();
        $this->pendingApprovals = Booking::where('status', 'pending')->count();

        $this->popularCourts = Booking::with('court')
            ->select('court_id', DB::raw('count(*) as total'))
            ->groupBy('court_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $this->peakHours = Booking::select(DB::raw('HOUR(start_time) as hour'), DB::raw('count(*) as count'))
            ->groupBy('hour')
            ->orderByDesc('count')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalUsers' => User::count(),
            'totalBookings' => $this->totalBookings,
            'pendingApprovals' => $this->pendingApprovals,
            'popularCourts' => $this->popularCourts,
            'peakHours' => $this->peakHours,
            'recentBookings' => Booking::latest()->take(5)->get(), // include recent bookings
        ])->layout('layouts.app'); // optional Jetstream layout
    }
}
