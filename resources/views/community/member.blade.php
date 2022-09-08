<x-app-layout>
  <x-slot name="header">  </x-slot>

  <div class='flex'>

    {{-- サイドバー --}}
    <x-community-sidebar :community="$community" :isJoin="$isJoin"></x-community-sidebar>



    {{-- 学習コミュニティ一覧表示用のコード --}}
    <div class="w-3/4 mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mx-4 sm:p-2">
        <div class="mt-4">
          <div class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
            <div class="mt-4">

              <div class="container px-6 py-10 mx-auto">
                <h1 class="text-3xl font-semibold text-center text-gray-800 capitalize lg:text-4xl dark:text-white">コミュニティメンバー一覧</h1>


                {{-- ユーザー4つならべ --}}
                <div class="grid grid-cols-4 gap-8 mt-8 xl:mt-16 md:grid-cols-2 xl:grid-cols-4">

                  @foreach($communities as $community)
                  @foreach($community->users as $user)
                  <a href="{{route('profile.show',$user)}}" class=" flex flex-col items-center p-8 transition-colors duration-300 transform border cursor-pointer rounded-xl hover:border-transparent group hover:bg-blue-600 dark:border-gray-700 dark:hover:border-transparent">

                    {{-- コミュニティ画像 --}}
                    <img class="object-cover w-32 h-32 rounded-full ring-4 ring-gray-300" src="{{asset('storage/avatar/'.($post->user->avatar??'user_default.jpg'))}}">

                    {{-- ユーザー名 --}}
                    <h1 class="mt-4 text-2xl font-semibold text-gray-700 capitalize dark:text-white group-hover:text-white">{{ $user->name }}</h1>

                    {{-- エリア --}}
                    <p class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-300">エリア：{{ $user->area->area }} </p>

                    {{-- カテゴリー --}}
                    <p class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-300">カテゴリー：{{ $user->category->category }}</p>


                  </a>


                  @endforeach
                  @endforeach

                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>