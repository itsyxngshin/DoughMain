<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class Checkout extends Component
{
    public $cartItems = [];
    public $orderTotal = 0;

    public function mount()
{
    $selectedIds = session('selected_cart_items', []);
    
    // Ensure we have a flat array
    $selectedIds = Arr::flatten($selectedIds);
    
    $this->cartItems = CartItem::with('product')
        ->whereIn('id', $selectedIds)
        ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
        ->get()
        ->toArray();
    if (empty($this->cartItems)) {
        if (empty($this->cartItems)) {
            session()->forget(['selected_cart_items', 'checkout_items']);
            return redirect()->route('user.cart')->with('error', 'Your checkout session expired');
        }

    $this->calculateOrderTotal();
    }
}

    public function loadCartItems()
    {
        // Get selected item IDs from session
        $selectedIds = session('selected_cart_items', []);
        
        if (empty($selectedIds)) {
            session()->flash('error', 'No items selected for checkout');
            return redirect()->route('user.cart');
        }

        // Load items with product relationship
        $items = CartItem::with('product')
            ->whereIn('id', $selectedIds)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->get();

        if ($items->isEmpty()) {
            session()->flash('error', 'Invalid items selected');
            return redirect()->route('user.cart');
        }

        $this->cartItems = $items;
        $this->calculateOrderTotal();
    }

    protected function calculateOrderTotal()
    {
        $this->orderTotal = collect($this->cartItems)->sum(function($item) {
            return $item['product']['product_price'] * $item['quantity'];
        });
    }

    public function render()
    {
        return view('livewire.user.checkout', [
            'cartItems' => $this->cartItems,
            'orderTotal' => $this->orderTotal
        ]);
    }
}
