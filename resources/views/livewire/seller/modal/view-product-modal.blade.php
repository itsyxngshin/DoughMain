<div x-data="{ open: false }">
    <!-- View Product Button -->
    <button @click="open = true" class="text-[10px] border p-1 border-[#51331b] rounded hover:bg-[#51331b] hover:text-white">
        View Product
    </button>

    <!-- Modal -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <div class="relative w-full">
                <button @click="open = false" class="absolute right-1 bg-transparent text-gray p-1 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 2048 2048"><path fill="currentColor" d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z"/></svg>
                </button>
            </div>
            <!-- Product Image -->
            <div class="mt-3">
                <img src="https://via.placeholder.com/150" alt="Product Image" class="w-full h-40 object-cover rounded">
            </div>

            <h2 class="text-lg font-semibold">Sample Product Name</h2>
            <p class="mt-2 text-gray-600">This is a sample product description.</p>
            
            <!-- Price & Quantity -->
            <p class="mt-2"><strong>Price:</strong> ₱1,500.00</p>
            <p><strong>Quantity:</strong> 10</p>

            <!-- Actions -->
            <div class="mt-6 flex gap-1 justify-center">
                <button class="px-4 py-2 bg-transparent text-[#51331b] hover:underline"  @click="open = false">Delete</button>
                <button class="px-4 py-2 bg-[#51331b] text-white rounded"
                    x-data 
                    @click="window.location.href='{{ route('updateproduct') }}'">Edit</button>
            </div>
        </div>
    </div>
</div>
