<div>
    <button wire:click="toggleQr" class="bg-blue-500 text-white px-2 py-1 rounded">
        {{ $showQr ? 'Hide QR' : 'View QR' }}
    </button>

    @if($showQr)
        <div class="mt-2 p-2 border rounded bg-gray-100">
            <!-- You can generate a real QR code using a package like SimpleSoftwareIO\QrCode -->
            <p>Booking ID: {{ $booking->booking_id }}</p>
            <p>User: {{ $booking->user->name }}</p>
            <p>Court: {{ $booking->court->court_name }}</p>
            <p>Status: {{ ucfirst($booking->status) }}</p>
            <p>QR Code: {{ $booking->qr_code }}</p>
        </div>
    @endif
</div>







