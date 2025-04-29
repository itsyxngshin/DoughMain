<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\StockMovement;
use App\Models\Shop;

class Dashboard extends Component
{
    public $totalOrdersLast30Days;
    public $totalProductsThisWeek;
    public $totalProductsSold;
    public $totalRevenue;
    public $shop;
    public $shop_id;  // Declare shop_id as a class property

    public function mount()
    {
        $this->shop_id = 2; // Replace with Auth::user()->shop->id in production
        $this->shop = Shop::find($this->shop_id);  // Use $this->shop_id here
        
        // ✅ Total completed orders in the last 30 days for this shop
        $this->totalOrdersLast30Days = \App\Models\Order::where('status', 'completed')
        ->where('created_at', '>=', Carbon::now()->subDays(30))
        ->where('shop_id', $this->shop_id)
        ->count();

    
    
        // ✅ Total products added/updated this week by this shop
        $startOfWeek = Carbon::now()->startOfWeek();
        $this->totalProductsThisWeek = \App\Models\Product::where('shop_id', $this->shop_id)
            ->where('updated_at', '>=', $startOfWeek)
            ->count();
    
        // ✅ Total products sold (movement_type = 'out') by this shop
        $this->totalProductsSold = \App\Models\StockMovement::where('movement_type', 'out')
            ->whereHas('product', function ($query) {
                $query->where('shop_id', $this->shop_id);  // Use $this->shop_id here
            })
            ->sum('quantity');
    
        // ✅ Total revenue from completed orders for this shop
        $this->totalRevenue = \App\Models\Order::where('status', 'completed') // Only completed orders
            ->where('shop_id', $this->shop_id) // Filter orders by the shop's ID
            ->sum('total_amount'); // Sum the total_amount column
    }

    public function render()
    {
        return view('livewire.seller.dashboard')->layout('components\layouts.seller');
    }
}
