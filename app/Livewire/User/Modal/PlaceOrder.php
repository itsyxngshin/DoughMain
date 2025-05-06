<?php

namespace App\Livewire\User\Modal;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\CartItem; // Ensure this is the correct namespace for CartItem
use Illuminate\Support\Facades\Auth;

class PlaceOrder extends Component
{
    public $show = false;
    public $cartItems = [];

    public function mount()
    {
        // Retrieve selected item IDs from the session
        $selectedIds = session('selected_cart_items', []);

        // Load cart items (with product info)
        $this->cartItems = CartItem::with('product.shop')
            ->whereIn('id', $selectedIds)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->get()
            ->toArray();

        // Redirect if no items are selected
        if (empty($this->cartItems)) {
            return redirect()->route('user.cart')->with('error', 'No items selected for checkout.');
        }
    }
    public function placeOrderHere()
    {
    // Add debug output
        
        // Get the IDs of selected items (assuming $this->selectedItems is already validated)
        $selectedIds = collect($this->cartItems)->pluck('id')->toArray();

        // Store in session (to be retrieved in the Checkout component)
        session(['order_items' => $selectedIds]);
        // Example: simple debug
          //dd('Order placed with items:', $this->cartItems);
        // Redirect to checkout
        return redirect()->route('user.payments'); 

    
    }

    public function render()
    {
        return view('livewire.user.modal.place-order');
    }
}
