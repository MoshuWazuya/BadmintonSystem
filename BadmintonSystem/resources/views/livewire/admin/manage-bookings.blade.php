<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Bookings
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session()->has('message'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Court</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date/Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4">{{ $booking->user->name }}</td>
                                <td class="px-6 py-4">{{ $booking->court->court_name ?? 'Court #'.$booking->court_id }}</td>
                                <td class="px-6 py-4">
                                    {{ $booking->booking_date }}<br>
                                    <span class="text-xs text-gray-500">{{ $booking->start_time }} - {{ $booking->end_time }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $booking->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $booking->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    @if($booking->status === 'pending')
                                        <button wire:click="approve({{ $booking->booking_id }})" class="text-white bg-green-500 hover:bg-green-700 px-3 py-1 rounded mr-2">
                                            Approve
                                        </button>
                                        <button wire:click="reject({{ $booking->booking_id }})" class="text-white bg-red-500 hover:bg-red-700 px-3 py-1 rounded">
                                            Reject
                                        </button>
                                    @else
                                        <span class="text-gray-400">Completed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>