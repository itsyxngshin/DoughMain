<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\CartItem;

class CartView extends Component
{
    public $cartItems = [];
    
    //Shows the cart and items in the cart
    public function render()
{
    $user = Auth::user();

    $cartItems = $user->cart
        ? $user->cart->cart_items()->with('product.shop')->get()
        : collect();

    // Group by shop ID, but ensure that product and shop are not null
    $grouped = $cartItems->filter(function ($cart_item) {
        return $cart_item->product && $cart_item->product->shop;
    })->groupBy(fn($cart_item) => $cart_item->product->shop->id);

    // Restructure for blade ease, ensure the shop is not null
    $groupedItems = $grouped->map(function ($cart_items) {
        $shop = $cart_items->first()->product->shop ?? null; // Ensure shop exists
        return [
            'shop' => $shop,
            'items' => $cart_items,
            'total' => $cart_items->sum(fn($item) => $item->product->product_price * $item->quantity),
        ];
    });

    return view('livewire.cart-view', [
        'groupedItems' => $groupedItems,
        'cartItems' => $cartItems
    ]);
}


    public function deleteItems($ids)
    {
        CartItem::whereIn('id', $ids)
            ->whereHas('cart', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->delete();

        $this->emitSelf('refreshComponent');
    }

    public function increaseQuantity($id)
    {
        $item = CartItem::find($id);

        if ($item && $item->cart->user_id === Auth::id()) {
            $item->quantity += 1;
            $item->save();
        }

        $this->emitSelf('refreshComponent');
    }

    public function decreaseQuantity($id)
    {
        $item = CartItem::find($id);

        if ($item && $item->cart->user_id === Auth::id()) {
            if ($item->quantity > 1) {
                $item->quantity -= 1;
                $item->save();
            } else {
                $item->delete(); // Optionally delete when quantity reaches 0 or 1
            }
        }

        $this->emitSelf('refreshComponent');
    }
    public function proceedToCheckout($selectedIds): RedirectResponse
    {
        // Validate the selected items belong to the user
        $validIds = CartItem::whereIn('id', $selectedIds)
            ->whereHas('cart', fn ($q) => $q->where('user_id', Auth::id()))
            ->pluck('id')
            ->toArray();

        if (empty($validIds)) {
            $this->dispatchBrowserEvent('checkout-error', ['message' => 'No valid items selected.']);
            return redirect()->route('livewire.cart-view');
        }

        session(['checkout_item_ids' => $validIds]);

        return redirect()->route('livewire.user.checkout');
        }
}
