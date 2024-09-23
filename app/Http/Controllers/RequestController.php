<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Http\Controllers\SessionController;
use App\Models\Session; // Add this line if the Session model is in the App\Models namespace

use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function store(HttpRequest $request)
    {
        $validatedData = $request->validate([
            'lab_id' => 'required|exists:labs,id',
            'session_ids' => 'required|array',
            'session_ids.*' => 'exists:sessions,id',
            'request_date' => 'required|date|after:today',
            'major' => 'required|string|max:100',
            'subject' => 'required|string|max:100',
            'generation' => 'required|integer',
            'software_need' => 'required|string|max:255',
            'number_of_student' => 'required|integer',
            'additional' => 'nullable|string',
        ]);

        $createdRequests = [];

        foreach ($validatedData['session_ids'] as $session_id) {
            $labRequest = Request::create([
                'lab_id' => $validatedData['lab_id'],
                'session_id' => $session_id,
                'user_id' => Auth::id(),
                'request_date' => $validatedData['request_date'],
                'major' => $validatedData['major'],
                'subject' => $validatedData['subject'],
                'generation' => $validatedData['generation'],
                'software_need' => $validatedData['software_need'],
                'number_of_student' => $validatedData['number_of_student'],
                'additional' => $validatedData['additional'],
            ]);

            $createdRequests[] = $labRequest;
        }

        return response()->json($createdRequests, 201);
    }

    public function checkAvailability(HttpRequest $request)
{
    $validatedData = $request->validate([
        'date' => 'required|date',
        'lab_id' => 'required|exists:labs,id',
    ]);

    // Fetch all sessions using the Session model
    $sessions = Session::all();
    $availability = [];

    foreach ($sessions as $session) {
        $request = Request::where('lab_id', $validatedData['lab_id'])
                          ->where('session_id', $session->id)
                          ->where('request_date', $validatedData['date'])
                          ->with('user')
                          ->first();

        $availability[] = [
            'session_id' => $session->id,
            'session_name' => $session->name,
            'status' => $request ? 'busy' : 'free',
            'user' => $request ? $request->user->name : null,
        ];
    }

    return response()->json($availability);
}

}
