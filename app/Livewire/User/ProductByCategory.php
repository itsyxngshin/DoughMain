<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Product;

class ProductByCategory extends Component
{
    public $id;
    public $category;
    public $bakeries;
    public $products;
    public $categoryId;

    public function mount($id)
    {
        $this->id = $id;
        $this->category = Category::FindOrFail($id);
        $this->bakeries = Shop::all();
        $this->products = Product::where('category_id', $this->categoryId)
                         ->where('shop_id', $this->id)
                         ->get();

    }

    public function render()
    {
        return view('livewire.user.product-by-category')->layout('components.layouts.navbar');
    }
}
