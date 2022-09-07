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

                {{--募集情報コンテナ--}}
                <div class="bg-white max-w-7xl mx-auto rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">

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
                <div class="bg-white mt-10 max-w-7xl mx-auto rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">

                    <div class="mt-4">
                        <div class="flex pb-1 font-extrabold">
                            ★学習コミュニティ一覧
                        </div>
                        <div class="grid grid-cols-4 gap-8 mt-8 xl:mt-16 md:grid-cols-2 xl:grid-cols-4">

                            {{-- コミュニティ繰り返し表示 --}}
                            @foreach ($communities as $community)
                            <a href="{{route('post.index',['community_id' => $community->id])}}" class=" flex flex-col items-center p-8 transition-colors duration-300 transform border cursor-pointer rounded-xl hover:border-transparent group hover:bg-blue-600 dark:border-gray-700 dark:hover:border-transparent">

                                {{-- コミュニティ画像 --}}
                                <img class="object-cover w-32 h-32 rounded-full ring-4 ring-gray-300" src="{{asset('storage/images/'.($community->image??'user_default.jpg'))}}">

                                {{-- コミュニティ名 --}}
                                <h1 class="mt-4 text-2xl font-semibold text-gray-700 capitalize dark:text-white group-hover:text-white">{{ $community->name }}</h1>

                                {{-- エリア --}}
                                <p class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-300">エリア：{{ $community->area->area }} </p>

                                {{-- カテゴリー --}}
                                <p class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-300">カテゴリー：{{ $community->category->category }}</p>

                                {{-- 学習内容 --}}
                                <p class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-300">学習内容：{{ $community->content }}</p>

                            </a>
                            @endforeach

                        </div>
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