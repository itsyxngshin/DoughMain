<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Import the Order model
use App\Models\OrderItem; // Import the OrderItem model

class OrderController extends Controller
{
    // Show the orders page for the logged-in user
    public function showOrders()
    {
        // Fetch the orders for the authenticated user, along with the items and associated products
        $orders = auth()->user()->orders()->with('items.product')->get();

        // Return the view with the orders data
        return view('orders.index', compact('orders'));
    }

    // Show details of a specific order
    public function showOrder($id)
    {
        // Fetch the specific order by ID along with the items and product details
        $order = auth()->user()->orders()->with('items.product')->findOrFail($id);

        // Return the view with the order details
        return view('orders.show', compact('order'));
    }
}
