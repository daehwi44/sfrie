<div class="bg-gray-800">
  <div class="flex justify-between h-16 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Navigation Links -->
    <x-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')">
      <div class="text-white">
        みんなの投稿一覧
      </div>
    </x-nav-link>
    <x-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')">
      <div class="text-white">
        新規作成
      </div>
    </x-nav-link>
    <x-nav-link :href="route('post.mypost')" :active="request()->routeIs('post.mypost')">
      <div class="text-white">
        自分の投稿一覧
      </div>
    </x-nav-link>
    <x-nav-link :href="route('post.mycomment')" :active="request()->routeIs('post.mycomment')">
      <div class="text-white">
        コメントした投稿一覧
      </div>
      <x-nav-link :href="route('profile.index')" :active="request()->routeIs('profile.index')">
        <div class="text-white">
          ユーザー一覧
        </div>
      </x-nav-link>
    </x-nav-link>
  </div>
</div>