<?php

// Livewire Component: ViewProductFromHomepage.php
namespace App\Livewire\User\Modal;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class ViewProductFromHomepage extends Component
{
    public $product;
    public $quantity = 1;

    public function mount($productId)
    {
        // Fetch the product data based on the ID
        $this->product = Product::findOrFail($productId);
    }

    public function addToCartFromHomepage($productId, $quantity)
{
    $product = Product::findOrFail($productId);
    $price = $product->product_price;
    $subTotal = $price * $quantity;

    $cartId = Auth::user()->cart->id ?? 1;

    CartItem::create([
        'cart_id' => $cartId,
        'product_id' => $productId,
        'quantity' => $quantity,
        'sub_total' => $subTotal,
    ]);

    $this->dispatch('cart-added-success');
}


    public function render()
{
    return view('livewire.user.modal.view-product-from-homepage', [
        'product' => $this->product, // Make sure product is passed
        'quantity' => $this->quantity, // Also pass quantity to the view
    ]);
}

}
