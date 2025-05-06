<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;


class UsersManagement extends Component
{
    public $users;

    public function mount(User $user) 
    {
        $this->users = User::with(['role'])->get();
    }

    public function render()
    {
        return view('livewire.admin.users-management')->layout('components.layouts.admin');
    }
}
