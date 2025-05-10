<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        return Conversation::orderBy('id', 'desc')->get();
    }    

    public function createNewChat()
    {
        // Create a new conversation record in the database
        $conversation = Conversation::create([
            'title' => 'Chat ' . (Conversation::count() + 1),  // Create a new ID
        ]);

        // Return the newly created conversation ID or any data you want
        return response()->json($conversation);
    }
}
