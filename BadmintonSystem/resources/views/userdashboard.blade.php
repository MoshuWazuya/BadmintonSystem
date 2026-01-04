<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                {{-- Welcome --}}
                <h3 class="text-lg font-semibold mb-3">
                    Welcome, {{ Auth::user()->name }} 👋
                </h3>

                <p class="text-gray-700 mb-6">
                    This is your dashboard. You can manage your bookings and account here.
                </p>


                {{-- Quick Action Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    {{-- Book Court --}}
                    <a href="{{ route('user.book') }}"
                       class="block p-5 bg-indigo-100 hover:bg-indigo-200 rounded-lg transition">
                        <h4 class="font-bold mb-2">Book a Court</h4>
                        <p class="text-sm text-gray-700">
                            View available courts and make a booking.
                        </p>
                    </a>

                    {{-- My Bookings --}}
                    <a href="{{ route('user.bookings') }}"
                       class="block p-5 bg-green-100 hover:bg-green-200 rounded-lg transition">
                        <h4 class="font-bold mb-2">My Booking History</h4>
                        <p class="text-sm text-gray-700">
                            View your previous and upcoming bookings.
                        </p>
                    </a>

                    {{-- Profile --}}
                    <a href="{{ route('user.profile') }}"
                       class="block p-5 bg-yellow-100 hover:bg-yellow-200 rounded-lg transition">
                        <h4 class="font-bold mb-2">Profile Settings</h4>
                        <p class="text-sm text-gray-700">
                            Update your account information.
                        </p>
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
