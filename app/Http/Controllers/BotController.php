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
                'type' => 'emergency',
                'keywords' => ['help'],
                'reply' => "Of course, we are here to help you. What is your emergency?"
            ],
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
                'reply' => "It sounds serious. I recommend visiting the nearest hospital as soon as you can. Where are you located?"
            ],
            [
                'type' => 'location_1',
                'keywords' => ['aurora'],
                'reply' => "Great! Here is the nearest hospital. Premiere General Hospital, Baler and the emergency contact is +63-946-068-0000"
            ],
                        [
                'type' => 'location_2',
                'keywords' => ['bataan'],
                'reply' => "Great! Here is the nearest hospital. Bataan General Hospital and Medical Center, Balanga City and the emergency contact is (047) 237-9771"
            ],
                        [
                'type' => 'location_3',
                'keywords' => ['bulacan'],
                'reply' => "Great! Here is the nearest hospital. Bulacan Medical Center, Malolos City Center and the emergency contact is  (044) 794-1526"
            ],
                        [
                'type' => 'location_4',
                'keywords' => ['tarlac'],
                'reply' => "Great! Here is the nearest hospital. Tarlac Provincial Hospital, Tarlac City and the emergency contact is (045) 982-6885"
            ],
                        [
                'type' => 'location_5',
                'keywords' => ['pampanga'],
                'reply' => "Great! Here is the nearest hospital. PRI Medical Center, San Fernando City and the emergency contact is 0917-180-8886"
            ],
                        [
                'type' => 'location_6',
                'keywords' => ['nueva ecija'],
                'reply' => "Great! Here is the nearest hospital. GoodSam Medical Center, Cabanatuan City and the emergency contact is (044) 951-8888"
            ],
                        [
                'type' => 'location_7',
                'keywords' => ['zambales'],
                'reply' => "Great! Here is the nearest hospital. President Ramon Magsaysay Memorial Hospital, Iba and the emergency contact is 0906-340-9108"
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
