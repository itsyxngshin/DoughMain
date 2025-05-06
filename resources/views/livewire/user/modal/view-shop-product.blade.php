<div 
    x-data="{ 
        open: false, 
        product: {
            id: null,
            name: '', 
            img: '', 
            desc: '', 
            price: '', 
            quantity: 1 
        } 
    }"
    x-init="
        window.livewire.on('added-to-cart', () => {
            open = false; 
        });
    "
>
<div>
    <!-- Product Grid -->
    <h3 class="text-xl font-semibold mt-8 text-center">{{ $category->category_name }}</h3>
    <p class="text-gray-600 mb-4 text-center">{{ $category->description }}</p>

    @if($products->isEmpty())
        <div class="flex justify-center items-center w-full">
            <p class="text-center text-gray-500 italic mt-5">Sorry, there are no available products in this category at the moment.</p>
        </div>
    @else
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="searchable-item bg-transparent hover:bg-gray-200 p-5 shadow-lg rounded-lg text-center transition-transform transform hover:scale-105 duration-300">
                    <a href="#" @click.prevent="product = {
                            id: {{ $product->id }},
                            name: '{{ $product->product_name }}',
                            img: '{{ asset('storage/products/' . $product->product_image) }}',
                            desc: '{{ $product->product_description }}',
                            price: '{{ $product->product_price }}',
                            quantity: 1
                        }; 
                        open = true;">
                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="w-40 mx-auto w-56 h-56 overflow-hidden">
                    </a>
                    <h4 class="font-semibold">{{ $product->product_name }}</h4>
                    <p class="text-gray-500">{{ $product->product_description }}</p>
                    <p class="text-gray-800 font-bold">{{ $product->product_price }}</p>
                </div>
            @endforeach
        </div>
    @endif

</div>
    
    <!-- Modal -->
    <div 
        x-show="open" 
        x-cloak 
        class="fixed inset-0 w-full bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
        <div class="bg-white sticky p-6 rounded-lg shadow-lg w-96 relative">
            <button 
                @click="open = false" 
                class="absolute top-2 right-2 text-gray-500 hover:text-red-500"
            >✕</button>

            <!-- Product Info -->
            <img :src="product.img" class="w-40 mx-auto mb-3">
            <h2 class="text-xl font-bold text-center" x-text="product.name"></h2>
            <p class="text-gray-600 text-center" x-text="product.desc"></p>
            <p class="text-gray-800 font-bold text-center" x-text="product.price"></p>

            <!-- Quantity & Add to Cart -->
            <div class="flex items-center justify-between mt-4">
                <div class="flex items-center border rounded">
                    <button 
                        @click="product.quantity = Math.max(1, product.quantity - 1)" 
                        class="px-3 py-1 text-gray-800 rounded-l"
                    >−</button>
                    <input 
                        type="number" 
                        x-model="product.quantity" 
                        min="1" 
                        class="w-16 p-1 text-center border-none"
                    >
                    <button 
                        @click="product.quantity++" 
                        class="px-3 py-1 text-gray-800 rounded-r"
                    >+</button>
                </div>

                <button
                    @click="$wire.addToCart(product).then(() => {
            open = false; // Close the modal after adding to cart
        })"
                    class="text-white text-center py-2 px-7 rounded"
                    style="background-color: #1E1E1E;"
                >
                    Add to Cart
                </button>

            </div>
        </div>
    </div>
</div>
