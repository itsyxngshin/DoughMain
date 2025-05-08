<div>
@if($isOpen && $product)
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
        <button wire:click="$set('isOpen', false)" class="absolute top-2 right-2 text-gray-500 hover:text-red-500">✕</button>

        <img src="{{ $product->product_img }}" class="w-40 mx-auto mb-3">
        <h2 class="text-xl font-bold text-center">{{ $product->product_name }}</h2>
        <p class="text-gray-600 text-center">{{ $product->product_description }}</p>
        <p class="text-gray-800 font-bold text-center">₱{{ number_format($product->product_price, 2) }}</p>

        <div class="flex items-center justify-between mt-4">
            <div class="flex items-center border rounded">
                <button wire:click="$set('quantity', max(1, $quantity - 1))" class="px-3 py-1 text-gray-800">−</button>
                <input type="number" wire:model="quantity" min="1" class="w-16 p-1 text-center border-none" />
                <button wire:click="$set('quantity', $quantity + 1)" class="px-3 py-1 text-gray-800">+</button>
            </div>

            <button
                wire:click="addToCartFromSearch({{ $product->id }}, {{ $quantity }})"
                class="text-white text-center py-2 px-7 rounded"
                style="background-color: #1E1E1E;"
            >
                Add to Cart
            </button>
        </div>
    </div>
</div>
@endif

</div>