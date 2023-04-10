<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendRequestController extends Controller
{
    // 友達申請を送信する処理を実装する
    public function sendFriendRequest(Request $request)
    {

        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'requested_user_id' => 'required|integer',
        ]);

        // フォームから送信されたデータを取得
        $userId = $validatedData['user_id'];
        $requestedUserId = $validatedData['requested_user_id'];

        // 友達申請をデータベースに保存
        $friendRequest = new FriendRequest();
        $friendRequest->user_id = $userId;
        $friendRequest->requested_user_id = $requestedUserId;
        $friendRequest->status = 0;
        $friendRequest->save();

        return redirect()->back()->with('success', '友達申請を送信しました。');
    }

    // 友達申請一覧ページ表示
    public function showFriendRequests()
    {
        $user = Auth::user();
        $friendRequests = FriendRequest::receivedPendingRequests($user->id);
        return view('friend_requests.index', compact('friendRequests'));
    }

    // 友達申請を承認する処理を実装する
    public function acceptFriendRequest(Request $request)
    {
        $friendRequest = FriendRequest::findOrFail($request->id);
        $friendRequest->status = 1; // 承認済みに更新する
        $friendRequest->save();
        return redirect()->back()->with('success', '友達申請を承認しました。');
    }

    // 友達申請を拒否する処理を実装する
    public function rejectFriendRequest(Request $request)
    {

        $friendRequest = FriendRequest::findOrFail($request->id);
        $friendRequest->status = 2; // 拒否に更新する
        $friendRequest->save();
        return redirect()->back()->with('success', '友達申請を拒否しました。');
    }
}
