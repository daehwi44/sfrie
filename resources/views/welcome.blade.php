<x-guest-layout>
    <div class="h-screen pb-14 bg-right bg-cover">
        <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center bg-white">
            <!--左側-->
            <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden ">
                <h1 class="my-4 text-3xl md:text-5xl text-gray font-bold leading-tight text-center md:text-left slide-in-bottom-h1">Sufie</h1>
                <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">
                    学習仲間を見つける掲示板
                </p>

                <p class="pb-8 lg:pb-6 text-center md:text-left fade-in">
                    fish or chiken?fish or chiken?fish or chiken?fish or chiken?fish or chiken?fish or chiken?fish or chiken?fish or chiken?fish or chiken?fish or chiken?fish or chiken?fish or chiken?fish or chiken?
                    fish or chiken?fish or chiken?fish or chiken?fish or chiken?fish or chiken?
                </p>
                <div class="flex w-full justify-center md:justify-start pb-24 lg:pb-0 fade-in ">
                    {{-- ボタン--}}
                    <a href="{{route('register')}}">
                        <x-button class="btnsetg">ご登録はこちら</x-button>
                    </a>
                </div>
            </div>
            {{-- 右側 --}}
            <div class="w-full xl:w-3/5 py-6 overflow-y-hidden">
                <img class="w-5/6 mx-auto lg:mr-0 slide-in-bottom rounded-lg shadow-xl" src="{{asset('logo/logo.png')}}">
            </div>
        </div>

    </div>
</x-guest-layout>