<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Admin Dashboard
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-gray-500">Pending Approvals</div>
                <div class="text-3xl font-bold text-indigo-600">{{ $pendingApprovals }}</div>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-gray-500">Total Bookings</div>
                <div class="text-3xl font-bold">{{ $totalBookings }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Top Courts</h3>
                <ul>
                    @foreach($popularCourts as $stat)
                        <li class="flex justify-between py-2 border-b">
                            <span>{{ $stat->court->court_name ?? 'Court #'.$stat->court_id }}</span>
                            <span class="font-bold">{{ $stat->total }} bookings</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Peak Hours</h3>
                <ul>
                    @foreach($peakHours as $stat)
                        <li class="flex justify-between py-2 border-b">
                            <span>{{ sprintf('%02d:00', $stat->hour) }}</span>
                            <span class="font-bold">{{ $stat->count }} sessions</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
