<?php

namespace App\Livewire\User\Modal;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartItem;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

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
    $price = $product->product_price;
    $cartId = Auth::user()->cart->id ?? 1;

    $existingItem = CartItem::where('cart_id', $cartId)
        ->where('product_id', $productId)
        ->first();

    if ($existingItem) {
        $existingItem->quantity += $quantity;
        $existingItem->sub_total = $existingItem->quantity * $price;
        $existingItem->save();
    } else {
        CartItem::create([
            'cart_id' => $cartId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'sub_total' => $price * $quantity,
        ]);
    }

    $this->dispatch('cart-added-success');
}

    public function render()
    {
        return view('livewire.user.modal.view-product-from-search');
    }
}
