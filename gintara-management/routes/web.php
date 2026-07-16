<?php

use Illuminate\Support\Facades\Route;

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

// Menu khusus Superadmin
Route::middleware(['auth', 'role:superadmin'])->group(function () {

    Route::get('/users', function () {
        return "Halaman Manajemen User";
    });

});