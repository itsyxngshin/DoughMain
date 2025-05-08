<?php

namespace App\Livewire\Seller\Modal;


use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\On;

class DeleteProduct extends Component
{
    public $productId;

    // This is to mount the component and pass the productId
    public function mount($productId)
    {
        $this->productId = $productId;
    }

    // Delete the product
    public function deleteProduct()
{
    Product::findOrFail($this->productId)->delete();

    $this->dispatch('productDeleted'); // Livewire event
    
}


    public function render()
    {
        return view('livewire.seller.modal.delete-product');
    }
}
