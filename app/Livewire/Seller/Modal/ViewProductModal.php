<?php

namespace App\Livewire\Seller\Modal;

use App\Models\Product;
use Livewire\Component;

class ViewProductModal extends Component
{
    public function render()
    {
        return view('livewire.seller.modal.view-product-modal');
    }

    public $remainingStock;
    public $product;
    public $isOpen = false;

    // Method to handle opening the modal

    public function getRemainingStockAttribute()
    {
        return $this->quantity - $this->stockMovements->sum('quantity');
        return $this->quantity - $totalMoved;
    }


    public function openModal($productId)
    {
        $this->product = Product::with('stockMovements')->find($productId);

        if ($this->product) {
            $this->remainingStock = $this->product->remaining_stock;
        }

        $this->product = Product::find($productId);  // Find product by ID

        $this->isOpen = true;  // Open the modal
    }

    // Method to handle closing the modal
    public function closeModal()
    {
        $this->isOpen = false;  // Close the modal
    }
    

    public function close()
    {
        $this->showModal = false;
    }

}
