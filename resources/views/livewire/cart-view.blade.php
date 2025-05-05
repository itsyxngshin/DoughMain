@extends('components.layouts.navbar')

@section('content')
<div class="min-h-screen flex justify-center items-start mt-8">
    <div class="w-full max-w-6xl bg-white shadow-lg rounded-lg p-6">
        <!-- Title -->
        <h2 class="text-2xl font-bold text-brown-700 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="mr-2" fill="currentColor">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4H6zm0 2h12l1.5 2H4.5L6 4zM5 8h14v10H5V8zm6 2a2 2 0 0 1 2 2v2h-2v-2h-2v2H7v-2a2 2 0 0 1 2-2h2z"/>
            </svg>
            My Bag
        </h2>

        <!-- Cart Header -->
        <div class="mt-4 bg-white p-3 rounded-lg overflow-x-auto border">
            <table class="min-w-full text-sm text-black-600">
                <thead class="bg-transparent font-semibold">
                    <tr>
                        <th class="px-4 py-2 text-left w-1/5">Items</th>
                        <th class="px-4 py-2 text-left w-1/5">Unit Price</th>
                        <th class="px-4 py-2 text-left w-1/5">Quantity</th>
                        <th class="px-4 py-2 text-right w-1/4">Amount</th>
                    </tr>
                </thead>
                
            </table>
        </div>

        <!-- Loop through cart items -->
        <div x-data="cartComponent()" x-init="init()" class="space-y-4">
            @if($groupedItems->isEmpty())
                <p>Your cart is empty.</p>
            @else
                @foreach($groupedItems as $group)
                    <div class="bg-white p-4 border rounded-lg mt-6">
                        <!-- Shop Info -->
                        <div class="flex items-center mb-3">
                        <input type="checkbox" 
            class="mr-2"
            @change="toggleSelectAll($event, {{ $group['items']->pluck('id') }})">

                    <div class="flex items-center space-x-2">
                        {{-- Check if shop exists before trying to display the logo and shop name --}}
                        @if ($group['shop'])
                            {{-- 
                            @if($group['shop']->shop_logo)
                                <img src="{{ asset('storage/' . $group['shop']->shop_logo) }}" alt="{{ $group['shop']->shop_name }}" class="w-8 h-8 rounded-full object-cover">
                            @endif
                            --}}
                            <span class="text-lg font-semibold text-brown-700">
                                {{ $group['shop']->shop_name }}
                            </span>
                        @else
                            <span class="text-red-600">Unknown Shop</span>
                        @endif
                    </div>
                </div>

                <!-- Cart Items Under This Shop -->
                        @foreach ($group['items'] as $item)
                            <div class="flex items-center justify-between border-t pt-3" wire:key="cart-item-{{ $item->id }}">

                                <div class="flex items-center space-x-3">
                                <input type="checkbox" 
                                        class="mr-2"
                                        :checked="isSelected({{ $item->id }})"
                                        @change="toggleItem({{ $item->id }})">
                                    <img src="{{ asset('storage/' . $item->product->product_image) }}" class="w-12 h-12 rounded-lg object-cover" alt="{{ $item->product->product_name }}">
                                    <span class="text-gray-700">{{ $item->product->product_name }}</span>
                                </div>

                                <span class="text-gray-700">{{ $item->product->product_price }}</span>

                                <div wire:key="cart-item-{{ $item->id }}" x-data="cartQuantity({{ $item->quantity }}, {{ $item->id }})" class="flex items-center border rounded">
                                    <button @click="decrease" class="px-3 py-1 text-gray-800 rounded-l">−</button>
                                    <input type="number" x-model="quantity" @change="update" min="1" class="w-16 p-1 text-center border-none">
                                    <button @click="increase" class="px-3 py-1 text-gray-800 rounded-r">+</button>
                                </div>

                                <span class="text-gray-700 font-semibold">{{ $item->sub_total }}</span>

                                <!-- Trigger Delete Modal by Passing the cartItem ID -->
                                @livewire('user.modal.delete-selected-item', ['cartItemId' => $item->id], key($item->id))

                            </div>
                        @endforeach




                            <!-- Shop Subtotal -->
                            <div class="text-right mt-3 text-sm font-semibold text-brown-800">
                                Subtotal for {{ $group['shop']->shop_name }}: ₱{{ number_format($group['total'], 2) }}
                            </div>
                        </div>
                    @endforeach
                            
                            <!-- Delete Selected Button -->
                            {{--@livewire('user.modal.delete-multiple-items') --}} 
                            

            @endif
            <!-- Shipping Promo -->
            <div class="flex items-center text-sm text-gray-600 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="mr-2">
                    <path d="M2 5h12v10H2z"/>
                </svg>
                <span>50% off shipping with min order of ₱299</span>
                <a href="#" class="text-blue-500 ml-2">Learn more</a>
            </div>

            @php
                $grandTotal = collect($cartItems)->sum(function($item) {
                    return $item->product->product_price * $item->quantity;
                });
            @endphp


            <!-- Select All & Checkout -->
            <div class="flex items-center justify-between bg-white p-3 rounded-lg mt-4 border">
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        class="mr-2"
                        :checked="selected.length === {{ collect($cartItems)->count() }}"
                        @change="toggleSelectAll($event, {{ collect($cartItems)->pluck('id')->toJson() }})"
                    >
                    <span>Select All ({{ collect($cartItems)->count() }})</span>
                </div>

                <div class="text-lg font-semibold">
                    Total ({{ collect($cartItems)->count() }}): 
                    <span class="text-brown-700">₱{{ number_format($grandTotal, 2) }}</span>
                </div>

                <!-- Hidden input to pass selected IDs to Livewire -->
                <input type="hidden" x-ref="selectedItems" :value="JSON.stringify(selected)">

                <!-- Livewire Proceed to Checkout Modal -->
                @livewire('user.proceed-to-checkout-modal')
            </div>

        </div>
    </div>
    
</div>



<!-- Modal -->
{{--
<div id="checkoutModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center relative">
        <button onclick="toggleModal(false)" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
        <h3 class="text-2xl font-bold text-[#4A2E0F] mb-6">Proceed to Checkout?</h3>
        <div class="flex justify-center gap-4">
            
            <button onclick="toggleModal(false)" class="px-4 py-2 border border-[#4A2E0F] text-[#4A2E0F] rounded-md hover:bg-gray-100">
                No
            </button>
            <a href="{{ route('user.checkout') }}">
                <button class="px-4 py-2 bg-[#4A2E0F] text-white rounded-md hover:bg-[#3c2410]">
                    Yes
                </button>
            </a>
        </div>
    </div>
</div>

--}}

<!-- Modal Script -->
<script>
    function toggleModal(show) {
        // Show or hide the modal based on the 'show' parameter for checkout
        const modal = document.getElementById('checkoutModal');
        modal.classList.toggle('hidden', !show);
    }

    function cartQuantity(initialQuantity, cartItemId) {
        return {
            quantity: initialQuantity,
            increase() {
                this.quantity++;
                this.update();
            },
            decrease() {
                if (this.quantity > 1) {
                    this.quantity--;
                    this.update();
                }
            },
            update() {
                if (typeof $wire !== 'undefined') {
                    $wire.updateQuantity(cartItemId, this.quantity);
                } else {
                    console.error('Livewire $wire is undefined.');
                }
            }
        }
    }


    function cartComponent() {
        return {
            selected: [],
            init() {
                // Initialize with any previously selected items if needed
            },
            toggleItem(id) {
                if (this.selected.includes(id)) {
                    this.selected = this.selected.filter(item => item !== id);
                } else {
                    this.selected.push(id);
                }
                // Update Livewire component
                this.$wire.selectedItems = this.selected;
            },
            isSelected(id) {
                return this.selected.includes(id);
            },
            toggleSelectAll(event, ids) {
                if (event.target.checked) {
                    this.selected = [...new Set([...this.selected, ...ids])];
                } else {
                    this.selected = this.selected.filter(id => !ids.includes(id));
                }
                // Update Livewire component
                this.$wire.selectedItems = this.selected;
            }
        };
    }

</script>
@endsection