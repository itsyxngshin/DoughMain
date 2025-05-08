<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use Carbon\Carbon;

class AdminDashboard extends Component
{
    public $totalShops;
    public $totalUsers;
    public $monthlyOrders;
    public $topShops;
    public $topUsers;
    
    public function mount(){

        $this->totalShops = Shop::count();
        $this->totalUsers = User::count();

        $this->monthlyOrders = Order::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->count();

        $this->topShops = Order::select(
            'orders.shop_id',
            DB::raw('COUNT(*) as total_orders'),
            DB::raw('AVG(reviews.rating) as average_rating')
        )
        ->leftJoin('reviews', 'orders.shop_id', '=', 'reviews.shop_id')
        ->where('orders.status', 'completed')
        ->groupBy('orders.shop_id')
        ->orderByDesc('total_orders')
        ->with('shop')
        ->take(5)
        ->get();

        

    $this->topUsers = Order::select(
            'orders.user_id',
            DB::raw('COUNT(*) as total_orders'),
            DB::raw('MAX(orders.created_at) as last_order_date'),
            DB::raw('AVG(reviews.rating) as average_rating') // Add average rating here
        )
        ->leftJoin('reviews', 'orders.user_id', '=', 'reviews.user_id') // Join with reviews table
        ->where('orders.status', 'completed')
        ->groupBy('orders.user_id')
        ->orderByDesc('total_orders')
        ->with('user') // Ensure Order model has a `user()` relationship
        ->take(5)
        ->get();

    }

    public function render()
{
    // Get the current month and the number of months to look back (e.g., past 12 months)
    $months = collect(range(1, 12));  // Get months 1 to 12 (January to December)
    
    // Get monthly order data
    $monthlyOrders = DB::table('orders')
        ->select(
            DB::raw('MONTH(created_at) as month_number'),
            DB::raw('COUNT(*) as total_orders')
        )
        ->where('status', 'completed')
        ->whereBetween('created_at', [now()->subMonths(11)->startOfMonth(), now()->endOfMonth()])
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();

    // Map months to month names and ensure all months are present
    $allMonths = $months->map(function ($month) {
        return \Carbon\Carbon::createFromFormat('m', $month)->format('F');
    });

    // Getting total orders for each month
    $orders = $allMonths->map(function ($month) use ($monthlyOrders) {
        $monthNumber = \Carbon\Carbon::parse($month)->month;
        $order = $monthlyOrders->firstWhere('month_number', $monthNumber);

        return $order ? $order->total_orders : 0;  
    });

    return view('livewire.admin.admin-dashboard', compact('allMonths', 'orders'))->layout('components.layouts.admin');
}



}
