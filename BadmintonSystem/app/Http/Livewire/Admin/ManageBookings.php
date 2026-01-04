<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;

class ManageBookings extends Component
{
    use WithPagination;

    // Action 1: Approve
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'approved']); // <--- The "Switch"
        session()->flash('message', 'Booking Approved!');
    }

    // Action 2: Reject
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'rejected']);
        session()->flash('message', 'Booking Rejected.');
    }

    public function render()
    {
        // Fetch all bookings, sorted so "Pending" ones are at the top
        $bookings = Booking::with(['user', 'court'])
            ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('livewire.admin.manage-bookings', [
            'bookings' => $bookings
        ]); // Livewire automatically uses layouts.app
    }

    public function mount()
{
    // SECURITY CHECK
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized access.');
    }
}
}
