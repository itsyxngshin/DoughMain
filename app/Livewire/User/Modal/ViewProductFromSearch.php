<?php

namespace App\Livewire\User\Modal;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartItem;
use Livewire\Attributes\On;

class ViewProductFromSearch extends Component
{
    public $product;
    public $quantity = 1;
    public $isOpen = false;

    #[On('openProductModal')]
    public function openProductModal($productId)
    {
        $this->product = Product::findOrFail($productId);
        $this->quantity = 1;
        $this->isOpen = true;
    }

    public function addToCartFromSearch($productId, $quantity)
    {
        $product = Product::findOrFail($productId);
        $subTotal = $product->product_price * $quantity;

        $cartId = auth()->user()->cart->id ?? 1;

        CartItem::create([
            'cart_id' => $cartId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'sub_total' => $subTotal,
        ]);

        $this->dispatch('successfully-added-to-cart');
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.user.modal.view-product-from-search');
    }
}
