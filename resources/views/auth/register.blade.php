<x-guest-layout>
    <x-auth-card>

        <!-- Logo -->
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            <p class="pt-5 text-center font-semibold">まずはお気軽に登録を！</p>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('ユーザー名')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-label for="gender" :value="__('性別')" />
                <div class="flex items-center mt-2">
                    <input id="gender_male" type="radio"
                        class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="gender"
                        value="男性" {{ old('gender') === '男性' ? 'checked' : '' }}>
                    <label for="gender_male" class="ml-2 block text-sm leading-5 text-gray-700">
                        男性
                    </label>
                </div>
                <div class="flex items-center mt-2">
                    <input id="gender_female" type="radio"
                        class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="gender"
                        value="女性" {{ old('gender') === '女性' ? 'checked' : '' }}>
                    <label for="gender_female" class="ml-2 block text-sm leading-5 text-gray-700">
                        女性
                    </label>
                </div>
            </div>

            <!-- Birth -->
            <div class="mt-4">
                <x-label for="birth" :value="__('生年月日')" />
                <x-input id="birth" class="block mt-1 w-full" type="date" name="birth" :value="old('birth')"
                    required />
            </div>

            <!-- Area -->
            <div class="mt-4">
                <label for="m_area_id" class="block font-medium text-sm text-gray-700">住んでいるエリア（都道府県）</label>
                <select id="m_area_id" name="m_area_id" required
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option disabled style='display:none;' {{ old('m_area_id') === null ? 'selected' : '' }}>選択してください
                    </option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ old('m_area_id') == $area->id ? 'selected' : '' }}>
                            {{ $area->area }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Category -->
            <div class="mt-4">
                <label for="category_id" class="block font-medium text-sm text-gray-700 mt-3">学習カテゴリー</label>
                <select id="category_id" name="m_category_id" required
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option disabled style='display:none;' {{ old('m_category_id') === null ? 'selected' : '' }}>
                        選択してください</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('m_category_id') == $category->id ? 'selected' : '' }}>{{ $category->category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Content -->
            <div class="mt-4">
                <x-label for="content" :value="__('興味のある学習内容')" />
                <x-input id="content" class="block mt-1 w-full" type="text" name="content" :value="old('content')"
                    required />
            </div>

            <!-- Level -->
            <div class="mt-4">
                <x-label for="level" :value="__('学習レベル')" />
                <select id="level" name="level" required
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option disabled style='display:none;' {{ old('level') === null ? 'selected' : '' }}>選択してください
                    </option>
                    <option value="1" {{ old('level') == 1 ? 'selected' : '' }}>★☆☆☆☆</option>
                    <option value="2" {{ old('level') == 2 ? 'selected' : '' }}>★★☆☆☆</option>
                    <option value="3" {{ old('level') == 3 ? 'selected' : '' }}>★★★☆☆</option>
                    <option value="4" {{ old('level') == 4 ? 'selected' : '' }}>★★★★☆</option>
                    <option value="5" {{ old('level') == 5 ? 'selected' : '' }}>★★★★★</option>
                </select>
            </div>

            <!-- Intro -->
            <div class="mt-4">
                <x-label for="intro" :value="__('自己紹介文')" />
                <textarea id="intro" name="intro" class="block mt-1 w-full rounded-none" rows="4">{{ old('intro') }}</textarea>
            </div>

            <!-- Avatar -->
            <div class="mt-4">
                <x-label for="avatar" :value="__('プロフィール画像（任意・1MBまで）')" />
                <x-input id="avatar" class="block mt-1 w-full rounded-none" type="file" name="avatar"
                    :value="old('avatar')" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('メールアドレス')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('パスワード')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('パスワード確認用')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('既に登録済みの方はこちら') }}
                </a>

                <x-button class="ml-4">
                    {{ __('登録する') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
