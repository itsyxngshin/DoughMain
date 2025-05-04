<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Review;

class Homepage extends Component
{
    public $products;
    public $categories;
    public $bakeries;
    public $testimonials;
    public $selectedCategories = [];

    public function mount()
    {
        $this->categories = Category::all();
        $this->bakeries = Shop::with('shopLogo')->get();

        $this->testimonials = Review::with(['user', 'shop'])
            ->latest()
            ->take(6)
            ->get();

        // Initially, fetch all products
        $this->products = Product::with('reviews')->where('product_status', 'available')->get();
    }

    public function updatedSelectedCategories()
    {
        // Log the selected categories for debugging
        \Log::info('Selected Categories:', $this->selectedCategories);

        // Filter the products based on the selected categories
        $this->products = Product::with('reviews')
            ->where('product_status', 'available')
            ->when(count($this->selectedCategories), function ($query) {
                $query->whereIn('category_id', $this->selectedCategories);
            })
            ->get();
        
        // Log the filtered products
        \Log::info('Filtered Products:', $this->products->toArray());
    }



    public function render()
    {
        return view('livewire.user.homepage', [
            'products' => $this->products,
        ])->layout('components.layouts.navbar');
    }
}
