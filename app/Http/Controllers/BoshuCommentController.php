<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoshuCommentRequest;
use App\Models\BoshuComment;
use Illuminate\Http\Request;

class BoshuCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoshuCommentRequest $request)
    {
        // バリデーション済みデータの取得
        $validated = $request->validated();

        $boshucomments = BoshuComment::create([
            'body' => $validated['body'],
            'user_id' => auth()->user()->id,
            'boshujoho_id' => $request->boshujoho_id
        ]);

        return back()->with('message', 'コメントを投稿しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BoshuComment  $boshuComment
     * @return \Illuminate\Http\Response
     */
    public function show(BoshuComment $boshuComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BoshuComment  $boshuComment
     * @return \Illuminate\Http\Response
     */
    public function edit(BoshuComment $boshuComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BoshuComment  $boshuComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoshuComment $boshuComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoshuComment  $boshuComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoshuComment $boshuComment)
    {
        //
    }
}
