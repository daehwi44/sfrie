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
                  <x-button class="bg-teal-700 float-right">編集</x-button>
                </a>
                <form method="post" action="{{route('community.destroy', $community)}}">
                  @csrf
                  @method('delete')
                  <x-button class="bg-red-700 float-right ml-4" onClick="return confirm('本当に削除しますか？');">削除</x-button>
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