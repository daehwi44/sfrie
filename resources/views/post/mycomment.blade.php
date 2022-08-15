<x-app-layout>
  <x-slot name="header">
    <x-community-navi></x-community-navi>
    <div class="bg-white">
      <h2 class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 font-semibold text-xl text-white-800 leading-tight">
        コメントした投稿一覧
      </h2>
    </div>
    <x-message :message="session('message')" />
  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- 投稿がない場合 --}}
    @if (count($comments) == 0)
    <p class="mt-4">
      あなたはまだコメントしていません。
    </p>
    @else
    @foreach ($comments->unique('post_id') as $comment)
    @php
    //コメントした投稿
    $post = $comment->post;
    @endphp
    <div class="mx-4 sm:p-2">
      <div class="mt-4">
        <div class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
          <div class="mt-4">
            <div class="flex pb-1">
              <div>
                {{-- アバター表示 --}}
                <img class="rounded-full w-12 h-12" src="{{asset('storage/avatar/'.($post->user->avatar??'user_default.jpg'))}}">
              </div>
              {{-- name --}}
              <div class="ml-2 ">
                <h1 class="text-lg text-gray-700 font-semibold float-left pt-3">
                  {{ $post->user->name??'削除されたユーザ' }}
                </h1>
              </div>
            </div>
            <hr class="w-full">
            {{-- title --}}
            <div class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-3 pb-3">
              <a href="{{route('post.show', $post)}}">{{ $post->title }}</a>
            </div>
          </div>
          <hr class="w-full">
          <p class="mt-4 text-gray-600 py-4">{{Str::limit ($post->body, 500, ' …' )}} </p>
          <div class="text-sm font-semibold flex flex-row-reverse">
            <p>{{$post->created_at->diffForHumans()}}</p>
          </div>
          <hr class="w-full mb-2">
          @if ($post->comments->count())
          <span class="badge">
            返信 {{$post->comments->count()}}件
          </span>
          @else
          <span>コメントはまだありません。</span>
          @endif
          <a href="{{route('post.show', $post)}}" style="color:white;">
            <x-button class="float-right">コメントする</x-button>
          </a>
        </div>
      </div>
    </div>
    @endforeach
    @endif
  </div>
</x-app-layout>