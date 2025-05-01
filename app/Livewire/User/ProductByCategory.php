<?php

namespace App\Livewire\User;

use Livewire\Component;

class ProductByCategory extends Component
{
    public $categoryId;
    

    public function mount($id)
    {
        $this->categoryId = $id;
       
    }

    public function render()
    {
        return view('livewire.user.product-by-category')->layout('components.layouts.navbar');
    }
}
