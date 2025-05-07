
<div wire:key="cart-item-{{ $item->id }}" x-data="cartQuantity({{ $item->quantity }}, {{ $item->id }})" class="flex items-center border rounded">
    <button @click="decrease" class="px-3 py-1 text-gray-800 rounded-l">−</button>
    <input type="number" x-model="quantity" @change="update" min="1" class="w-16 p-1 text-center border-none">
    <button @click="increase" class="px-3 py-1 text-gray-800 rounded-r">+</button>
</div>