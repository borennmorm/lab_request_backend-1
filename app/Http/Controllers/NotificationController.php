<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Request as LabRequest;
use App\Models\User;

class NotificationController extends Controller
{
    // Send a notification when request is approved/declined
    public function notifyUser($userId, $requestId, $message)
    {
        $notification = Notification::create([
            'user_id' => $userId,
            'request_id' => $requestId,
            'message' => $message,
        ]);

        return response()->json(['message' => 'Notification sent!'], 201);
    }

    // Get all notifications for a user
    public function getUserNotifications($userId)
    {
        $notifications = Notification::where('user_id', $userId)->get();
        return response()->json($notifications, 200);
    }
}
