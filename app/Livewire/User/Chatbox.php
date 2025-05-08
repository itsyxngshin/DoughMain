<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class Chatbox extends Component
{
    public $selectedChat = null;
    public $messageText = '';
    public $chats = [];
    public $messages = [];

    protected $listeners = ['chatSelected' => 'loadMessages', 'messageReceived' => 'loadMessages'];

    public function mount()
    {
        $this->chats = Chat::where('user_one_id', Auth::id())
                          ->orWhere('user_two_id', Auth::id())
                          ->with(['userOne', 'userTwo', 'latestMessage'])
                          ->get();
    }

    public function loadMessages($chatId)
    {
        $this->selectedChat = Chat::with('messages.sender')->findOrFail($chatId);
        $this->messages = $this->selectedChat->messages;
    }

    public function sendMessage()
    {
        if (!$this->messageText || !$this->selectedChat) return;

        $message = Message::create([
            'chat_id' => $this->selectedChat->id,
            'sender_id' => Auth::id(),
            'message' => $this->messageText,
        ]);

        $this->messageText = '';
        $this->loadMessages($this->selectedChat->id);

        broadcast(new \App\Events\MessageSent($message))->toOthers();
        $this->emitSelf('messageReceived', $this->selectedChat->id);
    }
    public function render()
    {
        return view('livewire.user.chatbox');
    }
}
