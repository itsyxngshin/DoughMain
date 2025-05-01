@extends('components.layouts.navbar')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg space-y-6" x-data="checkoutDetails()">
        <h2 class="text-2xl font-bold text-center">Checkout Details</h2>

        <!-- Items -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold">Your Items</h3>
            <div class="space-y-3">
                <template x-for="(item, index) in items" :key="index">
                    <div class="flex justify-between">
                        <span x-text="item.name"></span>
                        <span>₱ <span x-text="item.price.toFixed(2)"></span></span>
                    </div>
                </template>
            </div>
        </div>

        <!-- Payment Method Selection -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold">Payment Method</h3>
            <div class="space-y-2">
                <label class="flex items-center">
                    <input type="radio" name="paymentMethod" value="cash_on_pickup" x-model="paymentMethod" class="mr-2">
                    Cash on Pickup
                </label>
                <label class="flex items-center">
                    <input type="radio" name="paymentMethod" value="cash_on_delivery" x-model="paymentMethod" class="mr-2">
                    Cash on Delivery
                </label>
                <label class="flex items-center">
                    <input type="radio" name="paymentMethod" value="e_wallet" x-model="paymentMethod" class="mr-2">
                    E-Wallet
                </label>
            </div>
        </div>

        <!-- E-Wallet Details -->
        <template x-if="paymentMethod === 'e_wallet'">
            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name on Card</label>
                    <input type="text" x-model="cardName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Juan Dela Cruz">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Card Number</label>
                    <input type="text" x-model="cardNumber" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="1234 5678 9012 3456">
                </div>

                <div class="flex space-x-3">
                    <div class="w-1/2">
                        <label class="block text-sm font-medium text-gray-700">Expiry</label>
                        <input type="text" x-model="expiry" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="MM/YY">
                    </div>
                    <div class="w-1/2">
                        <label class="block text-sm font-medium text-gray-700">CVC</label>
                        <input type="text" x-model="cvc" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="123">
                    </div>
                </div>
            </div>
        </template>

        <!-- Total Amount -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold">Total Amount</h3>
            <div class="text-xl font-bold">
                ₱ <span x-text="totalAmount.toFixed(2)"></span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between pt-6">
            <button @click="goBackToCart" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                Back to Cart
            </button>
            <button @click="confirmOrder" class="px-4 py-2 rounded text-white hover:opacity-90" style="background-color: #51331B;">
                Confirm Order
            </button>
        </div>
    </div>
</div>

@endsection
