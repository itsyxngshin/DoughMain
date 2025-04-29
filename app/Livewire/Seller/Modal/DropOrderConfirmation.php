<?php

namespace App\Livewire\Seller\Modal;

use Livewire\Component;
use App\Models\Order;

class DropOrderConfirmation extends Component
{
    public $orderId;

    public function dropOrder()
    {
        $order = Order::find($this->orderId);

        if ($order) {
            $order->status = 'Cancelled';
            $order->save();

            session()->flash('message', 'Order is cancelled!');
            $this->dispatch('order-dropped');
        }
    }
    public function render()
    {
        return view('livewire.seller.modal.drop-order-confirmation');
    }
}
