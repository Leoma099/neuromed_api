<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResponseController extends Controller
{
    public function index()
    {
        $json = Storage::get('public/data.json');
        $responses = json_decode($json, true);
        return response()->json($responses['schema']);
    }

    public function getResponses(Request $request)
    {
        // Get responses from the database
        $responses = Response::all();  // You could filter based on type, if needed
        
        return response()->json($responses);
    }
}
