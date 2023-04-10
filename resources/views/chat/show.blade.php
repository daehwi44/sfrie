<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}{{ __('さんとのメッセージ') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="py-8">
            <div class="overflow-y-auto max-h-96" id="message-list">
                @foreach ($messages as $message)
                    <div class="flex items-start mb-4 {{ $message->from_user_id == Auth::id() ? 'justify-end' : '' }}">
                        <div class="ml-20 mr-8 w-80 bg-blue-200 rounded-lg p-3">
                            <p class="text-sm">{{ $message->message }}</p>
                            <span class="text-xs text-gray-500">{{ $message->created_at->format('Y/m/d H:i') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- 文字の入力部分  --}}
            <div class="py-4">
                <form method="POST" action="{{ route('chat.send', $user->id) }}">
                    @csrf
                    <div class="flex items-center rounded-md">
                        <input class="w-5/6 px-4 py-2 focus:outline-none md:ml-20 md:mr-20 mr-10 rounded-md"
                            name="message" type="text" placeholder="メッセージを入力">
                        <button
                            class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 text-sm border-4 border-teal-500 hover:border-teal-700 text-white py-1 px-2 rounded"
                            type="submit">
                            送信
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // メッセージの一番下に自動で移動させる
        const messageList = document.querySelector('#message-list');
        const lastMessage = messageList.lastElementChild;
        const lastMessageHeight = lastMessage.offsetHeight;
        messageList.scrollTop = messageList.scrollHeight - lastMessageHeight;
    </script>

    {{-- メッセージ受信処理 --}}
    @push('scripts')
        <script>
            // 新しいメッセージをブロードキャストチャンネルから受信する関数
            window.Echo.private(`chat.${{ $user->id }}`)
                .listen('.newMessage', (data) => {
                    // メッセージを画面に表示する関数
                    const showMessage = (message) => {
                        const messageList = document.querySelector('#message-list');
                        const messageItem = document.createElement('div');
                        messageItem.classList.add('flex');
                        messageItem.classList.add('items-start');
                        messageItem.classList.add('mb-4');
                        if (message.from_user_id == {{ Auth::id() }}) {
                            messageItem.classList.add('justify-end');
                        }
                        const messageBox = document.createElement('div');
                        messageBox.classList.add('bg-gray-200');
                        messageBox.classList.add('rounded-lg');
                        messageBox.classList.add('p-3');
                        const messageText = document.createElement('p');
                        messageText.classList.add('text-sm');
                        messageText.innerText = message.message;
                        const messageTime = document.createElement('span');
                        messageTime.classList.add('text-xs');
                        messageTime.classList.add('text-gray-500');
                        messageTime.innerText = (new Date(message.created_at)).toLocaleString();
                        messageBox.appendChild(messageText);
                        messageBox.appendChild(messageTime);
                        messageItem.appendChild(messageBox);
                        messageList.appendChild(messageItem);
                    };

                    showMessage(data);
                });
        </script>
    @endpush
</x-app-layout>
