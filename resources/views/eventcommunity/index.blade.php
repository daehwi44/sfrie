<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl bg-gray-800 leading-tight py-6 text-center tracking-wide">
            <span class="text-3xl text-white">
                {{ __('イベントコミュニティ') }}
            </span>
        </h2>
        <x-event-comindex-navi></x-event-comindex-navi>
        <x-message :message="session('message')" />
    </x-slot>

    {{-- 検索部分 --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-between items-center">
                {{-- Eventcommunityコントローラー/indexへGET --}}
                <form method="GET" action="{{ route('event.index') }}" class="w-full md:w-3/4 lg:w-4/5 mx-auto">
                    <div class="flex flex-wrap justify-between items-center">
                        {{-- 日付 --}}
                        <div class="w-full md:w-1/5 mb-4 md:mb-0">
                            <label for="event_date" class="block text-gray-700 font-bold mb-2">
                                {{ __('日付') }}
                            </label>
                            <input type="date" name="event_date" id="event_date"
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-500 transition duration-150 ease-in-out"
                                value="{{ request('event_date') }}">
                        </div>
                        {{-- 学習カテゴリー --}}
                        <div class="w-full md:w-1/5 mb-4 md:mb-0">
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
                        <div class="w-full md:w-1/5 mb-4 md:mb-0">
                            <label for="content" class="block text-gray-700 font-bold mb-2">
                                {{ __('学習内容') }}
                            </label>
                            <input type="text" name="content" id="content"
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-500 transition duration-150 ease-in-out"
                                value="{{ request('content') }}">
                        </div>
                        {{-- エリア --}}
                        <div class="w-full md:w-1/5 mb-4 md:mb-0">
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


    {{-- イベントコミュニティ一覧表示用のコード --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-2">
            <div class="mt-4">
                <div
                    class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="mt-4">

                        <div class="container px-6 py-10 mx-auto">
                            <h1
                                class="text-3xl font-semibold text-center text-gray-800 capitalize lg:text-4xl dark:text-white">
                                イベントコミュニティ一覧</h1>

                            <p class="max-w-2xl mx-auto my-6 text-center text-gray-500 dark:text-gray-300">
                                あなたの興味があるイベントのコミュニティを見つけましょう。
                            </p>

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
                                    @foreach ($communities->groupBy('event_date') as $date => $communitiesOnDate)
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>

</x-app-layout>
