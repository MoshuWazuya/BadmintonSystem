<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

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
                    <h3 class="text-gray-600">Today’s Bookings</h3>
                    <p class="text-2xl font-bold">{{ $todaysBookings }}</p>
                </div>

                <div class="bg-white p-4 rounded shadow text-center">
                    <h3 class="text-gray-600">Pending Bookings</h3>
                    <p class="text-2xl font-bold">{{ $pendingBookings }}</p>
                </div>
            </div>

            {{-- Recent Bookings Table --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h3 class="text-lg font-semibold mb-4">Recent Bookings</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Court</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentBookings as $booking)
                                <tr>
                                    <td class="px-6 py-4">{{ $booking->id }}</td>
                                    <td class="px-6 py-4">{{ $booking->user->name }}</td>
                                    <td class="px-6 py-4">{{ $booking->court->name ?? $booking->court_id }}</td>
                                    <td class="px-6 py-4">{{ $booking->booking_date->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4">{{ ucfirst($booking->status) }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="text-indigo-600 hover:underline">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No bookings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
