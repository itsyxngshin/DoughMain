<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class AdminProductManagement extends Component
{
    public $products;
    
    public function mount()
    {
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.admin.admin-product-management')->extends('layouts.admin') // Extends admin layout
        ->section('content');
    }
}
