<?php

use Illuminate\Support\Facades\Route;

// Admin Livewire Components
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\ManageBookings;
use App\Livewire\Admin\CourtManagement;
use App\Livewire\Admin\QrCheckIn;

// User Livewire Components
use App\Livewire\User\Dashboard as UserDashboard;
use App\Livewire\User\BookingForm;
use App\Livewire\User\BookingHistory;
use App\Livewire\User\UserProfile;
use App\Livewire\User\HomePage;

// Public
Route::get('/', HomePage::class)->name('home');

// Authenticated User
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', UserDashboard::class)->name('dashboard');
    Route::get('/bookcourt', BookingForm::class)->name('user.book');
    Route::get('/mybookings', BookingHistory::class)->name('user.bookings');
    Route::get('/profile', UserProfile::class)->name('user.profile');
});

// Admin
Route::prefix('admin')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'isAdmin'])->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/bookings', ManageBookings::class)->name('admin.bookings');
    Route::get('/courts', CourtManagement::class)->name('admin.courts');
    Route::get('/check-in', QrCheckIn::class)->name('admin.checkin');
});







