<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl bg-gray-800 leading-tight py-6 text-center tracking-wide">
            <span class="text-3xl text-white">
                {{ __('ユーザー一覧') }}
            </span>
        </h2>
    </x-slot>

    {{-- 検索部分 --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-between items-center">
                {{-- userコントローラー/indexへGET --}}
                <form method="GET" action="{{ route('users.index') }}" class="w-full md:w-2/3 lg:w-3/5 mx-auto">
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
                        {{-- 学習レベル --}}
                        <div class="w-full md:w-1/4 mb-4 md:mb-0">
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
                        </div>
                    </div>

                    <div class="flex flex-wrap justify-between items-center mt-4">
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
                        {{-- 性別 --}}
                        <div class="w-full md:w-1/4 mb-4 md:mb-0">
                            <label for="gender" class="block text-gray-700 font-bold mb-2">
                                {{ __('性別') }}
                            </label>
                            <select name="gender" id="gender"
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-500 transition duration-150 ease-in-out">
                                <option value="">{{ __('選択してください') }}</option>
                                <option value="男性" {{ 'male' == request('gender') ? 'selected' : '' }}>
                                    {{ __('男性') }}</option>
                                <option value="女性" {{ 'female' == request('gender') ? 'selected' : '' }}>
                                    {{ __('女性') }}</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/4 mb-4 md:mb-0 flex flex-wrap justify-between items-center">
                            {{-- 年齢 --}}
                            <div class="w-full md:w-2/5 mb-4 md:mb-0">
                                <label for="age_from" class="block text-gray-700 font-bold mb-2">
                                    {{ __('年齢') }}
                                </label>
                                <input type="number" name="age_from" id="age_from"
                                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-500 transition duration-150 ease-in-out"
                                    value="{{ request('age_from') }}" min="0">
                            </div>
                            <div class="w-full md:w-1/5 mb-4 md:mb-0">
                                <p class="mt-8 pl-2.5">
                                    ～
                                </p>
                            </div>
                            <div class="w-full md:w-2/5 mb-4 md:mb-0">
                                <input type="number" name="age_to" id="age_to"
                                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 mt-8 px-4 py-2 pr-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-500 transition duration-150 ease-in-out"
                                    value="{{ request('age_to') }}" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end items-center mt-4">
                        <button type="submit"
                            class="bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-md mx-auto">
                            {{ __('検索') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- ユーザーの表示部分 --}}
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                @foreach ($users as $user)
                    <div
                        class="bg-white overflow-hidden shadow-sm rounded-lg hover:border-transparent group hover:bg-gray-400">
                        <div class="p-4">
                            <a href="{{ route('profile.show', ['user' => $user->id]) }}">

                                <div class="flex justify-center items-center mb-2">
                                    <img src="{{ asset('storage/avatar/' . ($user->avatar ?? 'user_default.jpg')) }}"
                                        class="w-32 h-32 md:w-40 md:h-40 rounded-full mx-auto ring-4 ring-gray-300">
                                </div>
                                <div class="flex flex-wrap justify-center items-center">
                                    <h4 class="text-3xl font-bold">{{ $user->name }}</h4>
                                    <p class="text-xl ml-4">{{ \Carbon\Carbon::parse($user->birth)->age }}歳</p>
                                    <p class="text-xl ml-4">{{ $user->gender }}</p>
                                </div>
                                <h4 class="font-semibold mt-2 group-hover:text-white">{{ __('エリア') }}</h4>
                                <p class="group-hover:text-white ml-2 text-base">{{ optional($user->MArea)->area }}</p>
                                <h4 class="font-semibold mt-2 group-hover:text-white">{{ __('興味のある学習カテゴリー') }}</h4>
                                <p class="group-hover:text-white ml-2 text-base">
                                    {{ optional($user->MCategory)->category }}</p>
                                <div class="mt-2">
                                    <h4 class="font-semibold group-hover:text-white">{{ __('現在の学習内容') }}</h4>
                                    <ul class="list-disc-none group-hover:text-white ml-2 text-base">
                                        @foreach ($user->contents as $content)
                                            @if ($content->level == 1)
                                                <li>{{ $content->content }} </li>
                                                <li>（レベル:★☆☆☆☆）</li>
                                            @elseif ($content->level == 2)
                                                <li>{{ $content->content }} </li>
                                                <li>（レベル:★★☆☆☆）</li>
                                            @elseif ($content->level == 3)
                                                <li>{{ $content->content }} </li>
                                                <li>（レベル:★★★☆☆）</li>
                                            @elseif ($content->level == 4)
                                                <li>{{ $content->content }} </li>
                                                <li>（レベル:★★★☆☆）</li>
                                            @else
                                                <li>{{ $content->content }} </li>
                                                <li>（レベル:★★★☆☆）</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </a>
                            {{-- 友達申請ボタン --}}
                            @if (Auth::id() !== $user->id)
                                <div class="flex justify-center items-center mt-4">
                                    @if (Auth::user()->isFriendRequested($user->id))
                                        {{-- チャットボタン --}}
                                        @if (Auth::user()->isFriend($user->id))
                                            <a href="{{ route('chat.show', ['user' => $user->id]) }}"
                                                class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">chatを開始する</a>
                                        @else
                                            <button type="button"
                                                class="bg-gray-400 text-white py-2 px-4 rounded-md cursor-not-allowed"
                                                disabled>申請済</button>
                                        @endif
                                    @else
                                        <form id="friend-request-form-{{ $user->id }}"
                                            action="{{ route('friend_request.send') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                            <input type="hidden" name="requested_user_id"
                                                value="{{ $user->id }}">
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md friend-request-btn"
                                                data-user-id="{{ $user->id }}">Sfrie申請を送信する</button>
                                        </form>
                                    @endif
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var friendRequestForms = document.querySelectorAll('.friend-request-btn');
                        friendRequestForms.forEach(function(friendRequestForm) {
                            friendRequestForm.addEventListener('click', function() {
                                this.disabled = true;
                                this.innerText = '申請中...';
                                this.closest('form').submit();
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>



</x-app-layout>
