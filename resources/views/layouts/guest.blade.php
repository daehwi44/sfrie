<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>

{{-- ここから本体--}}

<body>
    {{-- 全体のdiv--}}
    <div class="h-full font-sans text-gray-900 antialiased">

        {{-- 上のメニュー部分--}}
        <div class="bg-black">
            <div class="w-full container mx-auto p-4">
                <div class="w-full flex items-center justify-between">

                    {{-- ロゴ追加--}}
                    <a href="{{route('top')}}"><img src="{{asset('logo/logo.png')}}" style="max-height:30px;"></a>


                    <div class="flex w-1/2 justify-end content-center">
                        {{-- ログイン・登録部分 --}}
                        @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block text-white">
                            @auth
                            <a href="{{ url('/post') }}" class="text-sm text-white-700 dark:text-white-500 underline">HOME</a>
                            @else
                            <a href="{{ route('login') }}" class="text-sm text-white-700 dark:text-white-500 underline font-bold">login</a>

                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-white-700 dark:text-white-500 underline font-bold">sign up</a>
                            @endif

                            @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ $slot }}

    </div>
</body>

</html>