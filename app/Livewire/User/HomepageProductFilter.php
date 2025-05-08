<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class HomepageProductFilter extends Component
{
    public $selectedCategories = [];
    public $sort = 'relevance';
    public $rating = null;

    public function getFilteredProductsProperty()
{
    $query = Product::query();

    if (!empty($this->selectedCategories)) {
        $query->whereIn('category_id', $this->selectedCategories);
    }

    if ($this->rating) {
        $query->where('average_rating', '>=', $this->rating);
    }

    if ($this->sort === 'distance') {
        // Add distance-based sorting logic here
    }

    return $query->get();
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
