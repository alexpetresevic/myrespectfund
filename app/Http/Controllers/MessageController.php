<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required'
        ]);

        $userId      = $request->user;
        $partnerId   = $request->partner;
        $messageText = $request->message;

        $conversation = Conversation::getByParticipants($userId, $partnerId);

        if (is_null($conversation)) {
            $conversation             = new Conversation();
            $conversation->user_id    = $userId;
            $conversation->partner_id = $partnerId;
            $conversation->save();

            $message                  = new Message();
            $message->conversation_id = $conversation->id;
            $message->sender_id       = auth()->user()->id;
            $message->message         = $messageText;

            $message->save();

            return $message;
        }

        $message = new Message();

        $message->conversation_id = $conversation->id;
        $conversation->user_id    = $userId;
        $conversation->partner_id = $partnerId;
        $message->message         = $messageText;
        $message->sender_id       = auth()->user()->id;

        $message->save();

        return $message;
    }

    public function getMessages($id)
    {
        $conversation = Conversation::find($id);

        return $conversation->messages;
    }

    public function checkMessages()
    {
        $response = ['status' => false];

        $conversations = Conversation::select('id')->where('user_id', auth()->user()->id)->get();

        if (!$conversations) {
            return $response;
        }

        foreach ($conversations as $conversation) {
            $messages = Message::where([
                'conversation_id' => $conversation->id,
                'status'          => 0,
                'notified'        => 0
            ])->get();

            if ($messages->count()) {
                foreach ($messages as $message) {
                    $message->notified = true;
                    $message->save();
                }

                $response['status'] = true;
            }
        }

        return $response;
    }
}
