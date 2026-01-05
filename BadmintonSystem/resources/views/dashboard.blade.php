<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-4 rounded shadow text-center">
                <h3 class="text-gray-600">Total Users</h3>
                <p class="text-2xl font-bold">{{ $totalUsers }}</p>
            </div>

            <div class="bg-white p-4 rounded shadow text-center">
                <h3 class="text-gray-600">Total Bookings</h3>
                <p class="text-2xl font-bold">{{ $totalBookings }}</p>
            </div>

            <div class="bg-white p-4 rounded shadow text-center">
                <h3 class="text-gray-600">Pending Approvals</h3>
                <p class="text-2xl font-bold">{{ $pendingApprovals }}</p>
            </div>

            <div class="bg-white p-4 rounded shadow text-center">
                <h3 class="text-gray-600">Popular Courts</h3>
                <ul class="text-left">
                    @foreach($popularCourts as $court)
                        <li>{{ $court->court->court_name ?? 'Unknown' }} ({{ $court->total }})</li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Manage Bookings Table --}}
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mb-6">
            <h3 class="text-lg font-semibold mb-4">Manage Bookings (Approve / Reject)</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th>Booking ID</th>
                            <th>User</th>
                            <th>Court</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBookings as $booking)
                            <tr>
                                <td>{{ $booking->booking_id }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->court->court_name ?? $booking->court_id }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}<br>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                                <td>{{ ucfirst($booking->status) }}</td>
                                <td>
                                    @if($booking->status === 'pending')
                                        <button wire:click="approveBooking({{ $booking->booking_id }})" class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
                                        <button wire:click="rejectBooking({{ $booking->booking_id }})" class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                                    @else
                                        <span>No actions</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-gray-500">No bookings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Court Management Table --}}
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-4">Court Management</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th>Court ID</th>
                            <th>Court Name</th>
                            <th>Court Type</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courts as $court)
                            <tr>
                                <td>{{ $court->court_id }}</td>
                                <td>{{ $court->court_name }}</td>
                                <td>{{ $court->court_type }}</td>
                                <td>{{ $court->location }}</td>
                                <td>{{ ucfirst($court->status) }}</td>
                                <td>
                                    <button wire:click="deleteCourt({{ $court->court_id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-gray-500">No courts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>






