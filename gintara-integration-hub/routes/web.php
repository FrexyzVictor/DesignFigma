<?php
/**
 * Tempel bagian ini ke routes/web.php kamu.
 * Middleware DetectDevice didaftarkan sebagai alias 'device' di bootstrap/app.php
 * (lihat README.md), lalu tinggal dipasang di route/group yang butuh versi
 * mobile & desktop terpisah.
 */


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SyncLogController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/aplikasi', [AppController::class, 'index'])->name('apps');
Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifications');
Route::get('/pengaturan', [SettingsController::class, 'index'])->name('settings');
Route::get('/log-sinkronisasi', [SyncLogController::class, 'index'])->name('sync-logs');
