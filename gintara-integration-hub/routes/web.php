<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CustomerViewController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->name('dashboard.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('index');

    Route::get('/events', [EventsController::class, 'index'])
        ->name('events');

    Route::get('/apps', [AppController::class, 'index'])
        ->name('apps');

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications');

    Route::get('/settings', [SettingsController::class, 'index'])
        ->name('settings');

});

Route::prefix('customers')->name('customers.')->group(function () {

    Route::get('/', [CustomerViewController::class, 'index'])->name('index');
    Route::get('/create', [CustomerViewController::class, 'create'])->name('create');
    Route::post('/', [CustomerViewController::class, 'store'])->name('store');
    Route::get('/{id}', [CustomerViewController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [CustomerViewController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CustomerViewController::class, 'update'])->name('update');
    Route::delete('/{id}', [CustomerViewController::class, 'destroy'])->name('destroy');

});

Route::prefix('events')->name('events.')->group(function () {

    Route::get('/', [EventsController::class, 'index'])
        ->name('index');

    Route::get('/create', [EventsController::class, 'create'])
        ->name('create');

    Route::post('/', [EventsController::class, 'store'])
        ->name('store');

    Route::get('/{event}', [EventsController::class, 'show'])
        ->name('show');

    Route::get('/{event}/edit', [EventsController::class, 'edit'])
        ->name('edit');

    Route::put('/{event}', [EventsController::class, 'update'])
        ->name('update');

    Route::delete('/{event}', [EventsController::class, 'destroy'])
        ->name('destroy');

});