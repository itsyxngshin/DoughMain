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
        // Get product data from the passed $product object
        $productId = $product['id'];
        $quantity = $product['quantity'];
        $price = $product['price'];
    
        // Calculate subtotal
        $subTotal = $price * $quantity;
    
        // Get the user's current cart (assumes the user is logged in)
        $cartId = Auth::user()->cart->id ?? 1;  // Or use a default cart ID if the user doesn't have a cart
    
        // Insert the new cart item into the database
        CartItem::create([
            'cart_id' => $cartId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'sub_total' => $subTotal, // Add subtotal value here
        ]);
    
        // Dispatch event to Alpine.js
        $this->dispatch('cart-added-success');
    }
    


    public function render()
    {
        return view('livewire.user.modal.view-shop-product');
    }
}
