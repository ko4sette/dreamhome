<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboard;
use App\Http\Controllers\Supervisor\DashboardController as SupervisorDashboard;
use App\Http\Controllers\Secretary\DashboardController as SecretaryDashboard;
use App\Http\Controllers\Staff\DashboardController as StaffDashboard;

Route::get('/', function () {
    return view('welcome');
});

// Smart redirector for /dashboard
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    
    if ($role === 'manager') return redirect()->route('manager.dashboard');
    if ($role === 'supervisor') return redirect()->route('supervisor.dashboard');
    if ($role === 'secretary') return redirect()->route('secretary.dashboard');
    if ($role === 'staff') return redirect()->route('staff.dashboard');
    
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Manager Routes
Route::middleware(['auth', 'role:manager'])
    ->prefix('manager')
    ->name('manager.')
    ->group(function () {
        Route::get('/dashboard', [ManagerDashboard::class, 'index'])->name('dashboard');
        // Add more manager routes here
    });

// Supervisor Routes
Route::middleware(['auth', 'role:supervisor'])
    ->prefix('supervisor')
    ->name('supervisor.')
    ->group(function () {
        Route::get('/dashboard', [SupervisorDashboard::class, 'index'])->name('dashboard');
        // Add more supervisor routes here
    });

// Secretary Routes
Route::middleware(['auth', 'role:secretary'])
    ->prefix('secretary')
    ->name('secretary.')
    ->group(function () {
        Route::get('/dashboard', [SecretaryDashboard::class, 'index'])->name('dashboard');
        // Add more secretary routes here
    });

// Staff Routes
Route::middleware(['auth', 'role:staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {
        Route::get('/dashboard', [StaffDashboard::class, 'index'])->name('dashboard');
        Route::get('/properties', [\App\Http\Controllers\Staff\PropertyController::class, 'index'])->name('properties.index');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
