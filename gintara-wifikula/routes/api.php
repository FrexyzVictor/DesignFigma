<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IntegrationReceiverController;
use App\Http\Controllers\TicketController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/integration/customers/create', [IntegrationReceiverController::class, 'createOrUpdateCustomer']);
Route::post('/integration/billing/update', [IntegrationReceiverController::class, 'updateBillingInfo']);

Route::post('/tickets', [TicketController::class, 'store']);