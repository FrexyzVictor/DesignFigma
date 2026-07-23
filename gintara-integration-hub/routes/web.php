<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard.index');

    Route::get('/dashboard/events', function () {
        return view('dashboard.events');
    })->name('dashboard.events');

    Route::get('/dashboard/apps', function () {
        return view('dashboard.apps');
    })->name('dashboard.apps');

    Route::get('/dashboard/notifications', function () {
        return view('dashboard.notifications');
    })->name('dashboard.notifications');

    Route::get('/dashboard/settings', [SettingsController::class, 'index'])
        ->name('dashboard.settings');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';