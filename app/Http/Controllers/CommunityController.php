<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\CommunityUser;
use App\Models\MArea;
use App\Models\MCategory;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index(Request $request)
    {
        // MCategoryテーブルの全てのデータを取得し、$categoriesに代入します。
        $categories = MCategory::all();
        // MAreaテーブルの全てのデータを取得し、$areasに代入します。
        $areas = MArea::all();

        // Communityテーブルのデータを取得するためのクエリビルダー(PHPコードでSQLクエリを構築する機能)を作成します。
        $query = Community::query();

        // 検索条件
        if ($request->filled('category')) {
            // $requestにcategoryが含まれている場合、$requestのcategoryの値に基づいて、クエリにwhere条件を追加
            $query->where('m_category_id', $request->category);
        }
        if ($request->filled('content')) {
            // $requestにcontentが含まれている場合、$requestのcontentの値に基づいて、クエリにwhere条件を追加
            $query->where('content', 'LIKE', '%' . $request->content . '%');
        }
        if ($request->filled('area')) {
            // $requestにareaが含まれている場合、$requestのareaの値に基づいて、クエリにwhere条件を追加
            $query->where('m_area_id', $request->area);
        }

        // is_eventが0の場合のみ、クエリにwhere条件を追加
        $query->where('is_event', 0);

        // クエリを実行して、結果を$communitiesに代入します。
        $communities = $query->orderBy('created_at', 'desc')->get();

        // ログインユーザー取得
        $user = auth()->user();

        return view('community.index', compact('communities', 'user', 'categories', 'areas', 'request'));
    }

    public function create()
    {
        // areaテーブルの全データを取得する
        $areas = MArea::all();
        // categoryテーブルの全データを取得する
        $categories = MCategory::all();
        return view('community.create', compact('areas', 'categories'));
    }


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
            'event_date' => 'nullable|date',
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

        // is_eventカラムの値を設定
        $community->is_event = 0;

        // event_dateカラムの値を設定
        $community->event_date;

        $community->save();
        return redirect()->route('community.create')->with('message', 'コミュニティを作成しました');
    }

    public function show($community_id)
    {
        $community = Community::find($community_id);

        //ユーザーがすでにコミュニティに入っているかの判別
        $isJoin = CommunityUser::where('user_id', auth()->user()->id)->where('community_id', $community_id)->exists();

        return view('community.show', compact('community', 'isJoin'));
    }


    public function edit(Community $community)
    {
        // areaテーブルの全データを取得する
        $areas = MArea::all();
        // categoryテーブルの全データを取得する
        $categories = MCategory::all();

        return view('community.edit', compact('community', 'areas', 'categories'));
    }

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
        return redirect()->route('community.show', $community)->with('message', 'コミュニティを更新しました');
    }

    public function destroy(Community $community)
    {
        $community->delete();
        return redirect()->route('community.index')->with('message', 'コミュニティを削除しました');
    }

    // ユーザー一覧表示
    public function members($community_id)
    {
        $community = Community::find($community_id);
        $communities = Community::with('users')->where('id', $community_id)->get();
        // dd($communities);

        //ユーザーがすでにコミュニティに入っているかの判別
        $isJoin = CommunityUser::where('user_id', auth()->user()->id)->where('community_id', $community_id)->exists();


        return view('community.member', compact('community', 'communities', 'isJoin'));
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

        return view('community.member', compact('communities', 'community', 'isJoin'));
    }
}
