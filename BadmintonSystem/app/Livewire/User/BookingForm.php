<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Court;
use App\Models\Booking;
use App\Models\CourtSchedule;
use Illuminate\Support\Facades\Auth;

class BookingForm extends Component
{
    public $courts;
    public $court_id;
    public $booking_date;
    public $start_time;
    public $end_time;
    public $availabilityMessage = '';
    public $isAvailable = false;

    protected $rules = [
        'court_id' => 'required|exists:courts,court_id',
        'booking_date' => 'required|date|after_or_equal:today',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
    ];

    public function mount()
    {
        // Fetch all active courts for the dropdown
        $this->courts = Court::where('status', 'active')->get();
    }

    public function checkAvailability()
    {
        $this->validate();

        // Check if court is in maintenance
        $court = Court::find($this->court_id);
        if ($court->status === 'maintenance') {
            $this->availabilityMessage = 'This court is currently under maintenance.';
            $this->isAvailable = false;
            return;
        }

        // Check for overlapping bookings in the 'bookings' table
        $exists = Booking::where('court_id', $this->court_id)
            ->where('booking_date', $this->booking_date)
            ->where('status', '!=', 'rejected') // Ignore rejected bookings
            ->where(function ($query) {
                $query->whereBetween('start_time', [$this->start_time, $this->end_time])
                      ->orWhereBetween('end_time', [$this->start_time, $this->end_time])
                      ->orWhere(function ($q) {
                          $q->where('start_time', '<=', $this->start_time)
                            ->where('end_time', '>=', $this->end_time);
                      });
            })
            ->exists();

        if ($exists) {
            $this->availabilityMessage = 'Court is NOT available at this time.';
            $this->isAvailable = false;
        } else {
            $this->availabilityMessage = 'Court is available!';
            $this->isAvailable = true;
        }
    }

    public function store()
    {
        if (!$this->isAvailable) {
            return;
        }

        // Create the booking record
        Booking::create([
            'user_id' => Auth::id(),
            'court_id' => $this->court_id,
            'booking_date' => $this->booking_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => 'pending' // Default status as per requirements
        ]);

        session()->flash('message', 'Booking request submitted successfully! Pending approval.');
        return redirect()->route('user.bookings');
    }

    public function render()
    {
        return view('livewire.user.booking-form');
    }
}
