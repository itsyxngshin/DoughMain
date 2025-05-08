<?php

namespace App\Livewire\User\Modal;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;


class ViewProducFromCategory extends Component
{
    public $shopId;
    public $categoryId;
    public $product;
    public $quantity;

    public function mount($shopId, $categoryId)
    {
        $this->shopId = $shopId;
        $this->categoryId = $categoryId;

        $this->product = Product::where('shop_id', $shopId)
            ->where('product_status', 'available')
            ->where('category_id', $categoryId)
            ->get();
    }

    public function addToCartFromHomepage($productId, $quantity)
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
        return view('livewire.user.modal.view-produc-from-category', [
            'product' => $this->product, // Make sure product is passed
            'quantity' => $this->quantity, // Also pass quantity to the view
        ]);
    }
}
