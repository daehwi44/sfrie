<x-app-layout>
    <x-slot name="header">
        {{-- エラーメッセージ --}}
        <x-auth-validation-errors class="mb-4 ml-10" :errors="$errors" />
        {{-- コメント完了メッセージ --}}
        <x-message :message="session('message')" />
    </x-slot>

    <div class='flex'>

        {{-- サイドバー --}}
        <x-community-sidebar :community="$community" :isJoin="$isJoin"></x-community-sidebar>


        <div class="w-3/4 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mx-4 sm:p-2">
                <div class="px-10 mt-4">

                    <div
                        class="bg-white w-full  rounded px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                        <div class="mt-4">

                            <div class="flex justify-end mt-4">
                                <a href="{{ route('post.edit', $post) }}">
                                    <button type="submit"
                                        class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline">
                                        <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24"
                                            stroke="black">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                </a>
                                <form method="post" action="{{ route('post.destroy', $post) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline"
                                        onClick="return confirm('本当に削除しますか？');">
                                        <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24"
                                            stroke="black">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>


                            <div class="flex pb-1">

                                {{-- アバター --}}
                                <div>
                                    <img class="rounded-full w-12 h-12 object-cover"
                                        src="{{ asset('storage/avatar/' . ($post->user->avatar ?? 'user_default.jpg')) }}">
                                </div>
                                {{-- name --}}
                                <div class="ml-2 ">
                                    <h1 class="text-lg text-gray-700 font-semibold float-left pt-3">
                                        {{ $post->user->name ?? '削除されたユーザ' }}
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
                                <p class="whitespace-pre-wrap mt-4 text-gray-600 py-4">{{ $post->body }}</p>
                                @if ($post->image)
                                    <div>
                                        (添付ファイル)
                                    </div>
                                    <img src="{{ asset('storage/images/' . $post->image) }}" class="mx-auto"
                                        style="height:300px;">
                                @endif
                                <div class="text-sm font-semibold flex flex-row-reverse">
                                    <p> {{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- コメント表示 --}}
                    @foreach ($post->comments as $comment)
                        <div
                            class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500 mt-8">
                            <div class="whitespace-pre-wrap">{{ $comment->body }}</div>
                            <div class="text-sm font-semibold flex flex-row-reverse">
                                {{-- ユーザー名 --}}
                                <p class="float-left pt-4"> {{ $comment->user->name ?? '削除されたユーザ' }} •
                                    {{ $comment->created_at->diffForHumans() }}</p>
                                {{-- アバター --}}
                                <span>
                                    <img class="rounded-full w-12 h-12 object-cover"
                                        src="{{ asset('storage/avatar/' . ($comment->user->avatar ?? 'user_default.jpg')) }}">
                                </span>
                            </div>
                        </div>
                    @endforeach

                    <!--コメント投稿部分-->
                    <div class="mt-4 mb-12">
                        <form method="post" action="{{ route('comment.store') }}">
                            @csrf
                            <input type="hidden" name='post_id' value="{{ $post->id }}">
                            <textarea name="body"
                                class="bg-white w-full  rounded-2xl px-4 mt-4 py-4 shadow-lg hover:shadow-2xl transition duration-500"
                                id="body" cols="30" rows="3" placeholder="コメントを入力してください">{{ old('body') }}</textarea>
                            <x-button class="float-right mr-4 mb-12">コメントする</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
