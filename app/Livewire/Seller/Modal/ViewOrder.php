<?php
namespace App\Livewire\Seller\Modal;

use Livewire\Component;
use App\Models\Order;
use App\Models\Fees;
use App\Models\Shop;
use App\Models\Payment;
use App\Models\Product;

class ViewOrder extends Component
{
    public $selectedOrder;
    
    // Renamed method to avoid conflict
    public function loadOrder($orderId)
    {
        $this->selectedOrder = Order::with(['orderItems.product.fees', 'user','shop','payment'])->find($orderId);
    }

    public function mount($orderId)
    {
        // Load the order directly during the component mounting
        $this->selectedOrder = Order::with(['orderItems', 'user', 'fees','shop','payment'])->findOrFail($orderId);
    }

    public function render()
    {
        return view('livewire.seller.modal.view-order');
    }
    
}
