<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Fetch all notifications for the authenticated user
    public function getUserNotifications()
    {
        $userId = Auth::id();
        $notifications = Notification::where('user_id', $userId)->get();

        return response()->json($notifications, 200);
    }

    // Create a notification (if needed for manual notification sending)
    public function createNotification(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'request_id' => 'required|exists:requests,id',
            'message' => 'required|string|max:255',
        ]);

        $notification = Notification::create([
            'user_id' => $validated['user_id'],
            'request_id' => $validated['request_id'],
            'message' => $validated['message'],
        ]);

        return response()->json(['message' => 'Notification created successfully', 'notification' => $notification], 201);
    }

    // Mark a notification as read (optional functionality)
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        if ($notification->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $notification->update(['is_read' => true]);

        return response()->json(['message' => 'Notification marked as read'], 200);
    }

    // Delete a notification
    public function deleteNotification($id)
    {
        $notification = Notification::findOrFail($id);
        if ($notification->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully'], 200);
    }
};
