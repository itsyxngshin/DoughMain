<?php

namespace App\Livewire\User\Modal;

use Livewire\Component;
use Livewire\Attributes\On;

class CheckoutItem extends Component
{

    public $show = false;
    public $selectedItems = [];

    #[On('setSelectedItems')]
    public function setSelectedItems($items)
    {
        $this->selectedItems = $items;
        $this->show = true;
    }

    public function proceed()
    {
        // Handle checkout logic with $this->selectedItems
        // e.g., store in session or redirect
    }

    public function render()
    {
        return view('livewire.user.modal.checkout-item');
    }
}
