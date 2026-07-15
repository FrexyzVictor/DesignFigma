<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IntegrationReceiverController;
use App\Http\Controllers\InvoiceController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/integration/customers/create', [IntegrationReceiverController::class, 'createCustomer']);
Route::post('/integration/customers/softdelete', [IntegrationReceiverController::class, 'softDeleteCustomer']);

Route::post('/invoices', [InvoiceController::class, 'store']);
Route::post('/invoices/{invoice}/pay', [InvoiceController::class, 'pay']);