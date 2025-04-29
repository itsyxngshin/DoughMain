<?php

namespace App\Livewire\Seller\Modal;

use Livewire\Component;
use App\Models\Order;

class ApprovePendingOrderConfirmation extends Component
{
    public $orderId;

    public function approveOrder()
    {
        $order = Order::find($this->orderId);

        if ($order) {
            $order->status = 'On Process';
            $order->save();

            session()->flash('message', 'Order approved successfully!');
            $this->dispatch('order-approved');
        }
    }

    public function render()
    {
        return view('livewire.seller.modal.approve-pending-order-confirmation')->layout('components\layouts.seller');
    }
}

