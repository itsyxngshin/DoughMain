<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\StockMovement;
use App\Models\Shop;
use App\Models\Review;

class Dashboard extends Component
{
    public $totalOrdersLast30Days;
    public $totalProductsThisWeek;
    public $totalProductsSold;
    public $totalRevenue;
    public $shop;
    public $shop_id;  // Declare shop_id as a class property
    public $recentOrders;
    public $reviews;
    public $monthlySalesLabels = [];
    public $monthlySalesData = [];

    public function mount()
{
    // Get the shop where the current user is the manager
    $this->shop = Shop::where('manage_id', auth()->id())->firstOrFail();
    $this->shop_id = $this->shop->id;

    // Total completed orders in the last 30 days for this shop
    $this->totalOrdersLast30Days = Order::where('status', 'completed')
        ->where('created_at', '>=', Carbon::now()->subDays(30))
        ->where('shop_id', $this->shop_id)
        ->count();

    //Total products added/updated this week by this shop
    $startOfWeek = Carbon::now()->startOfWeek();
    $this->totalProductsThisWeek = Product::where('shop_id', $this->shop_id)
        ->where('updated_at', '>=', $startOfWeek)
        ->count();

    // Total products sold by this shop
    $this->totalProductsSold = StockMovement::where('movement_type', 'out')
        ->whereHas('product', function ($query) {
            $query->where('shop_id', $this->shop_id);
        })
        ->sum('quantity');

    // Total revenue from completed orders for this shop
    $this->totalRevenue = Order::where('status', 'completed')
    ->where('shop_id', $this->shop_id) // Filter by the current shop's ID
    ->sum('total_amount'); // Sum the total_amount for all matching orders

    // Fetch recent orders
    $this->recentOrders = Order::where('shop_id', $this->shop_id)
                                ->orderBy('created_at', 'desc')
                                ->limit(5) 
                                ->get();

    // Get reviews for products sold by this shop (assuming `reviews` is a related model to `Product`)
    $this->reviews = \App\Models\Review::whereHas('product', function($query) {
        $query->where('shop_id', $this->shop_id);
    })
    ->with('user', 'product')  // Assuming you want the user who left the review and the associated product
    ->latest()
    ->limit(5) // You can limit to show recent reviews
    ->get();


    // Prepare chart data for completed orders this year
    $monthlySales = Order::select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('SUM(total_amount) as total')
    )
    ->where('shop_id', $this->shop_id)
    ->where('status', 'completed')
    ->whereYear('created_at', now()->year)
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->orderBy('month')
    ->get();

    // arrays for labels and data (Jan - Dec)
    $months = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'];

    foreach ($months as $num => $name) {
        $this->monthlySalesLabels[] = $name;
        $sale = $monthlySales->firstWhere('month', $num);
        $this->monthlySalesData[] = $sale ? $sale->total : 0;
    }

}


    public function render()
    {
        return view('livewire.seller.dashboard')->layout('components\layouts.seller');
    }
}
