<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ChangeRequestController;
use App\Http\Controllers\IntegrationReceiverController;

// User endpoint
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ==================== CUSTOMERS ====================
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{customer}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'store'])->middleware('auth:sanctum');
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->middleware('auth:sanctum');

// ==================== SUBSCRIPTIONS ====================
Route::get('/subscriptions', [SubscriptionController::class, 'index']);
Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show']);
Route::post('/subscriptions', [SubscriptionController::class, 'store'])->middleware('auth:sanctum');
Route::put('/subscriptions/{subscription}', [SubscriptionController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy'])->middleware('auth:sanctum');

// ==================== TICKETS ====================
Route::get('/tickets', [TicketController::class, 'index']);
Route::get('/tickets/{ticket}', [TicketController::class, 'show']);
Route::post('/tickets', [TicketController::class, 'store'])->middleware('auth:sanctum');
Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->middleware('auth:sanctum');

// ==================== CHANGE REQUESTS ====================
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/change-requests', [ChangeRequestController::class, 'index']);
    Route::get('/change-requests/{changeRequest}', [ChangeRequestController::class, 'show']);
    Route::post('/change-requests/{changeRequest}/approve', [ChangeRequestController::class, 'approve']);
    Route::post('/change-requests/{changeRequest}/reject', [ChangeRequestController::class, 'reject']);
    Route::get('/change-requests/history/{entityType}/{entityId}', [ChangeRequestController::class, 'history']);
});

// ==================== INTEGRATION HUB ENDPOINTS ====================
Route::post('/integration/customers/update', [IntegrationReceiverController::class, 'updateCustomer']);
Route::post('/integration/customers/softdelete', [IntegrationReceiverController::class, 'softDeleteCustomer']);
Route::post('/integration/subscriptions/update', [IntegrationReceiverController::class, 'createOrUpdateInvoice']);
Route::post('/integration/invoices/update', [IntegrationReceiverController::class, 'updateInvoiceInfo']);
Route::post('/integration/payments/update', [IntegrationReceiverController::class, 'updatePaymentInfo']);
