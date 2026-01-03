<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
        </x-slot>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-4">

                <!-- Total Users -->
                <div class="bg-white p-4 rounded shadow">
                    <h3>Total Users</h3>
                    <p class="text-2xl font-bold">{{ $totalUsers }}</p>
                </div>

                <!-- Total Bookings -->
                <div class="bg-white p-4 rounded shadow">
                    <h3>Total Bookings</h3>
                    <p class="text-2xl font-bold">{{ $totalBookings }}</p>
                </div>

                <!-- Pending Approvals -->
                <div class="bg-white p-4 rounded shadow">
                    <h3>Pending Approvals</h3>
                    <p class="text-2xl font-bold">{{ $pendingApprovals }}</p>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="bg-white mt-6 p-4 rounded shadow">
                <h3 class="text-lg font-semibold mb-2">Recent Bookings</h3>
                <ul>
                    @foreach($recentBookings as $booking)
                        <li>{{ $booking->user->name }} booked Court {{ $booking->court_id }} on {{ $booking->booking_date }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </x-app-layout>
</div>
