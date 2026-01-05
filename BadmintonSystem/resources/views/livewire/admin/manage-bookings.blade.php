<div class="p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Manage Bookings (Approve / Reject / Delete / QR Check-In)</h2>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Booking ID</th>
                    <th class="border p-2">User</th>
                    <th class="border p-2">Court</th>
                    <th class="border p-2">Date & Time</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Checked In</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td class="border p-2">{{ $booking->booking_id }}</td>
                        <td class="border p-2">{{ $booking->user->name }}</td>
                        <td class="border p-2">{{ $booking->court->court_name ?? 'Unknown' }}</td>
                        <td class="border p-2">
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}<br>
                            {{ $booking->start_time }} - {{ $booking->end_time }}
                        </td>
                        <td class="border p-2">{{ ucfirst($booking->status) }}</td>
                        <td class="border p-2">{{ $booking->checked_in ? 'Yes' : 'No' }}</td>
                        <td class="border p-2 space-x-2">
                            @if($booking->status === 'pending')
                                <button wire:click="approveBooking({{ $booking->booking_id }})" class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
                                <button wire:click="rejectBooking({{ $booking->booking_id }})" class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                            @endif

                            @if($booking->status !== 'pending' || $booking->status === 'approved' || $booking->status === 'rejected')
                                <button wire:click="deleteBooking({{ $booking->booking_id }})" class="bg-gray-600 text-white px-2 py-1 rounded">Delete</button>
                            @endif

                            <livewire:admin.qr-check-in :bookingId="$booking->booking_id" key="{{ $booking->booking_id }}" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500">No bookings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

