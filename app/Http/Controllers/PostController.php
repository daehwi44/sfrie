<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Community;
use App\Models\CommunityUser;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($community_id)
    {
        $posts = Post::where('community_id', $community_id)->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        $community = Community::find($community_id);

        //ユーザーがすでにコミュニティに入っているかの判別
        $isJoin = CommunityUser::where('user_id', auth()->user()->id)->where('community_id', $community_id)->exists();
        

        return view('post.index', compact('posts', 'user','community', 'isJoin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($community_id)
    {

        $community = Community::find($community_id);
        //ユーザーがすでにコミュニティに入っているかの判別
        $isJoin = CommunityUser::where('user_id', auth()->user()->id)->where('community_id', $community_id)->exists();

        return view('post.create', compact('community', 'isJoin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $community = Community::find($request->community_id);
        // 以下、Requestに記述したが失敗、一旦保留
        // バリデーション
        $inputs = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:1000',
            'image' => 'image|max:1024'
        ]);

        //インスタンス化
        $post = new Post();

        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
        $post->community_id = $request->community_id;
        if (request('image')) {
            $original = $request->file('image')->getClientOriginalName();
            // 日時追加
            $name = date('Ymd_His') . '_' . $original;
            request()->file('image')->move('storage/images', $name);
            $post->image = $name;
        }
        $post->save();
        return redirect()->route('post.index', ['community_id' => $community->id])->with('message', '投稿を作成しました');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $community = Community::find($post->community_id);

        //ユーザーがすでにコミュニティに入っているかの判別
        $isJoin = CommunityUser::where('user_id', auth()->user()->id)->where('community_id', $post->community_id)->exists();

        return view('post.show', compact('post','community', 'isJoin'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $community = Community::find($post->community_id);

        //ユーザーがすでにコミュニティに入っているかの判別
        $isJoin = CommunityUser::where('user_id', auth()->user()->id)->where('community_id', $post->community_id)->exists();

        return view('post.edit', compact('post','community', 'isJoin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $inputs = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:1000',
            'image' => 'image|max:1024'
        ]);

        $post->title = $request->title;
        $post->body = $request->body;

        if (request('image')) {
            $original = $request->file('image')->getClientOriginalName();
            $name = date('Ymd_His') . '_' . $original;
            $file = request()->file('image')->move('storage/images', $name);
            $post->image = $name;
        }

        $post->save();

        return redirect()->route('post.show', $post)->with('message', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //投稿に対するコメント削除
        $post->comments()->delete();
        //投稿を削除
        $post->delete();
        return redirect()->route('post.index')->with('message', '投稿を削除しました');
    }

    //自分の投稿のみ表示
    public function mypost()
    {
        $user = auth()->user()->id;
        $posts = Post::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return view('post.mypost', compact('posts'));
    }

    //コメントした投稿のみ表示
    public function mycomment()
    {
        $user = auth()->user()->id;
        $comments = Comment::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return view('post.mycomment', compact('comments'));
    }
}
