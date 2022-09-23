<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MArea;
use App\Models\MCategory;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // areaテーブルの全データを取得する
        $areas = MArea::all();
        // categoryテーブルの全データを取得する
        $categories = MCategory::all();
        return view('auth.register', compact('areas', 'categories'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'avatar' => ['image', 'max:1024'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // userテーブルのデータ
        $attr = [
            'name' => $request->name,
            'm_area_id' => $request->m_area_id,
            'm_category_id' => $request->m_category_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        //avatarの保存
        if (request()->hasFile('avatar')) {
            $name = request()->file('avatar')->getClientOriginalName();
            $avatar = date('Ymd_His') . '_' . $name;
            request()->file('avatar')->move('storage/avatar', $avatar);
            //avatarファイル名をデータに追加
            $attr['avatar'] = $avatar;
        }

        $user = User::create($attr);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
