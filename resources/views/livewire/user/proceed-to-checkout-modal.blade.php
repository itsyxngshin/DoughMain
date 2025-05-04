<!-- Checkout Confirmation Modal -->
<div x-data="{ open: false }">

    <!-- Trigger Button -->
     <!-- this is for checking console logs if nakakafetch talaga nung item ids, remove nalang @click="
            console.log('Selected IDs:', selected);
            Livewire.dispatch('openCheckoutModal', { items: selected })
        "  -->
    <button 

        @click="open = true" 
        class="px-4 py-2 bg-[#4A2E0F] text-white rounded-md hover:bg-[#3c2410]">
        Proceed to Checkout
    </button>

    <!-- Modal -->
    <div 
        x-show="open"
        x-cloak
        wire:ignore.self
        class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center"
    >
        <div class="bg-white p-8 rounded-lg shadow-lg text-center relative w-[90%] max-w-md">
            <!-- Close Button -->
            <button 
                @click="open = false" 
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">
                &times;
            </button>

            <h3 class="text-2xl font-bold text-[#4A2E0F] mb-6">Proceed to Checkout?</h3>

            <div class="flex justify-center gap-4">
                <!-- Cancel -->
                <button 
                    @click="open = false" 
                    class="px-4 py-2 border border-[#4A2E0F] text-[#4A2E0F] rounded-md hover:bg-gray-100">
                    No
                </button>

                <!-- Confirm -->
                <a href="{{ route('user.checkout') }}">
                    <button 
                        class="px-4 py-2 bg-[#4A2E0F] text-white rounded-md hover:bg-[#3c2410]">
                        Yes
                    </button>
                </a>
            </div>
        </div>
    </div>

</div>
