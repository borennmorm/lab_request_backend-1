<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\NotificationController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/requests', [RequestController::class, 'store']);
    Route::get('/check-availability', [RequestController::class, 'checkAvailability']);
    Route::post('/approvals/approve', [ApprovalController::class, 'approveRequest']);

    // Get notifications for the logged-in user
    Route::get('/notifications', [NotificationController::class, 'getUserNotifications']);

    // Manually create a notification (if needed for testing or admin-triggered notifications)
    Route::post('/notifications', [NotificationController::class, 'createNotification']);

    // Mark a notification as read
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markAsRead']);

    // Delete a notification
    Route::delete('/notifications/{id}', [NotificationController::class, 'deleteNotification']);
});
