<x-app-layout>
    <x-slot name="header">
        <div class="bg-white py-2">
            <h2
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 font-semibold text-base text-gray-800 leading-tight text-right">
                <span class="text-2xl mr-2">Sfrie</span>-学習仲間を見つけるためのSNS-
            </h2>
        </div>
    </x-slot>

    {{-- メインビジュアル --}}
    <img src="{{ asset('images/main.png') }}" class="w-full">

    <div class="md:flex justify-center my-5 ">
        {{-- 左側のカラム
        <div class="w-full  md:w-1/5 p-1">
            <div
                class="w-full bg-white rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500 h-full">


            </div>

        </div> --}}

        {{-- 右側のカラム --}}
        <div class="w-full md:w-3/5 p-1">

            {{-- 募集情報コンテナ --}}
            <div class="w-full bg-white rounded px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">

                <div class="my-4">
                    <div class="flex pb-1 font-extrabold text-2xl">
                        ◆学習仲間募集情報
                    </div>
                    @foreach ($boshujohos as $boshujoho)
                        <div class="mt-4 mx-4 sm:p-2">
                            {{-- アバターと名前 --}}
                            <div class="flex pb-1">
                                {{-- アバター --}}
                                <div>
                                    <img class="rounded-full w-12 h-12 object-cover"
                                        src="{{ asset('storage/avatar/' . ($boshujoho->user->avatar ?? 'user_default.jpg')) }}">
                                </div>
                                {{-- name --}}
                                <div class="ml-2 ">
                                    <h1 class="text-lg text-gray-700 font-semibold float-left pt-3">
                                        {{ $boshujoho->user->name ?? '削除されたユーザ' }}
                                    </h1>
                                </div>
                            </div>
                            <hr class="w-full">
                            {{-- title --}}
                            <div
                                class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-3 pb-3">
                                <a href="{{ route('boshujoho.show', $boshujoho) }}">{{ $boshujoho->title }}</a>
                            </div>
                            <hr class="w-full">
                            {{-- エリア・カテゴリー・学習内容 --}}
                            <div class="text-gray-700 pt-3 pb-3">
                                <div class="flex space-x-4 text-gray-700">
                                    <div class="py-1">
                                        <p class="font-semibold">エリア:</p>
                                    </div>
                                    <div class="bg-blue-100 border border-blue-500 rounded-2xl px-2 py-1 mx-1">
                                        <p class="font-semibold text-blue-800">{{ $boshujoho->area->area }}</p>
                                    </div>
                                    <div class="py-1">
                                        <p class="font-semibold">学習カテゴリー:</p>
                                    </div>
                                    <div class="bg-green-100 border border-green-500 rounded-2xl px-2 py-1 mx-1">
                                        <p class="font-semibold text-green-800">{{ $boshujoho->category->category }}
                                        </p>
                                    </div>
                                    <div class="py-1">
                                        <p class="font-semibold">学習内容:</p>
                                    </div>
                                    <div class="border rounded-2xl px-2 py-1 mx-1">
                                        <p class="font-semibold">{{ $boshujoho->content }}</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <hr class="w-full">
                                {{-- 本文(長い場合"..."表示) --}}
                                <p class="mt-4 text-gray-600 py-4">
                                    {{ Str::limit($boshujoho->body, 500, '...') }}</p>
                                <div class="text-sm font-semibold flex flex-row-reverse">
                                    <p>{{ $boshujoho->created_at->diffForHumans() }}</p>
                                </div>
                                {{-- 投稿間の区切り線（太めの線） --}}
                                <hr class="w-full bg-gray-600 h-0.5">
                            </div>
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

            {{-- 学習コミュニティ一覧コンテナ --}}
            <div
                class="w-full bg-white mt-10 mx-auto rounded px-4 sm:px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                <div class="w-full my-4">
                    <div class="flex pb-1 font-extrabold text-2xl">
                        ◆学習コミュニティ一覧
                    </div>
                    <div class="grid gap-8 mt-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                        {{-- コミュニティ繰り返し表示 --}}
                        @foreach ($communities as $community)
                            <a href="{{ route('post.index', ['community_id' => $community->id]) }}"
                                class="flex flex-col items-center p-8 transition-colors duration-300 transform border cursor-pointer rounded-xl hover:border-transparent group hover:bg-blue-600 dark:border-gray-700 dark:hover:border-transparent">
                                {{-- コミュニティ画像 --}}
                                <img class="object-cover w-32 h-32 rounded-full ring-4 ring-gray-300"
                                    src="{{ asset('storage/images/' . ($community->image ?? 'user_default.jpg')) }}">
                                {{-- コミュニティ名 --}}
                                <h1
                                    class="mt-4 text-2xl font-semibold text-gray-700 capitalize dark:text-white group-hover:text-white">
                                    {{ $community->name }}</h1>
                                {{-- エリア --}}
                                <p class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-300">
                                    エリア：{{ $community->area->area }} </p>
                                {{-- カテゴリー --}}
                                <p class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-300">
                                    カテゴリー：{{ $community->category->category }}</p>
                                {{-- 学習内容 --}}
                                <p class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-300">
                                    学習内容：{{ $community->content }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-center">
                    <div>
                        <a href="{{ route('community.index') }}">
                            もっとみる
                        </a>
                    </div>
                </div>
            </div>


            {{-- イベントコミュニティ一覧コンテナ --}}
            <div
                class="w-full bg-white mt-10 mx-auto px-4 sm:px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                <div class="w-full my-4">
                    <div class="flex pb-1 font-extrabold text-2xl">
                        ◆イベントコミュニティ一覧
                    </div>



                    {{-- 日付ごとにコミュニティリストを表示 --}}
                    <table class="w-full border-collapse border">
                        <thead class="bg-blue-100">
                            <tr>
                                <th class="w-2/10 px-4 py-2 border">{{ __('日付') }}</th>
                                <th class="w-3/10 px-4 py-2 border">{{ __('イベント名') }}</th>
                                <th class="w-1/10 px-4 py-2 border">{{ __('開催エリア') }}</th>
                                <th class="w-1/10 px-4 py-2 border">{{ __('カテゴリー') }}</th>
                                <th class="w-3/10 px-4 py-2 border">{{ __('学習内容') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eventcommunities->groupBy('event_date') as $date => $communitiesOnDate)
                                <tr>
                                    <td class="w-2/12 px-4 py-4 border text-center"
                                        rowspan="{{ count($communitiesOnDate) }}">
                                        {{ \Carbon\Carbon::parse($date)->format('Y/m/d') }}
                                        {{ \Carbon\Carbon::parse($date)->formatLocalized('(%a)') }}
                                    </td>
                                    @foreach ($communitiesOnDate as $key => $community)
                                        @if ($key > 0)
                                <tr>
                            @endif
                            <td class="w-2/10 px-4 py-4 border">
                                <ul class="flex">
                                    <li class="flex items-center">
                                        {{-- イベント画像 --}}
                                        <img class="object-cover w-10 h-full rounded-full ring-1 ring-gray-100"
                                            src="{{ asset('storage/images/' . ($community->image ?? 'user_default.jpg')) }}">
                                    </li>
                                    <li class="ml-2 flex items-center">
                                        <a href="{{ route('post.index', ['community_id' => $community->id]) }}"
                                            class="flex-grow flex items-center font-semibold hover:underline">
                                            {{ $community->name }}
                                        </a>
                                    </li>
                                </ul>
                            </td>
                            <td class="w-1/10 px-4 py-4 border text-center">{{ $community->area->area }}
                            </td>
                            <td class="w-3/10 px-4 py-4 border text-center">
                                {{ $community->category->category }}</td>
                            <td class="w-3/12 px-4 py-4 border">{{ $community->content }}</td>
                            @if ($key > 0)
                                </tr>
                            @endif
                            @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-center">
                    <div>
                        <a href="{{ route('event.index') }}">
                            もっとみる
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <footer class="bg-black text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row justify-between items-center">
            <div class="text-center lg:text-left mb-2 lg:mb-0">
                <p class="text-gray-400 text-sm">&copy; 2023 Sfrie Inc.</p>
            </div>
            <div class="text-center mb-2 lg:mb-0">
                <a href="#" class="text-gray-400 text-sm hover:text-white transition duration-300">利用規約</a>
                <span class="mx-2 text-gray-400 text-sm">|</span>
                <a href="#" class="text-gray-400 text-sm hover:text-white transition duration-300">プライバシーポリシー</a>
            </div>
            <div class="text-center lg:text-right">
                <p class="text-gray-400 text-sm">お問い合わせはこちら<br>contact@sfrie.com</p>
            </div>
        </div>
    </footer>

</x-app-layout>
