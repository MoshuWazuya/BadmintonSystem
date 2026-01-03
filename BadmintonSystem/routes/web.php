<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

// Import Livewire Components
use App\Http\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\ManageBookings;
use App\Http\Livewire\User\BookingForm;
use App\Http\Livewire\User\BookingHistory;
use App\Http\Livewire\User\UserProfile;

Route::get('/', function () {
    return view('welcome');
});

// 1. DASHBOARD "TRAFFIC COP"
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');
});

// 2. USER ROUTES
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/book-court', BookingForm::class)->name('user.book');
    Route::get('/my-bookings', BookingHistory::class)->name('user.bookings');
    Route::get('/profile', UserProfile::class)->name('user.profile');
});

// 3. ADMIN ROUTES (Simplified)
Route::middleware(['auth:sanctum', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        // We removed the complex "Wall" closure here to fix the crash
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/bookings', ManageBookings::class)->name('bookings');

    });