<?php

namespace App\Livewire\User\Modal;

use Livewire\Component;
use App\Models\CartItem; // Adjust the namespace if the CartItem class is located elsewhere
use Illuminate\Support\Facades\Auth;

class DeleteMultipleItems extends Component
{

    public $selectedItems = [];

    public function deleteItems()
    {
        if (!is_array($this->selectedItems)) {
            logger('selectedItems is not an array', ['value' => $this->selectedItems]);
            return;
        }

        CartItem::whereIn('id', $this->selectedItems)
            ->whereHas('cart', fn($q) => $q->where('user_id', auth()->id()))
            ->delete();
    }

    public function render()
    {
        return view('livewire.user.modal.delete-multiple-items');
    }
}
