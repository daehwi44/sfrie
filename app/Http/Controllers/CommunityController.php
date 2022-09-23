<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\CommunityUser;
use App\Models\MArea;
use App\Models\MCategory;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communities = Community::with('area', 'category')->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        return view('community.index', compact('communities', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // areaテーブルの全データを取得する
        $areas = MArea::all();
        // categoryテーブルの全データを取得する
        $categories = MCategory::all();
        return view('community.create', compact('areas', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $inputs = $request->validate([
            'name' => 'required|max:255',
            'image' => 'image|max:1024',
            'm_area_id' => 'required',
            'm_category_id' => 'required',
            'content' => 'required|max:255',
            'about' => 'required|max:1000',
        ]);

        //インスタンス化
        $community = new Community();

        $community->name = $request->name;
        $community->m_area_id = $request->m_area_id;
        $community->m_category_id = $request->m_category_id;
        $community->content = $request->content;
        $community->about = $request->about;
        $community->user_id = auth()->user()->id;
        if (request('image')) {
            $original = request()->file('image')->getClientOriginalName();
            // 日時追加
            $name = date('Ymd_His') . '_' . $original;
            request()->file('image')->move('storage/images', $name);
            $community->image = $name;
        }
        $community->save();
        return redirect()->route('community.create')->with('message', '投稿を作成しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function show($community_id)
    {
        $community = Community::find($community_id);

        //ユーザーがすでにコミュニティに入っているかの判別
        $isJoin = CommunityUser::where('user_id', auth()->user()->id)->where('community_id', $community_id)->exists();

        return view('community.show', compact('community', 'isJoin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        // areaテーブルの全データを取得する
        $areas = MArea::all();
        // categoryテーブルの全データを取得する
        $categories = MCategory::all();
        return view('community.edit', compact('community', 'areas', 'categories'));
    }


    // ユーザー一覧表示
    public function members($community_id)
    {
        $community = Community::find($community_id);
        $communities = Community::with('users')->where('id', $community_id)->get();
        // dd($communities);

        //ユーザーがすでにコミュニティに入っているかの判別
        $isJoin = CommunityUser::where('user_id', auth()->user()->id)->where('community_id', $community_id)->exists();


        return view('community.member', compact('community','communities', 'isJoin'));
    }

    // ユーザー追加
    public function add($community_id)
    {
        $community = Community::find($community_id);
        $user_id = auth()->user()->id;
        $community->users()->attach($user_id);

        $communities = Community::with('users')->where('id', $community_id)->get();

        //ユーザーがすでにコミュニティに入っているかの判別
        $isJoin = CommunityUser::where('user_id', auth()->user()->id)->where('community_id', $community_id)->exists();

        return view('community.member', compact('communities','community', 'isJoin'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Community $community)
    {
        // バリデーション
        $inputs = $request->validate([
            'm_area_id' => 'required',
            'm_category_id' => 'required',
            'name' => 'required|max:255',
            'image' => 'image|max:1024',
            'content' => 'required|max:255',
            'about' => 'required|max:1000',

        ]);

        $community->m_area_id = $request->m_area_id;
        $community->m_category_id = $request->m_category_id;
        $community->name = $request->name;
        $community->content = $request->content;
        $community->about = $request->about;
        $community->user_id = auth()->user()->id;
        if (request('image')) {
            $original = $request->file('image')->getClientOriginalName();
            // 日時追加
            $name = date('Ymd_His') . '_' . $original;
            request()->file('image')->move('storage/images', $name);
            $community->image = $name;
        }
        $community->save();
        return redirect()->route('community.show', $community)->with('message', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        $community->delete();
        return redirect()->route('community.index')->with('message', '投稿を削除しました');
    }

    public function dashboard()
    {
        $Communities = Community::orderBy('created_at', 'desc')->simplePaginate(5);
        $user = auth()->user();
        return view('dashboard', compact('communities', 'user'));
    }
}
