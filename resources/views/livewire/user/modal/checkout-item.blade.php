<div x-data="{ showModal: @entangle('show').defer }">
    <div 
        x-show="showModal" 
        x-cloak 
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50"
    >
        <div class="bg-white p-8 rounded-lg shadow-lg text-center relative w-[90%] max-w-md">
            <button 
                @click="showModal = false" 
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl"
            >
                &times;
            </button>

            <h3 class="text-2xl font-bold text-[#4A2E0F] mb-6">Proceed to Checkout?</h3>

            <div class="mb-4">
                <p class="text-sm text-gray-700">You selected {{ count($selectedItems) }} item(s).</p>
            </div>

            <div class="flex justify-center gap-4">
                <button 
                    @click="showModal = false"
                    class="px-4 py-2 border border-[#4A2E0F] text-[#4A2E0F] rounded-md hover:bg-gray-100"
                >
                    No
                </button>
                <button 
                    wire:click="proceed"
                    class="px-6 py-2 bg-[#1E1E1E] text-white font-semibold rounded-lg shadow-md hover:bg-black"
                >
                    Yes
                </button>
            </div>
        </div>
    </div>
</div>