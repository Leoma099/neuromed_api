<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ResponseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route to create a new conversation
Route::post('/new-chat', [ConversationController::class, 'createNewChat']);
Route::get('/conversation', [ConversationController::class, 'index']);

// Route to get the predefined responses
Route::get('/responses', [ResponseController::class, 'index']);
Route::get('/get-responses', [ResponseController::class, 'getResponses']);

// Route to send a message (both user and bot messages)
Route::get('/messages', [MessageController::class, 'index']);
Route::get('/conversations/{conversation_id}/messages', [MessageController::class, 'getMessages']);
Route::post('/send-message', [MessageController::class, 'sendMessage']);
Route::delete('/conversations/{id}', [MessageController::class, 'destroy']);