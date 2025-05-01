<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Shop;
use App\Models\ShopLogo;

class Homepage extends Component
{
    public $products;
    public $categories;
    public $bakeries;

    public function mount()
    {
        // Fetch products with status 'available'
        $this->products = Product::where('product_status', 'available')->get();
        
        // Fetch all categories
        $this->categories = Category::all();
        
        // Fetch all bakeries with their logos
        $this->bakeries = Shop::with('shopLogo')->get();
    }

    public function render()
    {
        return view('livewire.user.homepage')->layout('components.layouts.navbar');
    }
}
