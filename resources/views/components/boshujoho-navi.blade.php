<div class="bg-gray-800">
  <div class="flex h-16 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Navigation Links -->
    <x-nav-link :href="route('boshujoho.index')" :active="request()->routeIs('boshujoho.index')">
      <div class="text-white">
        投稿一覧
      </div>
    </x-nav-link>
    <x-nav-link class="ml-20" :href="route('boshujoho.create')" :active="request()->routeIs('boshujoho.create')">
      <div class="text-white">
        新規作成
      </div>
    </x-nav-link>
  </div>
</div>