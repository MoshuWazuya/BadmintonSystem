<div class="p-6 bg-white rounded shadow">

    <h2 class="text-xl font-bold mb-4">Booking History</h2>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Booking ID</th>
                    <th class="border p-2">Court</th>
                    <th class="border p-2">Date & Time</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Checked In</th>
                    <th class="border p-2">Actions</th>
                    <th class="border p-2">QR Code</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td class="border p-2">{{ $booking->booking_id }}</td>

                        <td class="border p-2">
                            {{ $booking->court->court_name ?? 'N/A' }}
                        </td>

                        <td class="border p-2">
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}<br>
                            {{ $booking->start_time }} - {{ $booking->end_time }}
                        </td>

                        <td class="border p-2">
                            {{ ucfirst($booking->status) }}
                        </td>

                        <td class="border p-2">
                            {{ $booking->checked_in ? 'Yes' : 'No' }}
                        </td>

                        <td class="border p-2">
                            @if(!$booking->checked_in)
                                <button
                                    wire:click="deleteBooking({{ $booking->booking_id }})"
                                    class="bg-red-500 text-white px-2 py-1 rounded">
                                    Delete
                                </button>
                            @else
                                <span class="text-gray-400">Locked</span>
                            @endif
                        </td>

                        <td class="border p-2 text-center">
                            <button
                                wire:click="toggleQr({{ $booking->booking_id }})"
                                class="bg-blue-500 text-white px-2 py-1 rounded">
                                View QR
                            </button>

                            @if($showQrId === $booking->booking_id)
                                <div class="mt-2">
                                    <img
                                        src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $booking->qr_code }}"
                                        class="mx-auto"
                                        alt="QR Code">
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4">
                            No bookings found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>


