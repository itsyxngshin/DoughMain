<?php

namespace App\Livewire\Seller;

use App\Models\Shop;
use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductManagement extends Component
{
    public $products;
    public $selectedProduct = null; 
    public $categories;
    public $search = '';
    public $selectedCategory = '';
    public $shopId;

    public function mount()
    {
        // Set shopId based on the authenticated user
        $this->shopId = Auth::check() && Auth::user()->shop ? Auth::user()->shop->id : 1;
        $this->categories = Category::all();

        // Fetch products for this shop
        $this->products = Product::with(['category', 'stock', 'stockMovements', 'shop'])
            ->where('shop_id', $this->shopId)
            ->get();
    }

    public function selectProduct($productId)
    {
        // Use the shopId already stored in the property
        $this->selectedProduct = Product::with(['category', 'stock', 'stockMovements'])
            ->where('shop_id', $this->shopId)
            ->find($productId);
    }

    public function render()
    {
        // Fetch products based on shopId
        $products = Product::with('category', 'stock', 'stockMovements')
            ->where('shop_id', $this->shopId)
            ->when($this->search, function ($query) {
                $query->where('product_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->get();

        return view('livewire.seller.product-management', [
            'products' => $products
        ])->layout('components.layouts.seller');
    }
}
