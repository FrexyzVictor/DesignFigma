<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IntegrationReceiverController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::put('/customers/{customer}', [CustomerController::class, 'update']);
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy']);



Route::post('/integration/customers/update', [IntegrationReceiverController::class, 'updateCustomer']);
Route::post('/integration/customers/softdelete', [IntegrationReceiverController::class, 'softDeleteCustomer']);

Route::post('/integration/subscriptions/update', [IntegrationReceiverController::class, 'createOrUpdateInvoice']);
Route::post('/integration/invoices/update', [IntegrationReceiverController::class, 'updateInvoiceInfo']);

Route::post('/integration/payments/update', [IntegrationReceiverController::class, 'updatePaymentInfo']);