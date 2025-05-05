<!-- AlpineJS wrapper -->
<div x-data="{ open: false }" x-init="$watch('selected', value => $wire.set('selectedItems', value))">

    <!-- Delete Button -->
    <button 
        @click="open = true"
        class="mt-4 bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700"
        x-show="selected.length > 0"
    >
        Delete Selected Items
    </button>

    <!-- Modal -->
    <div x-show="open" x-cloak class="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Delete Selected Items</h2>
            <p class="text-gray-600 mb-4">
                Are you sure you want to delete these <strong x-text="selected.length"></strong> item(s)?
            </p>

            <!-- We'll render the list from Livewire outside this Alpine block -->
            <div wire:ignore>
                @livewire('user.modal.delete-multiple-items')
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button @click="open = false" class="bg-gray-300 px-3 py-2 rounded">Cancel</button>
                <button 
                    wire:click="deleteItems"
                    @click="open = false"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
                >
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>