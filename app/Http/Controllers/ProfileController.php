<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Role;


class ProfileController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('profile.index', compact('users'));
    }

    //プロフィール編集画面へ
    public function edit(User $user)
    {
        return view('profile.edit', compact('user'));
    }

    //プロフィールの書き換え処理
    public function update(User $user, Request $request)
    {
        //更新の権限設定
        //$this->authorize('update', $user);

        // バリデーション
        $inputs = request()->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => 'image|max:1024',
            'password' => 'nullable|max:255|min:8',
            'password_confirmation' => 'nullable|same:password'
        ]);

        //パスワードの設定
        if (!isset($inputs['password'])) {
            unset($inputs['password']);
        } else {
            $inputs['password'] = Hash::make($inputs['password']);
        }

        // アバターの保存(古いアバターは削除)
        if (isset($inputs['avatar'])) {
            if ($user->avatar !== 'user_default.jpg') {
                $oldavatar = 'public/avatar/' . $user->avatar;
                Storage::delete($oldavatar);
            }
            $name = request()->file('avatar')->getClientOriginalName();
            // 日時追加
            $avatar = date('Ymd_His') . '_' . $name;
            request()->file('avatar')->move('storage/avatar', $avatar);
            $inputs['avatar'] = $avatar;
        }

        $user->update($inputs);
        return back()->with('message', '情報を更新しました');
    }
}
