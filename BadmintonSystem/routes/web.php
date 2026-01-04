<?php

use Illuminate\Support\Facades\Route;

// Admin Livewire components
use App\Http\Livewire\Admin\Dashboard as AdminDashboard;
use App\Http\Livewire\Admin\ManageBookings;

// User Livewire components
use App\Http\Livewire\User\BookingForm;
use App\Http\Livewire\User\BookingHistory;
use App\Http\Livewire\User\UserProfile;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // USER DASHBOARD (Your Part)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // USER FEATURES
    Route::get('/bookcourt', BookingForm::class)->name('user.book');
    Route::get('/mybookings', BookingHistory::class)->name('user.bookings');
    Route::get('/profile', UserProfile::class)->name('user.profile');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'isAdmin'
])->group(function () {

    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/admin/bookings', ManageBookings::class)->name('admin.bookings');

});
