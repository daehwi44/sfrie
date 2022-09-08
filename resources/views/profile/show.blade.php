<x-app-layout>
  <x-slot name="header"></x-slot>

  <div class="font-sans text-gray-900 antialiased">

    <div class="w-full md:w-1/2 mx-auto p-6">

      <div class="w-3/4 mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-2">
          <div class="px-10 mt-4">

            <div class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
              <div class="mt-4 ">
                {{--ユーザーイメージ写真--}}
                <div>
                  <img class="mx-auto m-2 rounded-full w-50 h-50" src="{{asset('storage/avatar/'.($user->avatar??'user_default.jpg'))}}">
                </div>
                {{-- ユーザー名 --}}
                <div class="text-2xl text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-3 pb-3">
                  {{ $user->name }}
                </div>


                <hr class="w-full">
              </div>
              <div>
                {{-- エリア・カテゴリー・学習内容 --}}
                <div class="text-gray-700 pt-3 pb-3">
                  <p><br>エリア：{{ $user->area->area }} <br><br>興味のあるカテゴリー：{{ $user->category->category }}<br><br></p>
                </div>
                <hr class="w-full">
                {{--本文--}}
                <p class="mt-4 text-gray-600 py-4">山口県在住です。大学では英米文学を学んでおり、英語が得意です。最近は、TOEICの受験に向けて日々勉強しております。大学3年生のときには、英語技能検定で準1級を取得することができました。この経験を活かし皆様に英語を教えてあげたりできたらと思っています。</p>

                <hr class="w-full mb-2">

              </div>
            </div>
          </div>
        </div>
      </div>










    </div>
  </div>
</x-app-layout>