<div x-data="{ open: false }">
    <button @click="open = true" class="px-4 py-2 bg-[#51331b] text-white rounded">
        Complete Order
    </button>

    <!-- Modal -->
    <div x-show="open" x-cloak wire:ignore.self class="fixed inset-0 bg-gray-500 bg-opacity-50 z-40 flex items-center justify-center">
        <div class="bg-white p-5 rounded shadow-md w-1/3 ">
            <p>Are you sure the order is now <strong>COMPLETE?</strong></p>
            <div class="mt-4 flex justify-center gap-2">
                <button @click="open = false" class="bg-gray-300 px-4 py-2 rounded">No</button>
                <button wire:click="completeOrder"
                        @click="open = false; setTimeout(() => { window.location.href = '{{ route('ordermanagement') }}'; }, 500);"
                        class="bg-[#51331b] text-white px-4 py-2 rounded">Yes</button>
            </div>
        </div>
    </div>
</div>
