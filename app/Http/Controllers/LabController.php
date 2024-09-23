<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;

class LabController extends Controller
{
    // Get all labs
    public function index()
    {
        $labs = Lab::all();
        return response()->json($labs, 200);
    }
}
