<x-guest-layout>
    <x-slot name="header"></x-slot>


    <div class="bg-gray-100 my-10 lg:mx-auto lg:flex lg:max-w-5xl lg:shadow-lg lg:rounded-lg">
        <div class="lg:w-1/2">
            <img class="h-64 bg-cover lg:h-full" src="{{ asset('images/friends.jpg') }}" alt="friends studying together">
        </div>

        <div class="max-w-xl px-6 py-12 lg:max-w-5xl lg:w-1/2">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white md:text-3xl">Sfrie（スフレ）で学びを共有しよう！</h2>
            <p class="mt-4 text-gray-600 dark:text-gray-400">
                Sfrie（スフレ）は、一人で勉強しているとモチベーションが続かない、わからないところがあると誰かに聞きたい、一緒に勉強する仲間が欲しいなどの悩みを解決するためのサイトです。登録は<span
                    class="text-blue-600 dark:text-blue-400 font-bold">無料</span>ですので、ぜひご利用ください！
            </p>

            <div class="mx-auto mt-8">
                <a href="{{ route('register') }}"
                    class="px-5 py-2 font-semibold text-gray-100 transition-colors duration-300 transform bg-gray-900 rounded-md hover:bg-gray-700">今すぐ登録する</a>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl mt-12">
        <h2 class="text-center text-2xl font-bold text-gray-800 dark:text-white md:text-3xl">Sfrieの特徴</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
            <div class="bg-gray-700 rounded-lg shadow-lg p-6">
                <i class="fas fa-chalkboard-teacher text-4xl text-white"></i>
                <h3 class="text-xl font-semibold text-white mt-4">学習コミュニティが豊富</h3>
                <p class="text-gray-300 mt-2">さまざまな分野の学習コミュニティがあります。自分の興味・関心に合ったコミュニティを見つけて、気軽に参加しましょう。</p>
            </div>

            <div class="bg-gray-700 rounded-lg shadow-lg p-6">
                <i class="fas fa-users text-4xl text-white"></i>
                <h3 class="text-xl font-semibold text-white mt-4">仲間と学びを共有</h3>
                <p class="text-gray-300 mt-2">学習コミュニティに参加することで、同じ目標を持った仲間と学びを共有することができます。</p>
            </div>

            <div class="bg-gray-700 rounded-lg shadow-lg p-6">
                <i class="fas fa-comments text-4xl text-white"></i>
                <h3 class="text-xl font-semibold text-white mt-4">コミュニケーションが活発</h3>
                <p class="text-gray-300 mt-2">参加ユーザーとのコミュニケーションを通じて新しい出会いや気づきが得られます。</p>
            </div>
        </div>
    </div>

</x-guest-layout>
