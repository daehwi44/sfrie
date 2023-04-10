<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sfrie') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>


<body>
    {{-- 全体のdiv --}}
    <div class="h-full font-sans antialiased">
        {{-- 上のメニュー部分 --}}
        <div class="bg-black">
            <div class="w-full container mx-auto">
                <div class="w-full flex items-center justify-between ml-2">
                    {{-- ロゴ追加 --}}
                    <a href="{{ route('welcome') }}"><img src="{{ asset('logo/logo.png') }}"
                            style="max-height:30px;"></a>

                    {{-- ログイン・登録部分 --}}
                    <div class="flex w-1/2 justify-end content-center">

                        @if (Route::has('login'))
                            <div class="hidden top-0 right-0 px-6 py-4 sm:block text-white">
                                @auth
                                    <a href="{{ url('/dashboard') }}"
                                        class="text-sm text-white-700 dark:text-white-500">HOME</a>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="text-sm text-white-700 dark:text-white-500 font-bold">login</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="ml-4 text-sm text-white-700 dark:text-white-500 font-bold">sign up</a>
                                    @endif

                                @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ $slot }}


</body>

</html>
