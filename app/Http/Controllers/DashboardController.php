<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            'totalUsers' => User::count(),
        ]);
    }
}

