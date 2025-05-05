<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
class ProceedToCheckoutModal extends Component
{
    public $selectedItems = [];
    public $showModal = false;

    protected $listeners = ['openCheckoutModal' => 'prepareCheckout'];

    public function prepareCheckout($items)
    {
        // Validate items belong to current user
        $this->selectedItems = CartItem::with('product:id,product_name') // Only load what you need
        ->whereIn('id', $items)
        ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->product->product_name,
                'qty' => $item->quantity
            ];
        })
        ->toArray();
    
    $this->showModal = true;
    }

    // Renamed from proceedToCheckout to proceed (or keep name and fix typo)
    public function proceed()
    {
        // Add debug output
        
        // Get the IDs of selected items (assuming $this->selectedItems is already validated)
        $selectedIds = collect($this->selectedItems)->pluck('id')->toArray();
        logger()->debug('Selected items before processing:', ['selected_cart_items' => $selectedIds]);
        // Store in session (to be retrieved in the Checkout component)
        session(['selected_cart_items' => $selectedIds]);

        // Redirect to checkout
        return redirect()->route('user.checkout'); 
    }

    public function render()
    {
        return view('livewire.user.proceed-to-checkout-modal');
    }
}