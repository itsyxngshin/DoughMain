<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class HomepageProductFilter extends Component
{
    public $categories;
    public $selectedCategories = [];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        $products = Product::with('category')
            ->when($this->selectedCategories, function ($query) {
                $query->whereIn('category_id', $this->selectedCategories);
            })->get();

        return view('livewire.user.homepage-product-filter', [
            'products' => $products,
        ]);
    }
}
