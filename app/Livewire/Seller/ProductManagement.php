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
        // Get the shop managed by the currently logged-in user
        $shop = Shop::where('manage_id', auth()->id())->firstOrFail();
        $this->shopId = $shop->id;

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
        $products = Product::with(['category', 'stock', 'stockMovements', 'shop']) // ✅ Add 'shop'
        ->where('shop_id', $this->shopId)
        ->when($this->search, function ($query) {
            $query->where('product_name', 'like', '%' . $this->search . '%');
        })
        ->when($this->selectedCategory, function ($query) {
            $query->where('category_id', $this->selectedCategory);
        })
        ->get();

        return view('livewire.seller.product-management', [
            'products' => $products,
            'shop' => Shop::find($this->shopId)
        ])->layout('components.layouts.seller');
    }
}
