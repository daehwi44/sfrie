<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ユーザー一覧') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($users as $user)
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:border-transparent group hover:bg-blue-600">
                        <a href="{{ route('profile.show', ['user' => $user->id]) }}">
                            <div class="p-6 border-b border-gray-200">
                                <div class="flex justify-center items-center mb-4 ">
                                    <img src="{{ asset('storage/avatar/' . $user->avatar) }}"
                                        class="w-48 h-48 rounded-full mx-auto ring-4 ring-gray-300">
                                </div>
                                <h3 class="font-semibold text-lg group-hover:text-white">{{ $user->name }}</h3>
                                <p class="mt-2 group-hover:text-white">{{ $user->email }}</p>
                                <p class="mt-2 group-hover:text-white">{{ optional($user->MArea)->area }}</p>
                                <p class="mt-2 group-hover:text-white">{{ optional($user->MCategory)->category }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
