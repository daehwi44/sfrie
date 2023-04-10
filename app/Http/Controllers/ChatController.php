<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ChatController extends Controller
{
    // チャットルームを開く
    public function show(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
            $query->where('from_user_id', auth()->id())
                ->where('to_user_id', $user->id);
        })
            ->orWhere(function ($query) use ($user) {
                $query->where('from_user_id', $user->id)
                    ->where('to_user_id', auth()->id());
            })
            ->orderBy('created_at', 'ASC')
            ->get();
        return view('chat.show', compact('user', 'messages'));
    }

    // メッセージの送信処理
    public function send(Request $request, User $user)
    {
        $message = new Message;
        $message->from_user_id = auth()->id();
        $message->to_user_id = $user->id;
        $message->message = $request->message;
        $message->save();

        event(new NewMessage($message));

        $messages = Message::where(function ($query) use ($user) {
            $query->where('from_user_id', auth()->id())->where('to_user_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('from_user_id', $user->id)->where('to_user_id', auth()->id());
        })->get();

        return view('chat.show', compact('user', 'messages'));
    }
}
