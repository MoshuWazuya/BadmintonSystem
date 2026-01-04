<?php

use Illuminate\Support\Facades\Route;

// Admin Livewire components 
use App\Http\Livewire\Admin\Dashboard as AdminDashboard;
use App\Http\Livewire\Admin\ManageBookings;
use App\Http\Livewire\Admin\QRCheckIn;

// User Livewire components 
use App\Http\Livewire\User\Dashboard as UserDashboard;
use App\Http\Livewire\User\BookingForm;
use App\Http\Livewire\User\BookingHistory;
use App\Http\Livewire\User\UserProfile;
use App\Http\Livewire\User\HomePage;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', HomePage::class)->name('home');;

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD 
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', UserDashboard::class)
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | USER FEATURES
    |--------------------------------------------------------------------------
    */
    Route::get('/bookcourt', BookingForm::class)
        ->name('user.book');

    Route::get('/mybookings', BookingHistory::class)
        ->name('user.bookings');

    Route::get('/profile', UserProfile::class)
        ->name('user.profile');
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
    'isAdmin',
])->group(function () {

    Route::get('/admin/dashboard', AdminDashboard::class)
        ->name('admin.dashboard');

    Route::get('/admin/bookings', ManageBookings::class)
        ->name('admin.bookings');

    Route::get('/admin/check-in', QRCheckIn::class)
        ->name('admin.checkin');
});
