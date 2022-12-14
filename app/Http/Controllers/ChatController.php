<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index(Request $request)
    {

        // ユーザー識別子がなければランダムに生成してセッションに登録
        if ($request->session()->missing('user_identifier')) {
            session(['user_identifier' => Str::random(20)]);
        }

        // ユーザー名を変数に登録（デフォルト値：Guest）
        if ($request->session()->missing('user_name')) {
            session(['user_name' => 'Guest']);
        }

        // チャット取得
        $chats = Chat::all();

        // チャットデータをビューに渡して表示
        return view('chat/index', compact('chats'));
    }

    public function store(Request $request)
    {
        // フォームに入力されたユーザー名をセッションに登録
        session(['user_name' => $request->user_name]);

        // フォームに入力されたチャットデータをデータベースに登録
        $chat = new Chat;
        $form = $request->all();
        $chat->fill($form)->save();

        // 最初の画面にリダイレクト
        return redirect('/chat');
    }
}
