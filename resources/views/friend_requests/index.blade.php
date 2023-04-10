<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl bg-gray-800 leading-tight py-6 text-center tracking-wide">
            <span class="text-3xl text-white">
                {{ __('Sfrie承認申請一覧') }}
            </span>
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <div class="mt-6">
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="text-sm font-bold uppercase text-gray-600 border-b-2 border-gray-300">
                            <th class="px-4 py-3 text-left">申請者</th>
                            <th class="px-4 py-3 text-left">ステータス</th>
                            <th class="px-4 py-3 pl-8 text-left">承認しますか？</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($friendRequests as $request)
                            <tr class="text-sm text-gray-700">
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 mr-3">
                                            <img src="{{ asset('storage/avatar/' . $request->user->avatar) }}"
                                                class="w-10 h-10 rounded-full mx-auto">
                                        </div>
                                        <span>{{ $request->user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if ($request->status === 0)
                                        <span class="px-2 py-1">承認待ち</span>
                                    @elseif ($request->status === 1)
                                        <span class="px-2 py-1">承認済み</span>
                                    @else
                                        <span class="px-2 py-1">拒否</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        @if ($request->status === 0)
                                            <form method="POST"
                                                action="{{ route('friend_request.accept', $request->id) }}">
                                                @csrf
                                                <button type="submit"
                                                    class="px-3 py-2 bg-indigo-400 text-white rounded-full hover:bg-indigo-500 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2">承認</button>
                                            </form>
                                            <form method="POST"
                                                action="{{ route('friend_request.reject', $request->id) }}"
                                                class="inline-block ml-2">
                                                @csrf
                                                <button type="submit"
                                                    class="px-3 py-2 bg-red-400 text-white rounded-full hover:bg-red-500 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">拒否</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
