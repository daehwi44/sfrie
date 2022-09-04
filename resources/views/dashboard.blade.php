<x-app-layout>
    <x-slot name="header">
        <div class="bg-white h-14">
            <h2 class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8 font-semibold text-xl text-white-800 leading-tight">
                <span class="text-4xl">Sfrie</span>-学習仲間を見つける掲示板-
            </h2>
        </div>
    </x-slot>

    {{--メインビジュアル--}}
    <img src="{{asset('images/main.png')}}" class="w-full">
    {{--背景--}}
    <div class="bg-zinc-700 pb-14 bg-right bg-cover">
        {{--メインコンテンツ--}}
        <div class="mx-4 sm:p-2">
            <div class="mt-4">
                <div class="bg-white w-full rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                    {{--募集情報コンテナ--}}
                    <div class="mt-4">
                        <div class="flex pb-1 font-extrabold">
                            ★募集情報
                        </div>
                        @foreach ($boshujohos as $boshujoho)
                        <div class="mt-4 mx-4 sm:p-2">
                            {{-- アバターと名前 --}}
                            <div class="flex pb-1">
                                {{-- アバター --}}
                                <div>
                                    <img class="rounded-full w-12 h-12" src="{{asset('storage/avatar/'.($boshujoho->user->avatar??'user_default.jpg'))}}">
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
                            {{--本文(長い場合"..."表示)--}}
                            <p class="mt-4 text-gray-600 py-4">{{Str::limit($boshujoho->body, 500, '...')}} </p>
                            <div class="text-sm font-semibold flex flex-row-reverse">
                                <p>{{$boshujoho->created_at->diffForHumans()}}</p>
                            </div>
                            {{--投稿間の区切り線（太めの線）--}}
                            <hr class="w-full bg-gray-600 h-0.5">
                        </div>
                        @endforeach
                    </div>
                    <div class="flex justify-center">
                        <div>
                            <a href="{{ route('boshujoho.index') }}">
                                もっとみる
                            </a>
                        </div>
                    </div>
                </div>

                {{--学習コミュニティ一覧コンテナ--}}
                <div class="bg-white mt-10 w-full rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">

                    <div class="mt-4">
                        <div class="flex pb-1 font-extrabold">
                            ★学習コミュニティ一覧
                        </div>
                        @foreach ($communities as $community)
                        <div class="mt-4 mx-4 sm:p-2">
                            {{-- コミュニティ名 --}}
                            <div class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-3 pb-3">
                                <a href="{{route('post.index',['community_id' => $community->id])}}">コミュニティ名： {{ $community->name }}</a>
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


                            {{--投稿間の区切り線（太めの線）--}}
                            <hr class="w-full bg-gray-600 h-0.5">
                        </div>
                        @endforeach
                    </div>
                    <div class="flex justify-center">
                        <div>
                            <a href="{{ route('boshujoho.index') }}">
                                もっとみる
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>