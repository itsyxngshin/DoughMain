<?php

// Livewire Component (DeleteSelectedItem)
namespace App\Livewire\User\Modal;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class DeleteSelectedItem extends Component
{
    public $cartItemId;
    public $open = false;

    // Mount the component with the cartItemId
    public function mount($cartItemId)
    {
        $this->cartItemId = $cartItemId;
    }

    // Delete the cart item
    public function deleteCartItem()
    {
        $cartItem = CartItem::findOrFail($this->cartItemId);

        // Ensure the cart item belongs to the authenticated user
        if ($cartItem->cart->user_id === Auth::id()) {
            $cartItem->delete();
            session()->flash('message', 'Item deleted successfully.');
        } else {
            session()->flash('error', 'This item does not belong to you.');
        }

        // Optionally, dispatch an event after deletion
        $this->dispatch('cartItemDeleted');
    }

    public function render()
    {
        return view('livewire.user.modal.delete-selected-item');
    }
}
