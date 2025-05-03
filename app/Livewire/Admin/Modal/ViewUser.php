<?php

namespace App\Livewire\Admin\Modal;

use Livewire\Component;
use App\Models\User;
use App\Models\Order;


class ViewUser extends Component
{
    public $user;

    public function mount($userId)
    {
        $this->user = User::with(['orders'])->findOrFail($userId);
    }
    public function render()
    {
        return view('livewire.admin.modal.view-user');
    }
}
