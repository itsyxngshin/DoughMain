<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class UpdateProduct extends Component
{
    public $product;
    public $categories;

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.seller.update-product');
    }
}
