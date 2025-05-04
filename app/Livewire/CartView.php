<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 

class CartView extends Component
{
    public $cartItems = [];
    public function render()
    {

        $user = Auth::user();

        $cartItems = $user->cart
        ? $user->cart->cart_items()->with('product.shop')->get()
        : collect();

        // Group by shop ID
        $grouped = $cartItems->groupBy(fn($cart_item) => $cart_item->product->shop->id);

        // Restructure for blade ease
        $groupedItems = $grouped->map(function ($cart_items) {
            $shop = $cart_items->first()->product->shop;
            return [
                'shop' => $shop,
                'items' => $cart_items,
                'total' => $cart_items->sum(fn($item) => $item->product->product_price * $item->quantity),
            ];
        });

        return view('livewire.cart-view', [
            'groupedItems' => $groupedItems,
            'cartItems' => $cartItems
        ]);
    }

    public function removeItem($cartItemId)
    {
        $cartItem = Cart::find($cartItemId);
        if ($cartItem) {
            $cartItem->delete();
            session()->flash('message', 'Item removed from cart.');
        } 
        else {
            session()->flash('error', 'Item not found.');
        }
    }
    public function updateQuantity($cartItemId, $quantity)
    {
        $cartItem = Cart::find($cartItemId);
        if ($cartItem) {
            $cartItem->update(['quantity' => $quantity]);
            session()->flash('message', 'Quantity updated.');
        } else {
            session()->flash('error', 'Item not found.');
        }
    }
    public function clearCart()
    {
        $userId = Auth::id();
        Cart::where('user_id', $userId)->delete();
        session()->flash('message', 'Cart cleared.');
    }
    public function checkout()
    {
        // Logic for checkout process
        session()->flash('message', 'Proceeding to checkout.');
    }
}
