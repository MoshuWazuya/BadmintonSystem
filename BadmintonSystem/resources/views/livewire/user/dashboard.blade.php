<div class="min-h-screen bg-gray-100">

    <!-- Top Navigation Bar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-16 items-center">

                <!-- Left: Logo / Title -->
                <div class="text-lg font-semibold text-gray-800">
                    Badminton System
                </div>

                <!-- Center: Navigation -->
                <div class="flex space-x-6">
                    <a href="{{ route('dashboard') }}"
                       class="text-gray-700 hover:text-blue-600 font-medium">
                        Dashboard
                    </a>

                    <a href="{{ route('user.book') }}"
                       class="text-gray-700 hover:text-blue-600 font-medium">
                        Book Court
                    </a>

                    <a href="{{ route('user.bookings') }}"
                       class="text-gray-700 hover:text-blue-600 font-medium">
                        My Bookings
                    </a>

                    <a href="{{ route('user.profile') }}"
                       class="text-gray-700 hover:text-blue-600 font-medium">
                        Profile
                    </a>
                </div>

                <!-- Right: User -->
                <div class="text-sm text-gray-600">
                    {{ auth()->user()->name }}
                </div>

            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            Welcome, {{ auth()->user()->name }}
        </h1>

        <p class="text-gray-500 mb-8">
            Manage your badminton court bookings easily
        </p>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-lg shadow p-6 text-center">
                <h2 class="text-lg font-semibold mb-2">Book Court</h2>
                <p class="text-gray-500 mb-4">Make a new booking</p>
                <a href="{{ route('user.book') }}"
                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Book Now
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 text-center">
                <h2 class="text-lg font-semibold mb-2">My Bookings</h2>
                <p class="text-gray-500 mb-4">View booking history</p>
                <a href="{{ route('user.bookings') }}"
                   class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    View
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 text-center">
                <h2 class="text-lg font-semibold mb-2">Profile</h2>
                <p class="text-gray-500 mb-4">Update your information</p>
                <a href="{{ route('user.profile') }}"
                   class="inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                    Edit Profile
                </a>
            </div>

        </div>
    </div>

</div>
