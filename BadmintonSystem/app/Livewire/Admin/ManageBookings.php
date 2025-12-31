namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;

class ManageBookings extends Component
{
    use WithPagination;

    // Approve Booking
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'approved']);
        
        // TODO: Trigger Email Notification
        // Notification::send($booking->user, new BookingApproved($booking));
        
        session()->flash('message', 'Booking approved successfully.');
    }

    // Reject Booking
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'rejected']);
        
        // TODO: Trigger Email Notification
        
        session()->flash('message', 'Booking rejected.');
    }

    public function render()
    {
        // Fetch pending bookings first, then others
        $bookings = Booking::with(['user', 'court'])
            ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('livewire.admin.manage-bookings', [
            'bookings' => $bookings
        ])->layout('layouts.app');
    }
}