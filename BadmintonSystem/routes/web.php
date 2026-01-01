<?php

use Illuminate\Support\Facades\Route;

// Admin Livewire components
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\ManageBookings;

// User Livewire components
use App\Http\Livewire\User\BookingForm;
use App\Http\Livewire\User\BookingHistory;
use App\Http\Livewire\User\UserProfile;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Default Jetstream dashboard
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// User Routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/bookcourt', BookingForm::class)->name('user.book');
    Route::get('/mybookings', BookingHistory::class)->name('user.bookings');
    Route::get('/profile', UserProfile::class)->name('user.profile');
});

// Admin Routes
Route::middleware(['auth:sanctum', 'verified', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/bookings', ManageBookings::class)->name('admin.bookings');
});
