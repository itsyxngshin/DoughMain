<?php

namespace App\Livewire\Seller\Modal;

use Livewire\Component;
use App\Models\Payment;
use App\Models\Order;

class ViewDetails extends Component
{
    public $selectedOrder;
    

    // Renamed method to avoid conflict
    public function loadOrder($payment_id)
    {
        $this->selectedOrder = Order::with(['orderItems.product.fees', 'user','payment'])->find($payment_id);
    }

    public function mount($payment_id)
    {
        // Load the order directly during the component mounting
        $this->selectedOrder = Order::with(['orderItems', 'user', 'fees', 'payment'])->findOrFail($payment_id);
    }

    public function render()
    {
        return view('livewire.seller.modal.view-details');
    }
}
