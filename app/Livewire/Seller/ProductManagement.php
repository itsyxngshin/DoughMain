<?php

namespace App\Livewire\Seller;

use App\Models\Shop;
use App\Models\Product;
use Livewire\Component;

class ProductManagement extends Component
{
    public $products;
    public $selectedProduct = null; 

    public function mount()
    {
        $this->products = Product::with(['category', 'stock', 'stockMovements', 'shop'])->get();
    }


    public function selectProduct($productId)
    {
        $this->selectedProduct = Product::with(['category', 'stock', 'stockMovements'])->find($productId);
    }

    

    public function render()
    {
        return view('livewire.seller.product-management')->layout('layouts.seller');
    }
}
