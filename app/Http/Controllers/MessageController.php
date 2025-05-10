<?php

namespace App\Http\Controllers;


use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('created_at', 'asc')->get();
        return response()->json($messages);
    }
    
    public function sendMessage(Request $request)
    {
        // Get the conversation ID and message
        $conversationId = $request->conversation_id;
        $sender = $request->sender;  // 'You' or 'Bot'
        $messageContent = $request->message;

        // Validate the request
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'sender' => 'required|in:You,Bot',
            'message' => 'required|string',
        ]);

        // Store the new message
        $message = Message::create([
            'conversation_id' => $conversationId,
            'sender' => $sender,
            'message' => $messageContent,
        ]);

        return response()->json($message);
    }

    public function getMessages($conversation_id)
    {
        $messages = \App\Models\Message::where('conversation_id', $conversation_id)
                                        ->orderBy('created_at', 'asc')
                                        ->get();

        return response()->json($messages);
    }

    public function destroy($conversation_id)
    {
        // Find the conversation
        $conversation = Conversation::findOrFail($conversation_id);

        // Delete related messages first
        Message::where('conversation_id', $conversation_id)->delete();

        // Then delete the conversation
        $conversation->delete();

        return response()->json(['message' => 'Conversation and related messages deleted successfully.']);
    }

}
