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
<<<<<<< HEAD

Route::get('/customers', [CustomerViewController::class, 'index'])
    ->name('customers.index');

Route::get('/customers/create', [CustomerViewController::class, 'create'])
    ->name('customers.create');
=======


Route::get('/customers', [CustomerViewController::class, 'index'])
    ->name('customers.index');

Route::get('/customers/create', [CustomerViewController::class, 'create'])
    ->name('customers.create');

    Route::get('/customers', [CustomerViewController::class, 'index'])
        ->name('customers.index');

    Route::get('/customers/{customer}', [CustomerViewController::class, 'show'])
        ->name('customers.show');

Route::get('/customers', [CustomerViewController::class, 'index'])->name('customers.index');
>>>>>>> 5c72b52797c80da03d2fab02d7c17d5668302e18

Route::post('/customers', [CustomerViewController::class, 'store'])
    ->name('customers.store');

Route::get('/customers/{id}', [CustomerViewController::class, 'show'])
    ->name('customers.show');

Route::get('/customers/{id}/edit', [CustomerViewController::class, 'edit'])
    ->name('customers.edit');

Route::put('/customers/{id}', [CustomerViewController::class, 'update'])
    ->name('customers.update');
<<<<<<< HEAD
=======


Route::delete('/customers/{id}', [CustomerViewController::class, 'destroy'])
    ->name('customers.destroy');
>>>>>>> 5c72b52797c80da03d2fab02d7c17d5668302e18

Route::delete('/customers/{id}', [CustomerViewController::class, 'destroy'])
    ->name('customers.destroy');

<<<<<<< HEAD
Route::get('/customers/{customer}', [CustomerViewController::class, 'show'])
    ->name('customers.show');
=======
Route::delete('/customers/{id}', [CustomerViewController::class, 'destroy'])->name('customers.destroy');

>>>>>>> 5c72b52797c80da03d2fab02d7c17d5668302e18
