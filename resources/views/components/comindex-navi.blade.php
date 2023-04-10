<div class="bg-gray-700">
    <div class="flex h-16 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Navigation Links -->
        <x-nav-link :href="route('community.index')" :active="request()->routeIs('community.index')">
            <div class="text-white">
                学習コミュニティ一覧
            </div>
        </x-nav-link>
        <x-nav-link class="ml-20" :href="route('community.create')" :active="request()->routeIs('community.create')">
            <div class="text-white">
                新規作成
            </div>
        </x-nav-link>
    </div>
</div>
