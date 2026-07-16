<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IntegrationReceiverController;
use App\Http\Controllers\PppoeStatusController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/integration/pppoe/create', [IntegrationReceiverController::class, 'createPppoe']);
Route::post('/integration/pppoe/disable', [IntegrationReceiverController::class, 'disablePppoe']);


Route::post('/customers/{customer}/status', [PppoeStatusController::class, 'updateStatus']);