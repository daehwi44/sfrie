<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl bg-gray-800 leading-tight py-6 text-center tracking-wide">
            <span class="text-3xl text-white">
                {{ __('学習仲間の募集掲示板') }}
            </span>
        </h2>
        <x-boshujoho-navi></x-boshujoho-navi>
        <x-message :message="session('message')" />
    </x-slot>

    {{-- 検索部分 --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-between items-center">
                {{-- boshujohoコントローラー/indexへGET --}}
                <form method="GET" action="{{ route('boshujoho.index') }}" class="w-full md:w-2/3 lg:w-3/5 mx-auto">
                    <div class="flex flex-wrap justify-between items-center">
                        <div class="w-full md:w-1/4 mb-4 md:mb-0">
                            {{-- 学習カテゴリー --}}
                            <label for="category" class="block text-gray-700 font-bold mb-2">
                                {{ __('学習カテゴリー') }}
                            </label>
                            <select name="category" id="category"
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-500 transition duration-150 ease-in-out">
                                <option value="">{{ __('選択してください') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == request('category') ? 'selected' : '' }}>
                                        {{ $category->category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- 学習内容 --}}
                        <div class="w-full md:w-1/4 mb-4 md:mb-0">
                            <label for="content" class="block text-gray-700 font-bold mb-2">
                                {{ __('学習内容') }}
                            </label>
                            <input type="text" name="content" id="content"
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-500 transition duration-150 ease-in-out"
                                value="{{ request('content') }}">
                        </div>
                        {{-- エリア --}}
                        <div class="w-full md:w-1/4 mb-4 md:mb-0">
                            <label for="area" class="block text-gray-700 font-bold mb-2">
                                {{ __('エリア') }}
                            </label>
                            <select name="area" id="area"
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-500 transition duration-150 ease-in-out">
                                <option value="">{{ __('選択してください') }}</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"
                                        {{ $area->id == request('area') ? 'selected' : '' }}>
                                        {{ $area->area }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end items-center mt-4">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md mx-auto">
                            {{ __('検索') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- 投稿一覧表示用のコード --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @foreach ($boshujohos as $boshujoho)
            <div class="mx-4 sm:p-2">
                <div class="mt-4">
                    <div
                        class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                        <div class="mt-4">
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
                                <p>エリア：{{ $boshujoho->area->area }} / カテゴリー：{{ $boshujoho->category->category }} /
                                    学習内容：{{ $boshujoho->content }}</p>
                            </div>
                            <hr class="w-full">
                            {{-- 本文(長い場合"..."表示) --}}
                            <p class="mt-4 text-gray-600 py-4">
                                {{ Str::limit($boshujoho->body, 500, '...') }} </p>
                            <div class="text-sm font-semibold flex flex-row-reverse">
                                <p>{{ $boshujoho->created_at->diffForHumans() }}</p>
                            </div>
                            <hr class="w-full mb-2">
                            {{-- ここにコメント表示用 --}}
                            @if ($boshujoho->boshucomments->count())
                                <span class="badge">
                                    返信 {{ $boshujoho->boshucomments->count() }}件
                                </span>
                            @else
                                <span>コメントはまだありません。</span>
                            @endif
                            <a href="{{ route('boshujoho.show', $boshujoho) }}" style="color:white;">
                                <x-button class="float-right">コメントする</x-button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
