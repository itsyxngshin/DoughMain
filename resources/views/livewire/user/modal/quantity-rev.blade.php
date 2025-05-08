<div class="flex items-center border rounded" wire:ignore.self>
    <button wire:click="decreaseQuantity" class="px-3 py-1 text-gray-800 rounded-l">−</button>
    <input 
        type="number" 
        wire:model.lazy="quantity" 
        wire:change="updatedQuantity" 
        min="1" 
        class="w-16 p-1 text-center border-none"
    >
    <button wire:click="increaseQuantity" class="px-3 py-1 text-gray-800 rounded-r">+</button>
</div>