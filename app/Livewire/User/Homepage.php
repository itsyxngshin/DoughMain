<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Shop;

class Homepage extends Component
{
    public $products;
    public $categories;
    public $bakeries;
    public $search = '';

    public function mount()
    {
        $this->products = Product::where('product_status', 'available')->get();
        $this->categories = Category::all();
        $this->bakeries = Shop::with('shopLogo')->get();
    }

    public function getFilteredProductsProperty()
    {
        if (trim($this->search) === '') {
            return [];
        }

        return Product::where('product_name', 'like', '%' . $this->search . '%')
            ->where('product_status', 'available')
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.user.homepage')->layout('components.layouts.navbar');
    }
}
