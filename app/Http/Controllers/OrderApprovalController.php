<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderApprovalController extends Controller
{
    // Approve the order
    

    public function approve(Order $order)
    {
        $order->status = 'On Process';
        $order->save();

        return redirect()->back()->with('message', 'Order approved successfully!');
    }

    // Show the order details (e.g. for view-order blade)
    public function show($orderId)
    {
        dd($selectedOrder, $order);
        $selectedOrder = Order::findOrFail($orderId);
        return view('your.blade.view', compact('selectedOrder'));
    }
}
