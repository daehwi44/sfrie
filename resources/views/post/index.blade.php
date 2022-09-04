<x-app-layout>
  <x-slot name="header">
    <x-message :message="session('message')" />
  </x-slot>


  <div class='flex'>

    {{-- サイドバー --}}
    <div class="flex flex-col w-1/4 py-8 bg-white border-r dark:bg-gray-900 dark:border-gray-700">
      <h2 class="text-3xl font-semibold text-center text-gray-800 dark:text-white">{{ $community->name }}</h2>

      <div class="flex flex-col items-center mt-6 -mx-2">
        @if($community->image)
        <img class="object-cover w-24 h-24 mx-2 rounded-full" src="{{ asset('storage/images/'.$community->image)}}">
        @endif
        <h4 class="mx-2 mt-2 font-medium text-gray-800 dark:text-gray-200 hover:underline">代表者:{{ $community->user->name }}</h4>
        <p class="mx-2 mt-1 text-sm font-medium text-gray-600 dark:text-gray-400 hover:underline">エリア：{{ $community->area->area }} / 学習内容：{{ $community->content }}</p>
      </div>

      <div class="flex flex-col justify-between flex-1 mt-6">
        <nav>

          <a href="{{route('post.index',['community_id' => $community->id])}}" class="flex items-center px-4 py-2 text-gray-600 transition-colors duration-300 transform dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="mx-4 font-medium">投稿一覧</span>
          </a>

          <a href="{{route('post.create',['community_id' => $community->id])}}" class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15 5V7M15 11V13M15 17V19M5 5C3.89543 5 3 5.89543 3 7V10C4.10457 10 5 10.8954 5 12C5 13.1046 4.10457 14 3 14V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V14C19.8954 14 19 13.1046 19 12C19 10.8954 19.8954 10 21 10V7C21 5.89543 20.1046 5 19 5H5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="mx-4 font-medium">投稿新規作成</span>
          </a>

          <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700" href="#">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="mx-4 font-medium">コミュニティメンバー一覧</span>
          </a>

          <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700" href="#">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10.3246 4.31731C10.751 2.5609 13.249 2.5609 13.6754 4.31731C13.9508 5.45193 15.2507 5.99038 16.2478 5.38285C17.7913 4.44239 19.5576 6.2087 18.6172 7.75218C18.0096 8.74925 18.5481 10.0492 19.6827 10.3246C21.4391 10.751 21.4391 13.249 19.6827 13.6754C18.5481 13.9508 18.0096 15.2507 18.6172 16.2478C19.5576 17.7913 17.7913 19.5576 16.2478 18.6172C15.2507 18.0096 13.9508 18.5481 13.6754 19.6827C13.249 21.4391 10.751 21.4391 10.3246 19.6827C10.0492 18.5481 8.74926 18.0096 7.75219 18.6172C6.2087 19.5576 4.44239 17.7913 5.38285 16.2478C5.99038 15.2507 5.45193 13.9508 4.31731 13.6754C2.5609 13.249 2.5609 10.751 4.31731 10.3246C5.45193 10.0492 5.99037 8.74926 5.38285 7.75218C4.44239 6.2087 6.2087 4.44239 7.75219 5.38285C8.74926 5.99037 10.0492 5.45193 10.3246 4.31731Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="mx-4 font-medium">コミュニティ詳細</span>
          </a>

        </nav>
      </div>
    </div>

    {{-- 投稿一覧表示用のコード --}}
    <div class="w-3/4 mx-auto px-1 sm:px-6 lg:px-8">
      {{$user->name}}さん、こんにちは！
      @foreach ($posts as $post)
      <div class="mx-1 sm:p-2">
        <div class="mt-4">
          <div class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
            <div class="mt-4">
              <div class="flex pb-1">
                {{-- アバター --}}
                <div>
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
              <hr class="w-full">
              {{--本文(長い場合"..."表示)--}}
              <p class="mt-4 text-gray-600 py-4">{{Str::limit($post->body, 500, '...')}} </p>
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
      </div>
      @endforeach
    </div>


  </div>
</x-app-layout>