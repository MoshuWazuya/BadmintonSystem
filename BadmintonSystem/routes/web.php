<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

<<<<<<< HEAD
// Admin Livewire components
use App\Http\Livewire\Admin\Dashboard as AdminDashboard;
use App\Http\Livewire\Admin\ManageBookings;

// User Livewire components
=======
// Import Livewire Components
use App\Http\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\ManageBookings;
>>>>>>> 67b8716ff26043a55e683d81050e02994dd59e78
use App\Http\Livewire\User\BookingForm;
use App\Http\Livewire\User\BookingHistory;
use App\Http\Livewire\User\UserProfile;

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

=======
>>>>>>> 67b8716ff26043a55e683d81050e02994dd59e78
Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

=======
// 1. DASHBOARD "TRAFFIC COP"
>>>>>>> 67b8716ff26043a55e683d81050e02994dd59e78
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // USER DASHBOARD (Your Part)
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

<<<<<<< HEAD
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
=======
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
>>>>>>> 67b8716ff26043a55e683d81050e02994dd59e78
