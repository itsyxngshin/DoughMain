<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;

use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function startOrGetChat($recipientId, $recipientType)
    {
        $auth = Auth::user(); // or auth guard for shops
        $chat = Chat::where(function ($query) use ($auth, $recipientId, $recipientType) {
            $query->where('participant_one_id', $auth->id)
                ->where('participant_one_type', get_class($auth))
                ->where('participant_two_id', $recipientId)
                ->where('participant_two_type', $recipientType);
        })->orWhere(function ($query) use ($auth, $recipientId, $recipientType) {
            $query->where('participant_two_id', $auth->id)
                ->where('participant_two_type', get_class($auth))
                ->where('participant_one_id', $recipientId)
                ->where('participant_one_type', $recipientType);
        })->first();

        if (!$chat) {
            $chat = Chat::create([
                'participant_one_id' => $auth->id,
                'participant_one_type' => get_class($auth),
                'participant_two_id' => $recipientId,
                'participant_two_type' => $recipientType,
            ]);
        }

        return response()->json($chat);
    }

    public function sendMessage(Request $request, $chatId)
    {
        $auth = Auth::user(); // or auth()->guard('shop')->user()

        $message = Message::create([
            'chat_id' => $chatId,
            'sender_id' => $auth->id,
            'sender_type' => get_class($auth),
            'message' => $request->message,
        ]);

        // Optionally broadcast or send notification here

    return response()->json($message);
    }
    public function getMessages($chatId)
    {
        $messages = Message::where('chat_id', $chatId)
                ->with('sender')
                ->orderBy('created_at')
                ->get();

        return response()->json($messages);
    }
}
