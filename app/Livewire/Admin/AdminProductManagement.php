<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;

class AdminProductManagement extends Component
{
    public $products;
    
    public function mount()
    {
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.admin.admin-product-management')->with(['layout' => 'layouts.admin']); // Sets admin layout
    }
}
