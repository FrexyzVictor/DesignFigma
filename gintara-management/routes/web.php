<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerViewController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Admin & Superadmin
Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {

    Route::get('/dashboard', function () {

        if (auth()->user()->role === 'superadmin') {
            return view('superadmin.dashboard');
        }

        return view('admin.dashboard');

    })->name('dashboard');

});

// Manajemen User (Superadmin saja)
Route::middleware(['auth', 'role:superadmin'])->group(function () {

    Route::get('/users', function () {
        return "Halaman Manajemen User";
    })->name('users.index');

});

// ===================== CUSTOMER =====================

Route::get('/customers', [CustomerViewController::class, 'index'])
    ->name('customers.index');

Route::get('/customers/create', [CustomerViewController::class, 'create'])
    ->name('customers.create');

Route::post('/customers', [CustomerViewController::class, 'store'])
    ->name('customers.store');

Route::get('/customers/{id}', [CustomerViewController::class, 'show'])
    ->name('customers.show');

Route::get('/customers/{id}/edit', [CustomerViewController::class, 'edit'])
    ->name('customers.edit');

Route::put('/customers/{id}', [CustomerViewController::class, 'update'])
    ->name('customers.update');

Route::delete('/customers/{id}', [CustomerViewController::class, 'destroy'])
    ->name('customers.destroy');