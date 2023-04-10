<div class="bg-gray-700">
    <div class="flex h-16 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Navigation Links -->
        <x-nav-link :href="route('event.index')" :active="request()->routeIs('event.index')">
            <div class="text-white">
                イベントコミュニティ一覧
            </div>
        </x-nav-link>
        <x-nav-link class="ml-20" :href="route('event.create')" :active="request()->routeIs('event.create')">
            <div class="text-white">
                新規作成
            </div>
        </x-nav-link>
    </div>
</div>
