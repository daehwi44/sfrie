<x-app-layout>
  <x-slot name="header">
    <x-boshujoho-navi></x-boshujoho-navi>
    <div class="bg-white">
      <h2 class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 font-semibold text-xl text-white-800 leading-tight">
        募集情報一覧
      </h2>
    </div>
    <x-message :message="session('message')" />
  </x-slot>

  {{-- 投稿一覧表示用のコード --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @foreach ($boshujohos as $boshujoho)
    <div class="mx-4 sm:p-2">
      <div class="mt-4">
        <div class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
          <div class="mt-4">
            <div class="flex pb-1">
              {{-- アバター --}}
              <div>
                <img class="rounded-full w-12 h-12 object-cover" src="{{asset('storage/avatar/'.($boshujoho->user->avatar??'user_default.jpg'))}}">
              </div>
              {{-- name --}}
              <div class="ml-2 ">
                <h1 class="text-lg text-gray-700 font-semibold float-left pt-3">
                  {{ $boshujoho->user->name??'削除されたユーザ' }}
                </h1>
              </div>
            </div>
            <hr class="w-full">
            {{-- title --}}
            <div class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-3 pb-3">
              <a href="{{route('boshujoho.show', $boshujoho)}}">{{ $boshujoho->title }}</a>
            </div>
            <hr class="w-full">
            {{-- エリア・カテゴリー・学習内容 --}}
            <div class="text-gray-700 pt-3 pb-3">
              <p>エリア：{{ $boshujoho->area->area }} / カテゴリー：{{ $boshujoho->category->category }} / 学習内容：{{ $boshujoho->content }}</p>
            </div>
            <hr class="w-full">
            {{--本文(長い場合"..."表示)--}}
            <p class="whitespace-pre-wrap mt-4 text-gray-600 py-4">{{Str::limit($boshujoho->body, 500, '...')}} </p>
            <div class="text-sm font-semibold flex flex-row-reverse">
              <p>{{$boshujoho->created_at->diffForHumans()}}</p>
            </div>
            <hr class="w-full mb-2">
            {{-- ここにコメント表示用--}}
            @if ($boshujoho->boshucomments->count())
            <span class="badge">
              返信 {{$boshujoho->boshucomments->count()}}件
            </span>
            @else
            <span>コメントはまだありません。</span>
            @endif
            <a href="{{route('boshujoho.show', $boshujoho)}}" style="color:white;">
              <x-button class="float-right">コメントする</x-button>
            </a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</x-app-layout>