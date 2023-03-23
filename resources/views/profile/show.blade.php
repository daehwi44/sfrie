<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロフィール') }}
        </h2>
    </x-slot>

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
                            <div class="text-center">
                                <h4 class="text-xl font-bold">{{ $user->name }}</h4>
                                <p class="text-gray-600">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="w-full md:w-2/3">
                            <div class="flex flex-wrap">
                                <div class="w-full md:w-1/2 p-4">
                                    <div class="bg-gray-100 rounded-lg p-4">
                                        <p class="text-lg font-bold">{{ __('エリア') }}</p>
                                        @if ($user->mArea)
                                            <p>{{ $user->mArea->area }}</p>
                                        @else
                                            <p>エリア未設定</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 p-4">
                                    <div class="bg-gray-100 rounded-lg p-4">
                                        <p class="text-lg font-bold">{{ __('カテゴリー') }}</p>
                                        @if ($user->mCategory)
                                            <p>{{ $user->mCategory->category }}</p>
                                        @else
                                            <p>カテゴリー未設定</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-full p-4">
                                    <div class="bg-gray-100 rounded-lg p-4">
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
