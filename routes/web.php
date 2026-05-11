<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Staff\StaffHomeController;
use App\Http\Controllers\Admin\AdminHomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

Route::middleware(['auth'])->group(function () {
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

    Route::middleware('role:staff,admin')->group(function () {
        Route::get('/staff/home', [StaffHomeController::class, 'index'])->name('staff.home');
        Route::get('/staff/properties', [PropertyController::class, 'staffIndex'])->name('staff.properties.index');
        Route::get('/staff/properties/create', [PropertyController::class, 'create'])->name('staff.properties.create');
        Route::post('/staff/properties', [PropertyController::class, 'store'])->name('staff.properties.store');
        Route::get('/staff/properties/{property}/edit', [PropertyController::class, 'edit'])->name('staff.properties.edit');
        Route::put('/staff/properties/{property}', [PropertyController::class, 'update'])->name('staff.properties.update');
        Route::delete('/staff/properties/{property}', [PropertyController::class, 'destroy'])->name('staff.properties.destroy');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin.home');
    });
});
require __DIR__.'/auth.php';