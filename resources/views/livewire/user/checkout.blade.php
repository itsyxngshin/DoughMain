@extends('components.layouts.navbar')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <!-- Checkout Title -->
        <h2 class="text-2xl font-bold text-[#1E1E1E] flex items-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#1E1E1E" class="mr-2">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4H6zm0 2h12l1.5 2H4.5L6 4zM5 8h14v10H5V8zm6 2a2 2 0 0 1 2 2v2h-2v-2h-2v2H7v-2a2 2 0 0 1 2-2h2z"/>
            </svg>
            Check out
        </h2>

        <!-- Order Summary -->
        <h3 class="text-lg font-semibold text-[#1E1E1E] mb-4">Order Summary</h3>

        <!-- Delivery Address -->
        <div class="bg-white border border-[#1E1E1E] rounded-lg p-4 mb-6">
            <div class="flex items-center text-sm mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#1E1E1E" class="mr-2">
                    <path d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/>
                </svg>
                <span class="font-bold text-[#1E1E1E]">Delivery Address</span>
            </div>
            <div class="flex justify-between text-sm">
                <div>
                    <p><strong>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</strong> </p>
                    <p><span class="text-gray-600">{{ Auth::user()->phone_number}}</span></p>
                    <p>{{ Auth::user()->location->city. ', ' .  Auth::user()->location->province }}</p>
                </div>
                <div class="text-xs space-x-2">
                    <span class="bg-yellow-300 text-[#1E1E1E] px-2 py-0.5 rounded">Default</span>
                    <a href="#" class="text-blue-600">Change</a>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <table class="w-full text-sm border mb-6">
            <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="p-3">Item</th>
                    <th class="p-3">Unit Price</th>
                    <th class="p-3">Quantity</th>
                    <th class="p-3">Item Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cartItems as $item)
                    <tr class="border-t">
                        <td class="p-3 flex items-center">
                            <img src="{{ asset('storage/'.$item['product']['product_image']) }}" 
                                class="w-12 h-12 rounded mr-3 object-cover">
                            {{ $item['product']['product_name'] }}
                        </td>
                        <td class="p-3">₱{{ number_format($item['product']['product_price'], 2) }}</td>
                        <td class="p-3">{{ $item['quantity'] }}</td>
                        <td class="p-3">₱{{ number_format($item['product']['product_price'] * $item['quantity'], 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-3 text-center text-gray-500">
                            No items found in your cart
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Summary Footer -->
        <div class="flex justify-between items-center p-4 border rounded-lg bg-white">
            <div class="text-sm text-gray-600">{{ count($cartItems) }} item(s)</div>

            <div class="text-right text-sm">
                <p class="mt-2">
                    Items Subtotal:
                    <span class="text-[#1E1E1E] font-semibold">
                        ₱{{ number_format($orderTotal, 2) }}
                    </span>
                </p>
                <p>Shipping Subtotal: <span class="text-[#1E1E1E] font-semibold">₱ -</span></p>
                <p class="text-lg mt-1 font-bold text-[#1E1E1E]">
                    Total: ₱{{ number_format($orderTotal, 2) }}
                </p>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-6 flex justify-end space-x-3">
            <button class="px-4 py-2 border border-gray-400 rounded-lg">Cancel</button>
            <button class="px-6 py-2 bg-[#1E1E1E] text-white rounded-lg font-semibold hover:bg-black">Place Order</button>
            {{--
            <button wire:click="redirectToPaymongo"
                class="px-6 py-2 bg-[#1E1E1E] text-white rounded-lg font-semibold hover:bg-black">
                Place Order
            </button>
            --}}
        </div>

        <!-- Notice -->
        <p class="mt-6 text-xs text-gray-500 text-center italic">
            *Ensure you have carefully read and agreed to the terms and conditions before finalizing your order.
        </p>
    </div>
</div>
@endsection
