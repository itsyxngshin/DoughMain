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
        $this->cartItems = CartItem::with('product.shop')
            ->whereIn('id', $selectedIds)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->get()
            ->groupBy(fn($item) => optional($item->product->shop)->shop_name ?? 'Unknown Shop')
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
        $this->orderTotal = collect($this->cartItems)->flatten(1)->sum(function($item) {
            return $item['product']['product_price'] * $item['quantity'];
        }) + $this->shippingFee;
    }

    public function placeOrderHere($selectedIds) 
    {
        // Add debug output
        
        // Get the IDs of selected items (assuming $this->selectedItems is already validated)
        $selectedIds = collect($this->cartItems)->pluck('id')->toArray();
        logger()->debug('Selected items before processing:', ['selected_cart_items' => $selectedIds]);
        // Store in session (to be retrieved in the Checkout component)
        session(['selected_cart_items' => $selectedIds]);

        // Redirect to checkout
        return redirect()->route('user.payments'); 
    }

    public function placeOrder()
    {
        // Create the order
        // Group items by shop_id
        $itemsByShop = collect($this->cartItems)->groupBy('product.shop_id');

        // Create an order for each shop
        foreach ($itemsByShop as $shopId => $items) {
            // Calculate the total amount for this shop's items
            $shopTotal = collect($items)->sum(function ($item) {
            return $item['product']['product_price'] * $item['quantity'];
            });

            // Create the order
            $order = Order::create([
            'user_id' => Auth::id(),
            'shop_id' => $shopId,
            'total_amount' => $shopTotal + $this->shippingFee,
            'status' => 'Pending',
            'shipping_address' => Auth::user()->location->address,
            'contact_number' => Auth::user()->phone_number
            ]);

            // Create order items for this shop
            foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']['id'],
                'quantity' => $item['quantity'],
                'price' => $item['product']['product_price'],
                'subtotal' => $item['product']['product_price'] * $item['quantity']
            ]);
            }
        }

        // Clear the cart items
        CartItem::whereIn('id', collect($this->cartItems)->pluck('id'))->delete();

        // Clear session
        session()->forget('selected_cart_items');

        // Redirect to orders page
        return redirect()->route('homepage')
            ->with('success', 'Orders placed successfully!');

    }

    public function render()
    {
        return view('livewire.user.checkout', [
            'cartItems' => $this->cartItems,
            'orderTotal' => $this->orderTotal
        ])->layout('components.layouts.navbar');
        
    }
}
