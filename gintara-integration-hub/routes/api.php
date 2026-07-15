<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\HealthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/health', [HealthController::class, 'check']);

    Route::middleware('gintara.signature')->group(function () {
        Route::post('/events', [EventController::class, 'store']);
    });
});