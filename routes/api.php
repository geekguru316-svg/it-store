<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MobileAppController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Flutter Mobile App Endpoints
Route::post('/mobile/login', [MobileAppController::class, 'login']);
Route::get('/mobile/products', [MobileAppController::class, 'products']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/mobile/checkout', [MobileAppController::class, 'checkout']);
});
