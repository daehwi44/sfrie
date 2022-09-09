<x-app-layout>
  <x-slot name="header">
    <x-message :message="session('message')" />
  </x-slot>

  <div class='flex'>

    {{-- サイドバー --}}
    <x-community-sidebar :community="$community" :isJoin="$isJoin"></x-community-sidebar>




    <div class="w-3/4 mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mx-4 sm:p-2">
        <div class="px-10 mt-4">

          <div class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
            <div class="mt-4">
              {{--コミュニティイメージ写真--}}
              @if($community->image)
              <div>
                <img class="mx-auto m-2 rounded-full object-cover w-48 h-48" src="{{ asset('storage/images/'.$community->image)}}">
              </div>
              @endif
              {{-- コミュニティ名 --}}
              <div class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-3 pb-3">
                <a href="{{route('community.show', $community)}}">コミュニティ名： {{ $community->name }}</a>
              </div>
              {{-- 編集・削除ボタン --}}
              <div class="flex justify-end mt-4">
                <a href="{{route('community.edit', $community)}}">
                  <button type="submit" class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline">
                    <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                  </button>
                </a>
                <form method="post" action="{{route('community.destroy', $community)}}">
                  @csrf
                  @method('delete')
                  <button type="submit" class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline" onClick="return confirm('本当に削除しますか？');">
                    <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </form>
              </div>
              <hr class="w-full">
              <div class="flex">

                {{-- アバター --}}
                <div class="flex">
                  <div class="mt-4">
                    代表者：
                  </div>
                  <div>
                    <img class=" m-2 rounded-full w-10 h-10 object-cover" src="{{asset('storage/avatar/'.($community->user->avatar??'user_default.jpg'))}}">
                  </div>
                </div>
                {{-- name --}}
                <div class="ml-2 ">
                  <h1 class="mt-1.5 text-lg text-gray-700 font-semibold float-left pt-3">
                    {{ $community->user->name??'削除されたユーザ' }}
                  </h1>
                </div>
              </div>
              <hr class="w-full">
            </div>
            <div>
              {{-- エリア・カテゴリー・学習内容 --}}
              <div class="text-gray-700 pt-3 pb-3">
                <p>エリア：{{ $community->area->area }} / カテゴリー：{{ $community->category->category }} / 学習内容：{{ $community->content }}</p>
              </div>
              <hr class="w-full">
              {{--本文(長い場合"..."表示)--}}
              <p class="mt-4 text-gray-600 py-4">{{Str::limit($community->about, 500, '...')}} </p>
              <div class="text-sm font-semibold flex flex-row-reverse">
                <p>{{$community->created_at->diffForHumans()}}</p>
              </div>
              <hr class="w-full mb-2">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>