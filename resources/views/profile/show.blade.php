<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap">

                        <div class="w-full md:w-1/3">
                            <div class="text-center">
                                <img src="{{ asset('storage/avatar/' . $user->avatar) }}"
                                    class="w-48 h-48 rounded-full mx-auto">
                            </div>
                            <hr class="my-4">
                            <div class="flex flex-wrap justify-center items-end">
                                <h4 class="text-5xl font-bold">{{ $user->name }}</h4>
                                <p class="text-2xl ml-8">{{ \Carbon\Carbon::parse($user->birth)->age }}歳</p>
                                <p class="text-2xl ml-8">{{ $user->gender }}</p>
                            </div>
                            <div class="max-w-7xl mx-auto">
                                <div class="flex flex-wrap">
                                    <div class="flex-1 p-4">
                                        <div class="bg-gray-100 rounded-lg p-4 max-w-xs h-36">
                                            <a href="{{ route('users.friends', ['user' => $user->id]) }}">
                                                <p class="text-lg font-bold">{{ __('Sfrie') }}</p>
                                                {{-- ここに友達数を入れる --}}
                                                <p class="mt-5">
                                                    <span
                                                        class="text-5xl mt-10 ml-10">{{ $user->friends()->count() }}</span>　人
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex-1 p-4">
                                        <div class="bg-gray-100 rounded-lg p-4 max-w-xs h-36">
                                            <p class="text-lg font-bold">{{ __('コミュニティ投稿数') }}</p>
                                            {{-- ここに投稿数を入れる --}}
                                            <p class="mt-5">
                                                <span class="text-5xl mt-10 ml-10">0
                                                </span>
                                                posts
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full md:w-2/3">
                            <div class="grid grid-cols-2 gap-4">
                                {{-- エリア --}}
                                <div class="p-4">
                                    <div class="bg-gray-100 rounded-lg p-4 h-full">
                                        <p class="text-lg font-bold">{{ __('住んでいるエリア') }}</p>
                                        @if ($user->mArea)
                                            <p>{{ $user->mArea->area }}</p>
                                        @else
                                            <p>エリア未設定</p>
                                        @endif
                                    </div>
                                </div>
                                {{-- カテゴリー --}}
                                <div class="p-4">
                                    <div class="bg-gray-100 rounded-lg p-4 h-full">
                                        <p class="text-lg font-bold">{{ __('興味のある学習カテゴリー') }}</p>
                                        @if ($user->mCategory)
                                            <p>{{ $user->mCategory->category }}</p>
                                        @else
                                            <p>カテゴリー未設定</p>
                                        @endif
                                    </div>
                                </div>
                                {{-- 学習内容 --}}
                                <div class="p-4 col-span-2">
                                    <div class="bg-gray-100 rounded-lg p-4 h-full">
                                        <p class="text-lg font-bold">{{ __('現在の学習内容') }}</p>
                                        <ul class="list-disc-none ml-2">
                                            @foreach ($user->contents as $content)
                                                <li>{{ $content->content }}: @switch($content->level)
                                                        @case(1)
                                                            （学習レベル：★☆☆☆☆）
                                                        @break

                                                        @case(2)
                                                            （学習レベル：★★☆☆☆）
                                                        @break

                                                        @case(3)
                                                            （学習レベル：★★★☆☆）
                                                        @break

                                                        @case(4)
                                                            （学習レベル：★★★★☆）
                                                        @break

                                                        @case(5)
                                                            （学習レベル：★★★★★）
                                                        @break

                                                        @default
                                                            {{ $content->level }}
                                                    @endswitch
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                {{-- 自己紹介 --}}
                                <div class="p-4 col-span-2">
                                    <div class="bg-gray-100 rounded-lg p-4 h-full">
                                        <p class="text-lg font-bold">{{ __('自己紹介') }}</p>
                                        <div class="mt-4">
                                            @if ($user->intro)
                                                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                                    <p class="text-gray-700">{!! nl2br(e($user->intro)) !!}</p>
                                                </div>
                                            @else
                                                <p>自己紹介未設定</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
