<div>
    <h2>QR Code Check-In</h2>

    <input type="text" wire:model="qr_code" placeholder="Scan QR Code">

    <button wire:click="checkIn">Check In</button>

    @if($message)
        <p>{{ $message }}</p>
    @endif
</div>
