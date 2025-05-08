<?php

namespace App\Livewire\Admin\Modal;

use Livewire\Component;
use App\Models\User;

class ViewUser extends Component
{
    public $user;
    public $completedOrdersCount;

    public function mount($userId)
{
    $this->user = User::findOrFail($userId);

    // Count only completed orders via query
    $this->completedOrdersCount = $this->user
        ->orders()
        ->where('status', 'completed')
        ->count();
}


    public function render()
    {
        return view('livewire.admin.modal.view-user');
    }
}
