<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ViewingController;
use App\Http\Controllers\ViewingFeedbackController;
use App\Http\Controllers\RentalContractController;

use App\Http\Controllers\Staff\StaffHomeController;
use App\Http\Controllers\Admin\AdminHomeController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/properties', [PropertyController::class, 'index'])
    ->name('properties.index');

Route::get('/properties/{property}', [PropertyController::class, 'show'])
    ->name('properties.show');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard (redirect based on role)
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        return match($user->role) {
            'admin' => redirect()->route('admin.home'),
            'staff' => redirect()->route('staff.home'),
            default => redirect()->route('client.home'),
        };
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Client Home
    |--------------------------------------------------------------------------
    */

    Route::get('/client/home', function () {
        return view('home.client', [
            'featuredProperties' => \App\Models\Property::with(['owner', 'branch'])
                ->where('is_active', true)
                ->where('status', 'Available')
                ->latest('date_added')
                ->take(6)
                ->get(),
        ]);
    })->name('client.home');

    /*
    |--------------------------------------------------------------------------
    | Profile Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::middleware(['auth', 'verified', 'role:client,staff'])->group(function () {
        Route::get('/viewings/create', [ViewingController::class, 'create'])
            ->name('viewings.create');

        Route::post('/viewings', [ViewingController::class, 'store'])
            ->name('viewings.store');
    });

    Route::middleware(['auth', 'verified', 'role:client'])->group(function () {
        Route::get('/feedback/create', [ViewingFeedbackController::class, 'create'])
            ->name('feedback.create');

        Route::post('/feedback', [ViewingFeedbackController::class, 'store'])
            ->name('feedback.store');
    });
});

/*
|--------------------------------------------------------------------------
| Staff & Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:staff,admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Staff Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/staff/home', [StaffHomeController::class, 'index'])
        ->name('staff.home');

    /*
    |--------------------------------------------------------------------------
    | Property Management
    |--------------------------------------------------------------------------
    */

    Route::get('/staff/properties', [PropertyController::class, 'staffIndex'])
        ->name('staff.properties.index');

    Route::get('/staff/properties/create', [PropertyController::class, 'create'])
        ->name('staff.properties.create');

    Route::post('/staff/properties', [PropertyController::class, 'store'])
        ->name('staff.properties.store');

    Route::get('/staff/properties/{property}/edit', [PropertyController::class, 'edit'])
        ->name('staff.properties.edit');

    Route::put('/staff/properties/{property}', [PropertyController::class, 'update'])
        ->name('staff.properties.update');

    Route::delete('/staff/properties/{property}', [PropertyController::class, 'destroy'])
        ->name('staff.properties.destroy');

    /*
    |--------------------------------------------------------------------------
    | Viewings
    |--------------------------------------------------------------------------
    */

    Route::resource('viewings', ViewingController::class)
        ->except(['create', 'store'])
        ->parameter('viewings', 'viewing');

    /*
    |--------------------------------------------------------------------------
    | Viewing Feedback
    |--------------------------------------------------------------------------
    */

    Route::get('/feedback', [ViewingFeedbackController::class, 'index'])
        ->name('feedback.index');

    /*
    |--------------------------------------------------------------------------
    | Rental Contracts
    |--------------------------------------------------------------------------
    */

    Route::resource('contracts', RentalContractController::class)
        ->parameter('contracts', 'rentalContract');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::get('/admin/home', [AdminHomeController::class, 'index'])
        ->name('admin.home');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
