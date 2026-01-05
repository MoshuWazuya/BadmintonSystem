<div class="p-6 bg-white rounded shadow max-w-md mx-auto">

    <h2 class="text-2xl font-bold mb-6">Book a Court</h2>

    {{-- Success --}}
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="store" class="space-y-4">

        {{-- Court --}}
        <div>
            <label class="block font-semibold mb-1">Select Court</label>
            <select wire:model="court_id" class="w-full border p-2 rounded">
                <option value="">-- Choose Court --</option>
                @foreach($courts as $court)
                    <option value="{{ $court->court_id }}">
                        {{ $court->court_name }} ({{ $court->court_type }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Date --}}
        <div>
            <label class="block font-semibold mb-1">Date</label>
            <input type="date"
                wire:model="booking_date"
                class="w-full border p-2 rounded"
                min="{{ date('Y-m-d') }}">
        </div>

        {{-- Check Availability --}}
        <button type="button"
            wire:click="checkAvailability"
            class="bg-blue-600 text-white px-4 py-2 rounded w-full">
            Check Availability
        </button>

        {{-- Availability Message --}}
        @if($availabilityMessage)
            <div class="p-2 rounded {{ $isAvailable ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $availabilityMessage }}
            </div>
        @endif

        {{-- Start Time --}}
        @if($isAvailable)
            <div>
                <label class="block font-semibold mb-1">Start Time</label>

                @foreach($availableTimes as $period => $times)
                    <div class="mb-2">
                        <strong>{{ $period }}</strong>
                        <div class="flex flex-wrap gap-2 mt-1">
                            @foreach($times as $time)
                                <button type="button"
                                    wire:click="$set('start_time','{{ $time }}')"
                                    class="px-3 py-1 border rounded
                                        {{ $start_time === $time ? 'bg-blue-600 text-white' : 'bg-gray-100' }}">
                                    {{ \Carbon\Carbon::parse($time)->format('g:i A') }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Duration --}}
        <div>
            <label class="block font-semibold mb-1">Duration</label>
            <select wire:model="duration" class="w-full border p-2 rounded">
                @for($i = 1; $i <= 4; $i++)
                    <option value="{{ $i }}">{{ $i }} Hour{{ $i > 1 ? 's' : '' }}</option>
                @endfor
            </select>
        </div>

        {{-- BOOK NOW BUTTON --}}
        <button type="submit"
            class="bg-indigo-600 text-white py-3 rounded w-full font-bold
                {{ !$start_time ? 'opacity-50 cursor-not-allowed' : '' }}"
            @if(!$start_time) disabled @endif>
            Book Now
        </button>

    </form>
</div>





















