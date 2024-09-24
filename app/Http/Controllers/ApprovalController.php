<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Request;
use App\Models\Notification;
use Illuminate\Http\Request as HttpRequest;

class ApprovalController extends Controller
{
    public function approveRequest(HttpRequest $request)
    {
        $validated = $request->validate([
            'request_id' => 'required|exists:requests,id',
            'is_approve' => 'required|boolean',
        ]);

        // Create or update the approval status
        $approval = Approval::updateOrCreate(
            ['request_id' => $validated['request_id']],
            ['is_approve' => $validated['is_approve']]
        );

        // Get the request details
        $labRequest = Request::find($validated['request_id']);

        // Create a notification for the user
        $message = $validated['is_approve'] ? 'Your request has been approved.' : 'Your request has been rejected.';
        Notification::create([
            'user_id' => $labRequest->user_id,
            'request_id' => $labRequest->id,
            'message' => $message,
        ]);

        return response()->json(['message' => 'Approval processed and notification sent'], 200);
    }
}
