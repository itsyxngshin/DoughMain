
<div x-data="{ open: false }" x-init="open = false">
    <!-- View Product Button -->
    <button @click="open = true" class="text-[10px] border p-1 border-[#51331b] rounded hover:bg-[#51331b] hover:text-white">
        View User
    </button>

    <!-- Modal -->
    <div x-show="open" x-cloak wire:ignore.self class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <div class="relative w-full">
                <button @click="open = false" class="absolute right-1 bg-transparent text-gray p-1 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 2048 2048">
                        <path fill="currentColor" d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z"/>
                    </svg>
                </button>
            </div>
            
            <!-- Product Image -->
            <div class="m-5 w-40 h-40 overflow-hidden">
                <!-- You can dynamically change the product image using a variable -->
                <img src="{{ asset('storage/profile.jpg')  }}" alt="{{$user->profile_photo}}" class="w-auto h-40 m-auto object-cover rounded">
            </div>

            <!-- Product Name -->
            <h2 class="text-lg font-semibold">{{ $user->first_name }} {{ $user->last_name }}</h2>
            <p class="mt-2 text-gray-600">{{ $user->username ?? 'anonymous' }}</p>

            
            
            <!-- Price & Quantity -->
            <p class="mt-2 "><strong>Joined Since: </strong><span class="text-right">{{ $user->created_at }}</span> </p>
            <p><strong>Total Orders:</strong> {{ $user->completed_orders_count }}</p>



            


          
            

        </div>
    </div>
</div>




