<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/requests', [RequestController::class, 'store']);
    Route::get('/check-availability', [RequestController::class, 'checkAvailability']);
});
