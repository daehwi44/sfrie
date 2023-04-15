<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl bg-gray-800 leading-tight py-6 text-center tracking-wide">
            <span class="text-3xl text-white">
                {{ __('おすすめユーザー') }}
            </span>
        </h2>
    </x-slot>

    {{-- ユーザーの表示部分 --}}
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                @foreach ($recommendations as $user)
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
                                <div class="flex justify-center">
                                    <p class="text-xl my-2">
                                        {{ __('おすすめ度') }}<span
                                            class="font-semibold">{{ $scores[$user->id] }}</span>{{ __('％') }}
                                    </p>
                                </div>
                                <h4 class="font-semibold mt-2 group-hover:text-white">{{ __('居住エリア') }}</h4>
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
                                            <input type="hidden" name="requested_user_id" value="{{ $user->id }}">
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
