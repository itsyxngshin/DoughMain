<?php

namespace App\Livewire\User\Modal;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class QuantityRev extends Component
{   
    public $cartItemId;
    public $quantity;

    public function mount($cartItemId)
    {
        $this->cartItemId = $cartItemId;
        $this->quantity = CartItem::findOrFail($cartItemId)->quantity;
    }

    public function increaseQuantity()
    {
        $this->quantity++;
        $this->updateCart();
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->updateCart();
        }
    }

    public function updatedQuantity()
    {
        if ($this->quantity < 1) {
            $this->quantity = 1;
        }
        $this->updateCart();
    }

    protected function updateCart()
    {
        $cartItem = CartItem::find($this->cartItemId);
        
        if ($cartItem) {
            $cartItem->update(['quantity' => $this->quantity]);
            $product = $cartItem->product;
            $price = $product->product_price;
            $subTotal = $price * $this->quantity;
            $cartItem->update(['sub_total' => $subTotal]);
        }
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.user.modal.quantity-rev');
    }
}
