<div x-cloak>
    <!-- Trigger Button -->
    <button 
        x-show="selected.length > 0"
        @click="
            if (selected.length === 0) {
                alert('Please select at least one item');
                return;
            }
            $wire.prepareCheckout(selected);
            $wire.showModal = true;
        " 
        class="px-4 py-2 bg-[#4A2E0F] text-white rounded-md hover:bg-[#3c2410]">
        Proceed to Checkout
    </button>

    <!-- Modal -->
    <div 
        x-show="$wire.showModal"
        x-transition.opacity
        class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center"
        wire:ignore.self
    >
        <div class="bg-white p-8 rounded-lg shadow-lg text-center relative w-[90%] max-w-md">
            <!-- Close Button -->
            <button 
                @click="$wire.showModal = false" 
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">
                &times;
            </button>

            <h3 class="text-2xl font-bold text-[#4A2E0F] mb-6">Proceed to Checkout?</h3>
            <p class="text-sm text-gray-700">
                You selected {{ count($selectedItems) }} item(s) 
            </p>
            <ul class="text-left max-h-40 overflow-y-auto mb-4 pl-4 border rounded p-2">
                @foreach($selectedItems as $item)
                    <li class="py-2 border-b last:border-b-0">
                        {{ $item['name'] }} (Qty: {{ $item['qty'] }})
                    </li>
                @endforeach
            </ul>
            <div class="flex justify-center gap-4">
                <!-- Cancel -->
                <button 
                    @click="$wire.showModal = false" 
                    class="px-4 py-2 border border-[#4A2E0F] text-[#4A2E0F] rounded-md hover:bg-gray-100">
                    No
                </button>

                <!-- Confirm -->
                <button 
                    wire:click="proceed"
                    @click="$wire.showModal = false"
                    class="px-4 py-2 bg-[#4A2E0F] text-white rounded-md hover:bg-[#3c2410]">
                    Yes
                </button>
            </div>
        </div>
    </div>
</div>