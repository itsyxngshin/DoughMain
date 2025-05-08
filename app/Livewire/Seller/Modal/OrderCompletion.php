<?php

namespace App\Livewire\Seller\Modal;

use Livewire\Component;
use App\Models\Order;

class OrderCompletion extends Component
{
    public $orderId;

    public function completeOrder()
    {
        $order = Order::find($this->orderId);

        if ($order) {
            $order->status = 'Completed';
            $order->save();

            session()->flash('message', 'Order complete!');
            $this->dispatch('complete-delivery');
        }
    }

    public function render()
    {
        return view('livewire.seller.modal.order-completion');
    }
}
