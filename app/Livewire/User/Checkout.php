<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public $cartItems;
    public function mount()
    {
        $selectedCartItems = session('selected_cart_items', []);

        if (empty($selectedCartItems)) {
            session()->forget('checkout_item_ids');
            return redirect()->route('user.cart')->with('error', 'Your checkout session expired or was invalid.');
        }

        $this->cartItems = CartItem::whereIn('id', $selectedCartItems)->with('product')->get();

        if ($this->cartItems->isEmpty()) {
            session()->forget('checkout_item_ids');
            return redirect()->route('user.cart')->with('error', 'Your checkout session expired or was invalid.');
        }
    }

    public function render()
    {
        return view('livewire.user.checkout', [
            'cartItems' => $this->cartItems,
        ]);
    }
}
