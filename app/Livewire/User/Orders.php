<?php

namespace App\Livewire\User;



use Livewire\Component;
use App\Models\Order;

class Orders extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::with(['orderItems.product', 'shop'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
    }



    public function render()
    {
        return view('livewire.user.orders')->layout('components.layouts.navbar');
    }
}
