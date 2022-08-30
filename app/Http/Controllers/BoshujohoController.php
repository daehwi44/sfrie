<?php

namespace App\Http\Controllers;

use App\Models\Boshujoho;
use App\Models\M_area;
use App\Models\M_category;
use Illuminate\Http\Request;

class BoshujohoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boshujohos = Boshujoho::with('area', 'category')->get();
        $user = auth()->user();
        return view('boshujoho.index', compact('boshujohos', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // areaテーブルの全データを取得する
        $areas = M_area::all();
        // categoryテーブルの全データを取得する
        $categories = M_category::all();
        return view('boshujoho.create', compact('areas', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 以下、Requestに記述したが失敗、一旦保留
        // バリデーション
        $inputs = $request->validate([
            'title' => 'required|max:255',
            'm_area_id' => 'required',
            'm_category_id' => 'required',
            'content' => 'required|max:255',
            'body' => 'required|max:1000',
            'image' => 'image|max:1024'
        ]);

        //インスタンス化
        $boshujoho = new Boshujoho();

        $boshujoho->title = $request->title;
        $boshujoho->m_area_id = $request->m_area_id;
        $boshujoho->m_category_id = $request->m_category_id;
        $boshujoho->content = $request->content;
        $boshujoho->body = $request->body;
        $boshujoho->user_id = auth()->user()->id;
        if (request('image')) {
            $original = request()->file('image')->getClientOriginalName();
            // 日時追加
            $name = date('Ymd_His') . '_' . $original;
            request()->file('image')->move('storage/images', $name);
            $boshujoho->image = $name;
        }
        $boshujoho->save();
        return redirect()->route('boshujoho.create')->with('message', '投稿を作成しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Boshujoho  $boshujoho
     * @return \Illuminate\Http\Response
     */
    public function show(Boshujoho $boshujoho)
    {
        return view('boshujoho.show', compact('boshujoho'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Boshujoho  $boshujoho
     * @return \Illuminate\Http\Response
     */
    public function edit(Boshujoho $boshujoho)
    {
        // areaテーブルの全データを取得する
        $areas = M_area::all();
        // categoryテーブルの全データを取得する
        $categories = M_category::all();
        return view('boshujoho.edit', compact('boshujoho', 'areas', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Boshujoho  $boshujoho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Boshujoho $boshujoho)
    {

        // バリデーション
        $inputs = $request->validate([
            'title' => 'required|max:255',
            'm_area_id' => 'required',
            'm_category_id' => 'required',
            'content' => 'required|max:255',
            'body' => 'required|max:1000',
            'image' => 'image|max:1024'
        ]);

        $boshujoho->title = $request->title;
        $boshujoho->m_area_id = $request->m_area_id;
        $boshujoho->m_category_id = $request->m_category_id;
        $boshujoho->content = $request->content;
        $boshujoho->body = $request->body;
        $boshujoho->user_id = auth()->user()->id;
        if (request('image')) {
            $original = $request->file('image')->getClientOriginalName();
            // 日時追加
            $name = date('Ymd_His') . '_' . $original;
            request()->file('image')->move('storage/images', $name);
            $boshujoho->image = $name;
        }
        $boshujoho->save();
        return redirect()->route('boshujoho.show', $boshujoho)->with('message', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Boshujoho  $boshujoho
     * @return \Illuminate\Http\Response
     */
    public function destroy(Boshujoho $boshujoho)
    {
        $boshujoho->delete();
        return redirect()->route('boshujoho.index')->with('message', '投稿を削除しました');
    }
}
