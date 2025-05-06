<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $shop = $cart_items->first()->product->shop ?? null;
        return [
            'shop' => $shop,
            'items' => $cart_items,
            'total' => $cart_items->sum(function ($item) {
                return $item->product ? $item->product->product_price * $item->quantity : 0;
            }),
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

    public function updateQuantity($cartItemId, $newQuantity)
    {
    $cartItem = CartItem::find($cartItemId);
    if (!$cartItem) {
        logger()->debug('Selected items before processing:', ['cartItemId' => $cartItemId]);
        return;
    }

    if ($cartItem->cart->user_id !== Auth::id()) {
        logger()->debug('Selected items before processing:', [
            'cartItemId' => $cartItemId,
            'userId' => Auth::id(),
        ]);
        return;
    }

    if ($cartItem && $cartItem->cart->user_id === Auth::id()) {
        $cartItem->quantity = max(1, (int) $newQuantity);
        $cartItem->save();
        }
    }
    public function proceedToCheckout($selectedIds): RedirectResponse
    {
        // Validate the selected items belong to the user
        $validIds = CartItem::with('product.shop')
            ->whereIn('id', $selectedIds)
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
