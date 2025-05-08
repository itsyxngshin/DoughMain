<?php

namespace App\Livewire\User;

use Livewire\Component;

class ChatSystem extends Component
{
    public function render()
    {
        return view('livewire.user.chat-system')->layout(
            'components.layouts.navbar',
            [
                'title' => 'Chat System',
                'description' => 'Chat with other users',
                'keywords' => 'chat, messaging, user chat',
            ]
        );
    }
}
