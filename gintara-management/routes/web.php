<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerViewController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard yang bisa diakses Admin dan Superadmin
Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {

    Route::get('/dashboard', function () {

        if (auth()->user()->role === 'superadmin') {
            return view('superadmin.dashboard');
        }

        return view('admin.dashboard');

    })->name('dashboard');

});

// Menu khusus Superadmin nih bos
Route::middleware(['auth', 'role:superadmin'])->group(function () {

    Route::get('/users', function () {
        return "Halaman Manajemen User";
    });

});

Route::get('/customers', [CustomerViewController::class, 'index'])
    ->name('customers.index');

Route::get('/customers/{id}', [CustomerViewController::class, 'show'])
    ->name('customers.show');
