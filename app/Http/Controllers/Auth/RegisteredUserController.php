<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\MArea;
use App\Models\MCategory;
use App\Models\MLearningContent;
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
            'm_area_id' => 'required|exists:m_areas,id',
            'm_category_id' => 'required|exists:m_categories,id',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'avatar' => ['image', 'max:1024'],
            'gender' => 'required|in:男性,女性',
            'birth' => 'required|date',
            'intro' => 'nullable|string|max:1000',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // userテーブルのデータ
        $attr = [
            'name' => $request->name,
            'm_area_id' => $request->m_area_id,
            'm_category_id' => $request->m_category_id,
            'email' => $request->email,
            'gender' => $request->gender,
            'birth' => $request->birth,
            'intro' => $request->intro,
            'password' => Hash::make($request->password),
            'content' => 'required|string|max:255',
            'level' => 'required|integer|min:1|max:5',
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

        // contentsテーブルのデータ
        $content = new Content();
        $content->user_id = $user->id;
        $content->content = $request->content;
        $content->level = $request->level;
        $content->save();

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
