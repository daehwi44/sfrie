<div class="flex flex-col h-screen w-1/4 py-8 bg-white border-r">

    <!-- コミュニティ名 -->
    <h2 class="text-3xl font-semibold text-center text-gray-800 dark:text-white">{{ $community->name }}</h2>

    <div class="flex flex-col items-center mt-6 -mx-2">
        <!-- ユーザーの情報 -->
        <div class="flex flex-col items-center mt-6 -mx-2">
            <img class="object-cover w-24 h-24 mx-2 rounded-full"
                src="{{ asset('storage/images/' . ($community->image ?? 'user_default.jpg')) }}">

            <h4 class="mx-2 mt-2 font-medium text-gray-800 dark:text-gray-200 hover:underline">
                代表者:{{ $community->user->name }}</h4>
            <p class="mx-2 mt-1 text-sm font-medium text-gray-600 dark:text-gray-400 hover:underline">
                エリア：{{ $community->area->area }} / 学習内容：{{ $community->content }}</p>
        </div>

        <!-- コミュニティの参加ボタン -->
        <div class="my-10">
            @if ($isJoin)
                <p class="text-blue-600/100 text-xl font-bold pt-10">このコミュニティに参加中！</p>
            @else
                <a href="{{ route('community.add', ['community_id' => $community->id]) }}"
                    class="mt-10 px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-gray-600 rounded-md hover:bg-gray-500 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-80">このコミュニティに参加する</a>
            @endif
        </div>
    </div>

    <div class="flex flex-col justify-between flex-1 mt-6">
        <nav>

            <a href="{{ route('post.index', ['community_id' => $community->id]) }}"
                class="flex items-center px-4 py-2 text-gray-600 transition-colors duration-300 transform dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <span class="mx-4 font-medium">フォーラム</span>
            </a>

            <a href="{{ route('post.create', ['community_id' => $community->id]) }}"
                class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                    <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                </svg>
                <span class="mx-4 font-medium">投稿新規作成</span>
            </a>

            <a href="{{ route('community.members', ['community_id' => $community->id]) }}"
                class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span class="mx-4 font-medium">コミュニティメンバー一覧</span>
            </a>

            <a href="{{ route('community.show', ['community_id' => $community->id]) }}"
                class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path
                        d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                    </path>
                </svg>
                <span class="mx-4 font-medium">コミュニティ詳細</span>
            </a>

        </nav>
    </div>
</div>
