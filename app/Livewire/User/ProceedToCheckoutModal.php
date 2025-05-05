<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

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
        if (empty($this->selectedItems)) {
            $this->dispatch('notify-error', message: 'Please select at least one item');
            return;
        }
    
        // Ensure we have a flat array of IDs
        $selectedIds = $this->flattenArray($this->selectedItems);
    
        // Validate the IDs are numeric
        $selectedIds = array_filter($selectedIds, 'is_numeric');
    
        if (empty($selectedIds)) {
            $this->dispatch('notify-error', message: 'Invalid items selected');
            return;
        }
    
        // Store in session
        session([
            'selected_cart_items' => $selectedIds,
            'checkout_items' => CartItem::with('product')
                ->whereIn('id', $selectedIds)
                ->get()
                ->toArray()
        ]);
    
        return redirect()->route('user.checkout');
    }

    public function render()
    {
        return view('livewire.user.proceed-to-checkout-modal');
    }
}