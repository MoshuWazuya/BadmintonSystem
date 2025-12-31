<?php

namespace App\Livewire\Admin;

use Livewire\Component;
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
        // General Counters
        $this->totalBookings = Booking::count();
        $this->pendingApprovals = Booking::where('status', 'pending')->count();

        // 1. Most Frequently Booked Courts
        $this->popularCourts = Booking::select('court_id', DB::raw('count(*) as total'))
            ->groupBy('court_id')
            ->orderByDesc('total')
            ->with('court')
            ->take(5)
            ->get();

        // 2. Peak Booking Hours
        // Extracts the hour from start_time to find busiest slots
        $this->peakHours = Booking::select(DB::raw('HOUR(start_time) as hour'), DB::raw('count(*) as count'))
            ->groupBy('hour')
            ->orderByDesc('count')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('layouts.app');
    }
}
