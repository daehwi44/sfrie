<x-app-layout>
  <x-slot name="header">
    <x-boshujoho-navi></x-boshujoho-navi>
    <div class="bg-white">
      <h2 class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 font-semibold text-xl text-white-800 leading-tight">
        投稿詳細
      </h2>
    </div>
    <x-message :message="session('message')" />
  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mx-4 sm:p-2">
      <div class="px-10 mt-4">

        <div class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">

          <div class="flex justify-end mt-4">
            <a href="{{route('boshujoho.edit', $boshujoho)}}">
              <button type="submit" class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline">
                <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </button>
            </a>
            <form method="post" action="{{route('boshujoho.destroy', $boshujoho)}}">
              @csrf
              @method('delete')
              <button type="submit" class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline" onClick="return confirm('本当に削除しますか？');">
                <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </button>
            </form>
          </div>
          <div>
            {{-- title --}}
            <div class="text-2xl text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-3 pb-3">
              <a href="{{route('boshujoho.show', $boshujoho)}}">{{ $boshujoho->title }}</a>
            </div>
            <hr class="w-full">


            <div class="mt-2">
              <div class="flex">
                <div class="pt-2">
                  投稿者：
                </div>
                <div>
                  {{-- アバター表示 --}}
                  <img class="rounded-full w-10 h-10 object-cover" src="{{asset('storage/avatar/'.($boshujoho->user->avatar??'user_default.jpg'))}}">
                </div>
                {{-- name --}}
                <div class="ml-2">
                  <h1 class="text-lg text-gray-700 font-semibold float-left pt-1.5">
                    {{ $boshujoho->user->name??'削除されたユーザ' }}
                  </h1>
                </div>
              </div>
            </div>

            <hr class="w-full">


            {{-- エリア・カテゴリー・学習内容 --}}
            <div class="text-gray-700 pt-3 pb-3">
              <p>エリア：{{ $boshujoho->area->area }} / カテゴリー：{{ $boshujoho->category->category }} / 学習内容：{{ $boshujoho->content }}</p>
            </div>
            <hr class="w-full">


            {{--本文--}}
            <p class="mt-4 text-gray-600 py-4">{{$boshujoho->body}} </p>
            <div class="text-sm font-semibold flex flex-row-reverse">
              <p>{{$boshujoho->created_at->diffForHumans()}}</p>
            </div>
            <hr class="w-full mb-2">
            @if($boshujoho->image)
            <div>
              (添付ファイル)
            </div>
            <img src="{{ asset('storage/images/'.$boshujoho->image)}}" class="mx-auto" style="height:300px;">
            @endif
          </div>


        </div>

        {{-- コメント表示 --}}
        @foreach ($boshujoho->boshucomments as $boshucomment)
        <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500 mt-8">
          {{$boshucomment->body}}
          <div class="text-sm font-semibold flex flex-row-reverse">
            <p class="float-left pl-2 pt-2 pb-2"> {{$boshucomment->user->name??'削除されたユーザ'}} • {{$boshucomment->created_at->diffForHumans()}}</p>
            {{-- アバター追加 --}}
            <span>
              <img class="rounded-full w-8 h-8 object-cover" src="{{asset('storage/avatar/'.($boshucomment->user->avatar??'user_default.jpg'))}}">
            </span>
          </div>
        </div>
        @endforeach

        <!--コメント投稿部分-->
        <div class="mt-4 mb-12">
          <form method="post" action="{{route('boshucomment.store')}}">
            @csrf
            <input type="hidden" name='boshujoho_id' value="{{$boshujoho->id}}">
            <textarea name="body" class="bg-white w-full  rounded-2xl px-4 mt-4 py-4 shadow-lg hover:shadow-2xl transition duration-500" id="body" cols="30" rows="3" placeholder="コメントを入力してください">{{old('body')}}</textarea>
            <x-button class="float-right mr-4 mb-12">コメントする</x-button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>