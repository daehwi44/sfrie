<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\MArea;
use App\Models\MCategory;
use Illuminate\Http\Request;

class EventCommunityController extends Controller
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
        if ($request->filled('event_date')) {
            // $requestにevent_dateが含まれている場合、$requestのevent_dateの値に基づいて、クエリにwhere条件を追加
            $query->where('event_date', $request->event_date);
        }


        // is_eventが1の場合のみ、クエリにwhere条件を追加
        $query->where('is_event', 1);

        // クエリを実行して、結果を$communitiesに代入します。
        $communities = $query->orderBy('event_date', 'asc')->get();

        // ログインユーザー取得
        $user = auth()->user();

        return view('eventcommunity.index', compact('communities', 'user', 'categories', 'areas', 'request'));
    }

    public function create()
    {
        // areaテーブルの全データを取得する
        $areas = MArea::all();
        // categoryテーブルの全データを取得する
        $categories = MCategory::all();
        return view('eventcommunity.create', compact('areas', 'categories'));
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
        $community->is_event = $request->is_event;

        // event_dateカラムの値を設定
        $community->event_date = $request->event_date;

        $community->save();
        return redirect()->route('event.index')->with('message', 'コミュニティを作成しました');
    }
}
