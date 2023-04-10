<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl bg-gray-800 leading-tight py-6 text-center tracking-wide">
            <span class="text-3xl text-white">
                {{ __('学習コミュニティ') }}
            </span>
        </h2>
        <x-comindex-navi></x-comindex-navi>
        <x-message :message="session('message')" />
    </x-slot>

    {{-- 検索部分 --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-between items-center">
                {{-- communityコントローラー/indexへGET --}}
                <form method="GET" action="{{ route('community.index') }}" class="w-full md:w-2/3 lg:w-3/5 mx-auto">
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
                        {{-- 学習レベル(一旦保留) --}}
                        {{-- <div class="w-full md:w-1/4 mb-4 md:mb-0">
                            <label for="level" class="block text-gray-700 font-bold mb-2">
                                {{ __('学習レベル') }}
                            </label>
                            <select name="level" id="level"
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-500 transition duration-150 ease-in-out">
                                <option value="">{{ __('選択してください') }}</option>
                                <option value="1" {{ old('level', $request->level) == 1 ? 'selected' : '' }}>
                                    {{ __('★☆☆☆☆') }}</option>
                                <option value="2" {{ old('level', $request->level) == 2 ? 'selected' : '' }}>
                                    {{ __('★★☆☆☆') }}</option>
                                <option value="3" {{ old('level', $request->level) == 3 ? 'selected' : '' }}>
                                    {{ __('★★★☆☆') }}</option>
                                <option value="4" {{ old('level', $request->level) == 4 ? 'selected' : '' }}>
                                    {{ __('★★★★☆') }}</option>
                                <option value="5" {{ old('level', $request->level) == 5 ? 'selected' : '' }}>
                                    {{ __('★★★★★') }}</option>
                            </select>
                        </div> --}}

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


    {{-- 学習コミュニティ一覧表示用のコード --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-2">
            <div class="mt-4">
                <div
                    class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="mt-4">

                        <div class="container px-6 py-10 mx-auto">
                            <h1
                                class="text-3xl font-semibold text-center text-gray-800 capitalize lg:text-4xl dark:text-white">
                                学習コミュニティ一覧</h1>

                            <p class="max-w-2xl mx-auto my-6 text-center text-gray-500 dark:text-gray-300">
                                あなたが参加したいと思うコミュニティがこの中にあるはずです。まずはいろいろなコミュニティを覗いてみましょう。
                            </p>

                            {{-- コミュニティ4つならべ --}}
                            <div class="grid grid-cols-4 gap-8 mt-8 xl:mt-16 md:grid-cols-2 xl:grid-cols-4">

                                {{-- コミュニティ繰り返し表示 --}}
                                @foreach ($communities as $community)
                                    <a href="{{ route('post.index', ['community_id' => $community->id]) }}"
                                        class=" flex flex-col items-center p-8 transition-colors duration-300 transform border cursor-pointer rounded-xl hover:border-transparent group hover:bg-blue-600 dark:border-gray-700 dark:hover:border-transparent">

                                        {{-- コミュニティ画像 --}}
                                        <img class="object-cover w-32 h-32 rounded-full ring-4 ring-gray-300"
                                            src="{{ asset('storage/images/' . ($community->image ?? 'user_default.jpg')) }}">

                                        {{-- コミュニティ名 --}}
                                        <h1
                                            class="mt-4 text-2xl font-semibold text-gray-700 capitalize dark:text-white group-hover:text-white">
                                            {{ $community->name }}</h1>

                                        {{-- エリア --}}
                                        <p
                                            class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-300">
                                            エリア：{{ $community->area->area }} </p>

                                        {{-- カテゴリー --}}
                                        <p
                                            class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-300">
                                            カテゴリー：{{ $community->category->category }}</p>

                                        {{-- 学習内容 --}}
                                        <p
                                            class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-300">
                                            学習内容：{{ $community->content }}</p>

                                    </a>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
