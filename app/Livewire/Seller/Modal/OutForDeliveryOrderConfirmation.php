<?php

namespace App\Livewire\Seller\Modal;

use Livewire\Component;
use App\Models\Order;

class OutForDeliveryOrderConfirmation extends Component
{
    public $orderId;

    public function deliverOrder()
    {
        $order = Order::find($this->orderId);

        if ($order) {
            $order->status = 'Out For Delivery';
            $order->save();

            session()->flash('message', 'Order updated successfully!');
            $this->dispatch('order-out-for-delivery');
        }
    }

    public function render()
    {
        return view('livewire.seller.modal.out-for-delivery-order-confirmation');
    }
}
