<?php

namespace App\Livewire\Seller\Modal;

use Livewire\Component;
use App\Models\Order;

class ViewOrder extends Component
{
    public $orderId;
    public $selectedOrder;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $this->selectedOrder = Order::with([
            'shop',
            'orderItems.product.category',
            'payment',
            
        ])->find($orderId);

        // Optional: Handle case when order is not found
        if (!$this->selectedOrder) {
            session()->flash('error', 'Order not found.');
        }
    }

    public function approveOrder()
    {
        dd($this->selectedOrder); 
        if ($this->selectedOrder && $this->selectedOrder->status === 'Pending') {
            $this->selectedOrder->status = 'On Process';
            $this->selectedOrder->save();
            session()->flash('message', 'Order approved.');
        }
    }

    public function dropOrder()
    {
        if ($this->selectedOrder) {
            $this->selectedOrder->status = 'Cancelled';
            $this->selectedOrder->save();
            session()->flash('message', 'Order dropped.');
        }
    }

    public function markOutForDelivery()
    {
        if ($this->selectedOrder) {
            $this->selectedOrder->status = 'Out for Delivery';
            $this->selectedOrder->save();
            session()->flash('message', 'Order marked out for delivery.');
        }
    }

    public function markCompleted()
    {
        if ($this->selectedOrder) {
            $this->selectedOrder->status = 'Completed';
            $this->selectedOrder->save();
            session()->flash('message', 'Order completed.');
        }
    }

    public function render()
    {
        return view('livewire.seller.modal.view-order', [
            'selectedOrder' => $this->selectedOrder
        ]);
    }
}
