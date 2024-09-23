<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionController extends Controller
{
    // Get all sessions
    public function index()
    {
        $sessions = Session::all();
        return response()->json($sessions, 200);
    }
}
