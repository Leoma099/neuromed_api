<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotController extends Controller
{
    public function getReply(Request $request)
    {
        $userInput = strtolower($request->input('message'));
        
        // Predefined responses schema
        $responses = [
            [
                'type' => 'greeting',
                'keywords' => ['hi', 'hello', 'hey'],
                'reply' => "Hello! I'm AskDoctor AI. How can I assist you today?"
            ],
            [
                'type' => 'general_symptom',
                'keywords' => ['fever', 'fatigue', 'nausea', 'anxiety', 'chills', 'sweating', 'weakness', 'dizziness', 'headache', 'vomit'],
                'reply' => "I'm sorry to hear that. Can you tell me how long you've been feeling this way?"
            ],
            [
                'type' => 'general_symptom_duration',
                'keywords' => ['3 days', 'since last week', 'a couple of hours', 'last month'],
                'reply' => "Thank you for sharing that. Based on your symptoms, it might be helpful to consult a healthcare provider."
            ],
            [
                'type' => 'diagnosis_advice',
                'keywords' => ['pain', 'hurt'],
                'reply' => "It sounds serious. I recommend visiting the nearest hospital as soon as you can."
            ],
            [
                'type' => 'thank_you',
                'keywords' => ['thank you', 'thanks', 'appreciate', 'appreciation', 'grateful', 'gratitude', 'indebted', 'obliged', 'lifesaver'],
                'reply' => "You're welcome! Stay safe and take care."
            ]
        ];

        // Default bot reply
        $botReply = "Sorry, I didn’t understand that. Could you please be more specific about your symptoms or concern?";

        // Check if user input matches any of the keywords from the schema
        foreach ($responses as $response) {
            foreach ($response['keywords'] as $keyword) {
                if (strpos($userInput, $keyword) !== false) {
                    $botReply = $response['reply'];
                    break 2; // Stop once a match is found
                }
            }
        }

        return response()->json(['reply' => $botReply]);
    }
}
