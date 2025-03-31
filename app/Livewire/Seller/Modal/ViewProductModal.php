<?php

namespace App\Livewire\Seller\Modal;

use Livewire\Component;

class ViewProductModal extends Component
{
    public function render()
    {
        return view('livewire.seller.modal.view-product-modal');
    }

    
   

    protected $listeners = ['openProductModal'];

    public function openProductModal($productId)
    {
        
    }

    public function close()
    {
        $this->showModal = false;
    }

}
