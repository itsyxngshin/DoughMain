<div class="px-12 pt-6 pb-8">
    <div class="grid grid-cols-[30%_auto] gap-5">
        <!-- Chat List Column -->
        <div>
            <h1 class="font-bold text-[#51331b] text-3xl">Chats</h1>
            <div class="flex gap-3 pt-6 hidden md:flex">
                <input type="text" wire:model.debounce.300ms="search" placeholder="Search" class="pl-3 w-[50%] pr-3 py-1 text-sm border border-[#51331b] rounded-md">
                <div>
                    <select class="border border-[#51331b] w-[50%] px-2 py-1 rounded-md">
                        <option value="0">All</option>
                        <option value="1">Today</option>
                        <option value="2">Tomorrow</option>
                        <option value="3">Next Week</option>
                    </select>
                </div>
            </div>
            <div class="pt-3 space-y-2 max-h-[500px] overflow-y-auto">
                @foreach($chats as $chat)
                    @php
                        $otherUser = $chat->user_one_id === auth()->id() ? $chat->userTwo : $chat->userOne;
                        $latest = $chat->latestMessage?->message ?? 'Start the conversation';
                    @endphp
                    <div wire:click="$emit('chatSelected', {{ $chat->id }})" class="cursor-pointer rounded-md flex hover:bg-gray-300 w-full h-[80px] bg-white">
                        <img src="{{ asset('storage/logo2.png') }}" alt="" class="w-[25%]">
                        <div class="p-4 pl-0">
                            <span class="font-semibold">{{ $otherUser->name }}</span>
                            <p class="font-light text-[15px] text-gray-300 pl-3 truncate">{{ $latest }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Chat Messages Column -->
        <div>
            <div class="rounded-xl w-full h-[500px] bg-white border border-gray-200 flex flex-col">
                @if($selectedChat)
                    <div class="w-full h-[10%] border-b border-gray-300 flex pl-3 items-center">
                        @php $chatUser = $selectedChat->user_one_id === auth()->id() ? $selectedChat->userTwo : $selectedChat->userOne; @endphp
                        <img src="{{ asset('storage/logo2.png') }}" alt="" class="w-[6%]">
                        <span class="font-semibold text-md pl-3">{{ $chatUser->name }}</span>
                    </div>

                    <div class="bg-gray-200 w-full h-[80%] overflow-y-auto px-4 py-2 space-y-2">
                        @foreach($messages as $message)
                            <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <div class="p-2 bg-white rounded-md max-w-xs shadow">
                                    {{ $message->message }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="w-full h-[10%] flex gap-4 pl-3 py-2 pr-3 items-center border-t border-gray-300">
                        <input wire:model.defer="messageText" type="text" class="w-[80%] p-1 border border-gray-300 bg-gray-200 rounded-2xl pl-3 placeholder:italic focus:bg-white" placeholder="Type message...">
                        <button wire:click="sendMessage">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14L21 3m0 0l-6.5 18a.55.55 0 0 1-1 0L10 14l-7-3.5a.55.55 0 0 1 0-1z"/></svg>
                        </button>
                    </div>
                @else
                    <div class="flex items-center justify-center h-full">
                        <p class="text-gray-500">Select a chat to start messaging</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
