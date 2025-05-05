<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Models\Order;
use App\Models\OrderItem;

class Checkout extends Component
{
    public $cartItems = [];
    public $orderTotal = 0;
    public $shippingFee = 0; // You can add shipping calculation later

    public function mount()
    {
        // Retrieve selected item IDs from the session
        $selectedIds = session('selected_cart_items', []);

        // Load cart items (with product info)
        $this->cartItems = CartItem::with('product')
            ->whereIn('id', $selectedIds)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->get()
            ->toArray();

        // Redirect if no items are selected
        if (empty($this->cartItems)) {
            return redirect()->route('user.cart')->with('error', 'No items selected for checkout.');
        }

        // Calculate order total
        $this->calculateOrderTotal();
    }

    protected function calculateOrderTotal()
    {
        $this->orderTotal = collect($this->cartItems)->sum(function($item) {
            return $item['product']['product_price'] * $item['quantity'];
        }) + $this->shippingFee;
    }

    public function placeOrder()
    {
        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $this->orderTotal,
            'status' => 'pending',
            'shipping_address' => Auth::user()->location->address,
            'contact_number' => Auth::user()->phone_number
        ]);

        // Create order items
        foreach ($this->cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']['id'],
                'quantity' => $item['quantity'],
                'price' => $item['product']['product_price'],
                'subtotal' => $item['product']['product_price'] * $item['quantity']
            ]);
        }

        // Clear the cart items
        CartItem::whereIn('id', collect($this->cartItems)->pluck('id'))->delete();

        // Clear session
        session()->forget('selected_cart_items');

        // Redirect to order confirmation
        return redirect()->route('user.orders.show', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    public function render()
    {
        return view('livewire.user.checkout', [
            'cartItems' => $this->cartItems,
            'orderTotal' => $this->orderTotal
        ])->layout('components.layouts.navbar');
        
    }
}
