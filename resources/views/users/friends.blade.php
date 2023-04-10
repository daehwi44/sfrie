<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}の友達リスト
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($friends as $friend)
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:border-transparent group hover:bg-gray-400">
                        <div class="p-6 border-b border-gray-200">
                            <a href="{{ route('profile.show', ['user' => $friend->id]) }}">

                                <div class="flex justify-center items-center mb-4 ">
                                    <img src="{{ asset('storage/avatar/' . ($friend->avatar ?? 'user_default.jpg')) }}"
                                        class="w-48 h-48 rounded-full mx-auto ring-4 ring-gray-300">
                                </div>
                                <div class="flex flex-wrap justify-center items-end">
                                    <h4 class="text-5xl font-bold">{{ $friend->name }}</h4>
                                    <p class="text-2xl ml-8">{{ \Carbon\Carbon::parse($friend->birth)->age }}歳</p>
                                    <p class="text-2xl ml-8">{{ $friend->gender }}</p>
                                </div>
                                <h4 class="font-semibold mt-2 group-hover:text-white">{{ __('エリア') }}</h4>
                                <p class="group-hover:text-white ml-2">{{ optional($friend->MArea)->area }}</p>
                                <h4 class="font-semibold mt-2 group-hover:text-white">{{ __('興味のある学習カテゴリー') }}</h4>
                                <p class="group-hover:text-white ml-2">{{ optional($friend->MCategory)->category }}</p>
                                {{-- いつかは複数表示させるようにする、、、 --}}
                                <div class="mt-2">
                                    <h4 class="font-semibold group-hover:text-white">{{ __('現在の学習内容') }}</h4>
                                    <ul class="list-disc-none group-hover:text-white ml-2">
                                        @foreach ($friend->contents as $content)
                                            @if ($content->level == 1)
                                                <li>{{ $content->content }} （学習レベル：★☆☆☆☆）</li>
                                            @elseif ($content->level == 2)
                                                <li>{{ $content->content }} （学習レベル：★★☆☆☆）</li>
                                            @elseif ($content->level == 3)
                                                <li>{{ $content->content }} （学習レベル：★★★☆☆）</li>
                                            @elseif ($content->level == 4)
                                                <li>{{ $content->content }} （学習レベル：★★★★☆）</li>
                                            @else
                                                <li>{{ $content->content }} （学習レベル：★★★★★）</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <h4 class="font-semibold mt-2 group-hover:text-white">{{ __('自己紹介') }}</h4>
                                <p class="group-hover:text-white ml-2">{{ $friend->intro }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
