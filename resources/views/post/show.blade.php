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

              <div class="flex justify-end mt-4">
                <a href="{{route('post.edit', $post)}}">
                  <x-button class="bg-teal-700 float-right">編集</x-button>
                </a>
                <form method="post" action="{{route('post.destroy', $post)}}">
                  @csrf
                  @method('delete')
                  <x-button class="bg-red-700 float-right ml-4" onClick="return confirm('本当に削除しますか？');">削除</x-button>
                </form>
              </div>


              <div class="flex pb-1">


                {{-- アバター --}}
                <div>
                  <img class="rounded-full w-12 h-12 object-cover" src="{{asset('storage/avatar/'.($post->user->avatar??'user_default.jpg'))}}">
                </div>
                {{-- name --}}
                <div class="ml-2 ">
                  <h1 class="text-lg text-gray-700 font-semibold float-left pt-3">
                    {{ $post->user->name??'削除されたユーザ' }}
                  </h1>
                </div>
              </div>


              <hr class="w-full">
              {{-- title --}}
              <div class="text-lg text-gray-700 font-semibold pt-3 pb-3">
                {{ $post->title }}
              </div>
              <hr class="w-full">

              <div>
                <p class="mt-4 text-gray-600 py-4">{{$post->body}}</p>
                @if($post->image)
                <div>
                  (添付ファイル)
                </div>
                <img src="{{ asset('storage/images/'.$post->image)}}" class="mx-auto" style="height:300px;">
                @endif
                <div class="text-sm font-semibold flex flex-row-reverse">
                  <p> {{$post->created_at->diffForHumans()}}</p>
                </div>
              </div>
            </div>
          </div>
          {{-- コメント表示 --}}
          @foreach ($post->comments as $comment)
          <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500 mt-8">
            {{$comment->body}}
            <div class="text-sm font-semibold flex flex-row-reverse">
              <p class="float-left pt-4"> {{$comment->user->name??'削除されたユーザ'}} • {{$comment->created_at->diffForHumans()}}</p>
              {{-- アバター --}}
              <span>
                <img class="rounded-full w-12 h-12 object-cover" src="{{asset('storage/avatar/'.($comment->user->avatar??'user_default.jpg'))}}">
              </span>
            </div>
          </div>
          @endforeach

          <!--コメント投稿部分-->
          <div class="mt-4 mb-12">
            <form method="post" action="{{route('comment.store')}}">
              @csrf
              <input type="hidden" name='post_id' value="{{$post->id}}">
              <textarea name="body" class="bg-white w-full  rounded-2xl px-4 mt-4 py-4 shadow-lg hover:shadow-2xl transition duration-500" id="body" cols="30" rows="3" placeholder="コメントを入力してください">{{old('body')}}</textarea>
              <x-button class="float-right mr-4 mb-12">コメントする</x-button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>