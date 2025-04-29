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
    public $shop;

    public function mount()
    {
        $this->shop = Shop::find(2); // hardcoded for shop_id = 2

        $this->orders = Order::with('user', 'orderItems.product', 'shop')
                             ->where('shop_id', $this->shop->id)
                             ->get();
    }


    public function selectOrder($orderId)
    {
        $this->selectedOrder = Order::with('user', 'orderItems.product')->find($orderId);
    }

    public function render()
    {
        return view('livewire.seller.order-management', [
            'shop' => $this->shop
        ])->layout('components\layouts.seller');
    }
}
