<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\StockMovement;
use App\Models\Stock;
use Livewire\Component;
use App\Models\Shop;


class OrderManagement extends Component
{

    public $orders;
    public $selectedOrder= null; 

    public function mount()
    {
        
        $this->orders = Order::with('user', 'orderItems.product', 'shop')->get(); // eager loading
    }


    public function selectOrder($orderId)
    {
        $this->selectedOrder = Order::with('user', 'orderItems.product')->find($orderId);
    }

    public function render()
    {
        return view('livewire.seller.order-management')->layout('layouts.seller');
    }
}
