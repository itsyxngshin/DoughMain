<?php

namespace App\Livewire\User\Modal;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class ViewShopProduct extends Component
{
    public $shopId;
    public $categoryId;
    public $category;
    public $products;

    public function mount($shopId, $categoryId)
    {
        $this->shopId = $shopId;
        $this->categoryId = $categoryId;

        // Fetch the category based on categoryId
        $this->category = Category::findOrFail($categoryId);

        // Fetch products by shop_id and category_id
        $this->products = Product::where('shop_id', $shopId)
            ->where('category_id', $categoryId)  // Filter by category_id
            ->get();
    }

    public function addToCart($product)
{
    
    $productId = $product['id'];
    $quantityToAdd = $product['quantity'];
    $price = $product['price'];

    $user = Auth::user();

    if (!$user || !$user->cart) {
        return;
    }

    $cartId = $user->cart->id;

    // Check if item already exists
    $existingItem = CartItem::where('cart_id', $cartId)
        ->where('product_id', $productId)
        ->first();

    if ($existingItem) {
        // Update quantity and subtotal
        $existingItem->quantity += $quantityToAdd;
        $existingItem->sub_total = $existingItem->quantity * $price;
        $existingItem->save();
    } else {
        // Insert new item
        CartItem::create([
            'cart_id' => $cartId,
            'product_id' => $productId,
            'quantity' => $quantityToAdd,
            'sub_total' => $price * $quantityToAdd,
        ]);
    
        // Dispatch event to Alpine.js
        $this->dispatch('cart-added-success');
    }
    


    public function render()
    {
        return view('livewire.user.modal.view-shop-product');
    }
}
