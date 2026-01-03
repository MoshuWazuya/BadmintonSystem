<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-4">

            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-500 text-sm">Total Users</h3>
                <p class="text-2xl font-bold">{{ $totalUsers }}</p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-500 text-sm">Total Bookings</h3>
                <p class="text-2xl font-bold">{{ $totalBookings }}</p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-500 text-sm">Pending Approvals</h3>
                <p class="text-2xl font-bold text-indigo-600">{{ $pendingApprovals }}</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Recent Bookings</h3>
                <ul class="space-y-3">
                    @forelse($recentBookings as $booking)
                        <li class="flex justify-between items-center bg-gray-50 p-3 rounded">
                            <div>
                                <span class="font-bold">{{ $booking->user->name }}</span> 
                                <span class="text-gray-600">booked</span> 
                                <span class="font-bold text-indigo-600">
                                    {{ $booking->court->court_name ?? 'Court #'.$booking->court_id }}
                                </span>
                            </div>
                            <span class="text-sm text-gray-500">{{ $booking->booking_date }}</span>
                        </li>
                    @empty
                        <li class="text-gray-500 italic">No bookings found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>