<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Book a Court</h2>

            <form wire:submit.prevent="store">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Select Court</label>
                    <select wire:model="court_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">-- Choose a Court --</option>
                        @foreach($courts as $court)
                            <option value="{{ $court->court_id }}">{{ $court->court_name }} ({{ $court->court_type }})</option>
                        @endforeach
                    </select>
                    @error('court_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Date</label>
                    <input type="date" wire:model="booking_date" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('booking_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Start Time</label>
                        <input type="time" wire:model="start_time" class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('start_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">End Time</label>
                        <input type="time" wire:model="end_time" class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('end_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <button type="button" wire:click="checkAvailability" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Check Availability
                    </button>
                    
                    @if($availabilityMessage)
                        <div class="mt-2 p-2 rounded {{ $isAvailable ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $availabilityMessage }}
                        </div>
                    @endif
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                        class="bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-3 px-6 rounded shadow-lg disabled:opacity-50"
                        @if(!$isAvailable) disabled @endif>
                        Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>