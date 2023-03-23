<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            プロフィール変更
        </h2>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <x-message :message="session('message')" />

    </x-slot>

    <div class="flex flex-col items-center">
        <div class="w-full sm:w-2/3 md:w-1/2 lg:w-2/5 xl:w-2/5 bg-white rounded-lg shadow-lg overflow-hidden mt-8">
            <div class="relative bg-gray-600 pt-10 px-10 flex items-center justify-center">
                <div class="absolute top-0 left-0 h-full w-full opacity-75"></div>
                <div class="relative z-10 text-center text-white">
                    <h3 class="text-2xl font-medium pb-4">{{ __('プロフィール変更') }}</h3>
                </div>
            </div>
            <div class="px-10 pb-10">
                <form method="POST" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <!-- Name -->
                    <div class="mt-6">
                        <x-label for="name" :value="__('名前')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', $user->name)" required autofocus />
                    </div>

                    <!-- 都道府県 -->
                    <div class="mt-6">
                        <x-label for="m_area_id" :value="__('都道府県')" />
                        <select name="m_area_id" required class="block mt-1 w-full rounded-md">
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" @if (isset($user->m_area_id) && $user->m_area_id === $area->id) selected @endif>
                                    {{ $area->area }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- カテゴリー -->
                    <div class="mt-6">
                        <x-label for="m_category_id" :value="__('カテゴリー')" />
                        <select name="m_category_id" required class="block mt-1 w-full rounded-md">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (isset($user->m_category_id) && $user->m_category_id === $category->id) selected @endif>
                                    {{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- 自己紹介 -->
                    <div class="mt-6">
                        <x-label for="intro" :value="__('自己紹介')" />
                        <textarea id="intro" class="block mt-1 w-full rounded-md" name="intro" rows="6">{{ old('intro', $user->intro ?? '') }}</textarea>
                    </div>

                    <!-- プロフィール画像 -->
                    <div class="mt-6">
                        <x-label for="avatar" :value="__('プロフィール画像（任意・1MBまで）')" />
                        <div class="flex mt-1">
                            <div class="rounded-full w-28 h-28 overflow-hidden">
                                <img class="w-full h-full object-cover"
                                    src="{{ asset('storage/avatar/' . ($user->avatar ?? 'user_default.jpg')) }}">
                            </div>
                            <input id="avatar" type="file" name="avatar"
                                class="block mt-1 w-full rounded-md ml-4">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <x-label for="email" :value="__('メールアドレス')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email', $user->email)" required />
                    </div>

                    {{-- <!-- パスワード -->
                    <div class="mt-6">
                        <x-label for="password" :value="__('パスワード')" />
                        <input id="password" class="block mt-1 w-full rounded-md" type="password" name="password"
                            required>
                    </div>

                    <!-- パスワード確認 -->
                    <div class="mt-6">
                        <x-label for="password_confirmation" :value="__('パスワード（確認）')" />
                        <input id="password_confirmation" class="block mt-1 w-full rounded-md" type="password"
                            name="password_confirmation" required>
                    </div> --}}

                    <div class="flex items-center justify-end mt-6">
                        <x-button>
                            {{ __('更新する') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
