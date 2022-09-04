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
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- area -->
            <div class="mt-4">
                <x-label for="m_area_id" :value="__('都道府県')" />
                <select name="m_area_id" required>
                    <option disabled style='display:none;' @if (empty($user->m_area_id)) selected @endif>選択してください</option>
                    @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                    @endforeach
                </select>
            </div>

            <!-- category -->
            <div class="mt-4">
                <x-label for="m_category_id" :value="__('カテゴリー')" />
                <select name="m_category_id" required>
                    <option disabled style='display:none;' @if (empty($user->m_category_id)) selected @endif>選択してください</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Avatar -->
            <div class="mt-4">
                <x-label for="avatar" :value="__('プロフィール画像（任意・1MBまで）')" />

                <x-input id="avatar" class="block mt-1 w-full rounded-none" type="file" name="avatar" :value="old('avatar')" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>