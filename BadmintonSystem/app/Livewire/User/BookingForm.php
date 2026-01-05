<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Court;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingForm extends Component
{
    public $court_id, $booking_date, $start_time, $duration = 1;
    public $availabilityMessage, $isAvailable = false;
    public $availableTimes = [];
    public $courts;

    public function mount()
    {
        $this->courts = Court::where('status','active')->get();
    }

    public function updatedCourtId() { $this->resetAvailability(); }
    public function updatedBookingDate() { $this->resetAvailability(); }

    private function resetAvailability()
    {
        $this->reset(['start_time','availableTimes','availabilityMessage','isAvailable']);
    }

    public function checkAvailability()
    {
        if(!$this->court_id || !$this->booking_date){
            $this->availabilityMessage = "Select court and date first.";
            return;
        }

        $slots = [
            'Morning'   => ['06:00:00','07:00:00','08:00:00','09:00:00','10:00:00','11:00:00'],
            'Afternoon' => ['12:00:00','13:00:00','14:00:00','15:00:00','16:00:00'],
            'Evening'   => ['17:00:00','18:00:00','19:00:00','20:00:00','21:00:00','22:00:00','23:00:00'],
        ];

        $bookings = Booking::where('court_id',$this->court_id)
            ->where('booking_date',$this->booking_date)
            ->where('status','approved')
            ->get();

        foreach($bookings as $booking){
            $start = Carbon::parse($booking->start_time);
            $end   = Carbon::parse($booking->end_time);

            foreach($slots as $period => $times){
                $slots[$period] = array_values(array_filter($times, function($time) use ($start,$end){
                    $slot = Carbon::parse($time);
                    return !($slot >= $start && $slot < $end);
                }));
            }
        }

        $this->availableTimes = $slots;
        $this->isAvailable = true;
        $this->availabilityMessage = "Available slots loaded.";
    }

    public function store()
    {
        $this->validate([
            'court_id'=>'required',
            'booking_date'=>'required|date',
            'start_time'=>'required',
            'duration'=>'required|min:1'
        ]);

        $start = Carbon::parse($this->start_time);
        $end = $start->copy()->addHours($this->duration);

        Booking::create([
            'user_id'=>Auth::id(),
            'court_id'=>$this->court_id,
            'booking_date'=>$this->booking_date,
            'start_time'=>$start->format('H:i:s'),
            'end_time'=>$end->format('H:i:s'),
            'status'=>'pending',
        ]);

        session()->flash('message','Booking successful!');
        $this->reset();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.user.booking-form');
    }
}























