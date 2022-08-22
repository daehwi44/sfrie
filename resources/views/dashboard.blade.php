<x-app-layout>
    <x-slot name="header">
        <div class="bg-white h-14">
            <h2 class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8 font-semibold text-xl text-white-800 leading-tight">
                <span class="text-4xl">Sfrie</span>-学習仲間を見つける掲示板-
            </h2>
        </div>
    </x-slot>

    {{--メインビジュアル--}}
    <img src="{{asset('images/main.png')}}">
    {{--背景--}}
    <div class="h-screen pb-14 bg-right bg-cover">
        {{--メインコンテンツ--}}
        <div class="mx-4 sm:p-2">
            <div class="mt-4">
                <div class="bg-white w-full rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                    {{--募集情報コンテナ--}}
                    <div class="mt-4">
                        <div class="flex pb-1 font-extrabold">
                            ★募集情報
                        </div>
                        @foreach ($posts as $post)
                        <div class="mt-4 mx-4 sm:p-2">
                            {{-- アバターと名前 --}}
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
                            {{--投稿間の区切り線（太めの線）--}}
                            <hr class="w-full bg-gray-600 h-0.5">
                        </div>
                        @endforeach
                    </div>
                    <div class="flex justify-center">
                        <div>
                            <a href="{{ route('post.index') }}">
                                もっとみる
                            </a>
                        </div>
                    </div>

                    {{--学習コミュニティ一覧コンテナ--}}
                    <div class="mt-4">
                        <div class="flex pb-1 font-extrabold">
                            ★学習コミュニティ一覧
                        </div>
                        @foreach ($posts as $post)
                        <div class="mt-4 mx-4 sm:p-2">
                            {{-- アバターと名前 --}}
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
                            {{--投稿間の区切り線（太めの線）--}}
                            <hr class="w-full bg-gray-600 h-0.5">
                        </div>
                        @endforeach
                    </div>
                    <div class="flex justify-center">
                        <div>
                            <a href="{{ route('post.index') }}">
                                もっとみる
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>