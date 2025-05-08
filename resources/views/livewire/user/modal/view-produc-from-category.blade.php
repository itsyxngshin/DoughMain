<div 
    x-data="{ 
        open: false, 
        product: {
            id: '', name: '', img: '', desc: '', price: '', quantity: 1
        } 
    }"
    x-init="
        Livewire.on('successfully-added-to-cart', () => {
            open = false;
            setTimeout(() => {
                window.location.reload();
            }, 300);
        });
    "
>

    <!-- Product Loop -->
    <div class="grid sticky md:grid-cols-3 gap-6">
        @foreach ($product as $product)
            <!-- Product Button Trigger -->
            <button @click="
                open = true;
                product.id = {{ $product->id }};
                product.name = '{{ addslashes($product->product_name) }}';
                product.img = '{{ asset('storage/' . $product->product_image) }}';
                product.desc = '{{ addslashes($product->product_description) }}';
                product.price = '{{ $product->product_price }}';
                product.quantity = 1;
            ">
                <div class="searchable-item bg-transparent hover:bg-gray-200 p-5 shadow-lg rounded-lg text-center transition-transform transform hover:scale-105 duration-300">
                    <img src="{{ asset('storage/' . $product->product_image) }}" 
                         alt="{{ $product->product_name }}" 
                         class=" mx-auto w-56 h-56 object-cover overflow-hidden">
                    
                    
                    <h4 class="font-semibold">{{ $product->product_name }}</h4>
                    <p class="text-gray-500">{{ $product->product_description }}</p>
                    <p class="text-gray-800 font-bold">{{ $product->product_price }}</p>
                </div>
            </button>
        @endforeach
    </div>


    <!-- Modal -->
    <div 
        x-show="open" 
        x-cloak 
        class="fixed inset-0 bg-black w-full h-screen bg-opacity-50 flex items-center justify-center z-50"
    >
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
            <button 
                @click="open = false" 
                class="absolute top-2 right-2 text-gray-500 hover:text-red-500"
            >✕</button>

            <!-- Product Info -->
            <img :src="product.img" class="w-56 h-56 object-cover mx-auto mb-3">
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
                @click=" $wire.addToCartFromHomepage(product.id, product.quantity).then(() => {
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
