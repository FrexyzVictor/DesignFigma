<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CustomerViewController;
use App\Http\Controllers\SyncLogController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->name('dashboard.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('index');

    Route::get('/events', [EventController::class, 'index'])
        ->name('events');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/aplikasi', [AppController::class, 'index'])->name('apps');
        Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifications');
        Route::get('/pengaturan', [SettingsController::class, 'index'])->name('settings');

        Route::get('/log-sinkronisasi', [SyncLogController::class, 'index'])->name('sync-logs');

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
