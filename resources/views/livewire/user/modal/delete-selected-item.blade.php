<!-- Delete Modal -->
<div x-data="{ open: false }">

    <button @click="open = true" class="mt-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="currentColor" d="M7.616 20q-.672 0-1.144-.472T6 18.385V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zM17 6H7v12.385q0 .269.173.442t.443.173h8.769q.23 0 .423-.192t.192-.424zM9.808 17h1V8h-1zm3.384 0h1V8h-1zM7 6v13z"/>
        </svg>
    </button>

      <!-- Modal -->
    <div x-show="open" x-cloak wire:ignore.self class="fixed inset-0 bg-gray-500 bg-opacity-50 z-40 flex items-center justify-center">
        <div class="bg-white p-5 rounded shadow-md w-1/3 z-50">
            <p>Are you sure you want to delete this product?</p>
            <div class="mt-4 flex justify-end gap-2">
                <button @click="open = false" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                <button wire:click="deleteCartItem"  @click="open = false; setTimeout(() => { window.location.href = '{{ route('user.cart') }}'; }, 500);" class="bg-red-500 text-white px-4 py-2 rounded">Delete Product</button>
            </div>
        </div>
    </div>
    
</div>
