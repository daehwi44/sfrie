<x-app-layout>
  <x-slot name="header">
    <x-comindex-navi></x-comindex-navi>
    <div class="bg-white">
      <h2 class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 font-semibold text-xl text-white-800 leading-tight">
        学習コミュニティ一覧
      </h2>
    </div>
    <x-message :message="session('message')" />
  </x-slot>

  {{-- 学習コミュニティ一覧表示用のコード --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @foreach ($communities as $community)
    <div class="mx-4 sm:p-2">
      <div class="mt-4">
        <div class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
          <div class="mt-4">
            {{-- コミュニティ名 --}}
            <div class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-3 pb-3">
              <a href="{{route('community.show', $community)}}">コミュニティ名：   {{ $community->name }}</a>
            </div>
            <hr class="w-full">
            <div class="flex pb-1">
              代表者：
              {{-- アバター --}}
              <div>
                <img class="rounded-full w-12 h-12" src="{{asset('storage/avatar/'.($community->user->avatar??'user_default.jpg'))}}">
              </div>
              {{-- name --}}
              <div class="ml-2 ">
                <h1 class="text-lg text-gray-700 font-semibold float-left pt-3">
                  {{ $community->user->name??'削除されたユーザ' }}
                </h1>
              </div>
            </div>
            <hr class="w-full">
            {{-- title --}}
            <div class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-3 pb-3">
              <a href="{{route('community.show', $community)}}">{{ $community->title }}</a>
            </div>
            <hr class="w-full">
            {{-- エリア・カテゴリー・学習内容 --}}
            <div class="text-gray-700 pt-3 pb-3">
              <p>エリア：{{ $community->area->area }} / カテゴリー：{{ $community->category->category }} / 学習内容：{{ $community->content }}</p>
            </div>
            <hr class="w-full">
            {{--本文(長い場合"..."表示)--}}
            <p class="mt-4 text-gray-600 py-4">{{Str::limit($community->about, 500, '...')}} </p>
            <div class="text-sm font-semibold flex flex-row-reverse">
              <p>{{$community->created_at->diffForHumans()}}</p>
            </div>
            <hr class="w-full mb-2">
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</x-app-layout>