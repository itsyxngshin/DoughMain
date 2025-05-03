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
    // Get the shop where the current user is the manager
    $this->shop = Shop::where('manage_id', auth()->id())->firstOrFail();
    $this->shop_id = $this->shop->id;

    // ✅ Total completed orders in the last 30 days for this shop
    $this->totalOrdersLast30Days = Order::where('status', 'completed')
        ->where('created_at', '>=', Carbon::now()->subDays(30))
        ->where('shop_id', $this->shop_id)
        ->count();

    // ✅ Total products added/updated this week by this shop
    $startOfWeek = Carbon::now()->startOfWeek();
    $this->totalProductsThisWeek = Product::where('shop_id', $this->shop_id)
        ->where('updated_at', '>=', $startOfWeek)
        ->count();

    // ✅ Total products sold (movement_type = 'out') by this shop
    $this->totalProductsSold = StockMovement::where('movement_type', 'out')
        ->whereHas('product', function ($query) {
            $query->where('shop_id', $this->shop_id);
        })
        ->sum('quantity');

    // ✅ Total revenue from completed orders for this shop
    $this->totalRevenue = Order::where('status', 'completed')
        ->where('shop_id', $this->shop_id)
        ->sum('total_amount');
}


    public function render()
    {
        return view('livewire.seller.dashboard')->layout('components\layouts.seller');
    }
}
