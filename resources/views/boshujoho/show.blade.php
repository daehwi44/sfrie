<x-app-layout>
  <x-slot name="header">
    <x-community-navi></x-community-navi>
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
          <div class="mt-4">
            <div class="flex">
              <div class="rounded-full w-12 h-12">
                {{-- アバター表示 --}}
                <img src="{{asset('storage/avatar/'.($comment->user->avatar??'user_default.jpg'))}}">
              </div>
              {{-- name --}}
              <div class="ml-2 ">
                <h1 class="text-lg text-gray-700 font-semibold float-left pt-3">
                  {{ $boshujoho->user->name??'削除されたユーザ' }}
                </h1>
              </div>
            </div>
            <hr class="w-full">
          </div>
          <div class="flex justify-end mt-4">
            <a href="{{route('boshujoho.edit', $boshujoho)}}">
              <x-button class="bg-teal-700 float-right">編集</x-button>
            </a>
            <form method="post" action="{{route('boshujoho.destroy', $boshujoho)}}">
              @csrf
              @method('delete')
              <x-button class="bg-red-700 float-right ml-4" onClick="return confirm('本当に削除しますか？');">削除</x-button>
            </form>
          </div>
          <div>
            {{-- title --}}
            <div class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-3 pb-3">
              <a href="{{route('boshujoho.show', $boshujoho)}}">{{ $boshujoho->title }}</a>
            </div>
            <hr class="w-full">
            {{-- エリア・カテゴリー・学習内容 --}}
            <div class="text-gray-700 pt-3 pb-3">
              <p>エリア：{{ $boshujoho->area->area }} / カテゴリー：{{ $boshujoho->category->category }} / 学習内容：{{ $boshujoho->content }}</p>
            </div>
            <hr class="w-full">
            {{--本文(長い場合"..."表示)--}}
            <p class="mt-4 text-gray-600 py-4">{{Str::limit($boshujoho->body, 500, '...')}} </p>
            <div class="text-sm font-semibold flex flex-row-reverse">
              <p>{{$boshujoho->created_at->diffForHumans()}}</p>
            </div>
            <hr class="w-full mb-2">
            @if($boshujoho->image)
            <div>
              (画像ファイル：{{$boshujoho->image}})
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
            <p class="float-left pt-4"> {{$boshucomment->user->name??'削除されたユーザ'}} • {{$boshucomment->created_at->diffForHumans()}}</p>
            {{-- アバター追加 --}}
            <span class="rounded-full w-12 h-12">
              <img src="{{asset('storage/avatar/'.($boshucomment->user->avatar??'user_default.jpg'))}}">
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