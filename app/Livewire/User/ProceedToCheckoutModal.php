<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Cart;

class ProceedToCheckoutModal extends Component
{
    public $selectedItems = [];
    public $itemsForCheckout = [];


protected $listeners = ['openCheckoutModal'];

public function openCheckoutModal($items)
{
    $this->selectedItems = $items;
    $this->dispatch('show-checkout-modal');
}


public function setSelectedItems($itemIds)
{
    $this->selectedItems = $itemIds;

    $this->itemsForCheckout = Cart::with('product')
        ->whereIn('id', $itemIds)
        ->get()
        ->toArray();

    dd($this->itemsForCheckout); // Debug output
}


    public function proceed()
    {
        // You can store selected items in session if needed
        session(['checkout_items' => $this->selectedItems]);
        return redirect()->route('user.checkout');
    }

    public function render()
    {
        return view('livewire.user.proceed-to-checkout-modal');
    }
}
