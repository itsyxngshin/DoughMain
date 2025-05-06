@extends('components.layouts.navbar')

@section('content')
<div class="pt-28 px-4 min-h-screen bg-gray-100 flex justify-center">
    <div class="w-full max-w-6xl flex gap-6 items-start">
        <!-- Left Pane: Order Items -->
        <div class="w-1/2 bg-[#FAF3E0] border border-[#E8D9C1] rounded-lg shadow-md px-6 pt-6 pb-4 max-h-[80vh] overflow-y-auto">
            <h2 class="text-xl font-bold text-[#4A2E0F] mb-4">Your Order</h2>
            <ul class="space-y-4">
                @foreach($cartItems as $order)
                    <li class="border-b border-[#E0CDAA] pb-3">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs text-gray-500 italic">
                                    from {{ $order['product']['shop']['shop_name'] ?? 'Unknown Store' }}
                                </p>
                                <p class="text-sm font-bold text-gray-800">
                                    {{ $order['product']['product_name'] }}
                                </p>
                                <p class="text-xs text-gray-600">
                                    ₱{{ number_format($order['product']['product_price'], 2) }} each
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-700">x{{ $order['quantity'] }}</p>
                                <p class="text-sm font-semibold text-gray-800">
                                    ₱{{ number_format($order['sub_total'], 2) }}
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <!-- Total Summary -->
            <div class="mt-6 text-right">
                <p class="text-lg font-bold text-[#4A2E0F]">
                    Total: ₱{{ number_format($orderTotal, 2) }}
                </p>
            </div>
        </div>



        <!-- Right Pane: Payment Form -->
        <div class="w-1/2 bg-white rounded-lg shadow-md p-6">
            <!-- Title -->
            <h2 class="text-2xl font-bold text-[#4A2E0F] mb-6 text-center">Payment Details</h2>

            <form wire:submit.prevent="submitPayment" enctype="multipart/form-data" class="space-y-5">

                <!-- Payment Method Dropdown -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Select Payment Method</label>
                    <select wire:model="selectedPaymentMethod" class="w-full border border-gray-300 rounded-md px-4 py-2">
                        <option value="">-- Choose a method --</option>
                        @foreach($paymentMethods as $method)
                            <option value="{{ $method->id }}">{{ $method->payment_method }}</option>
                        @endforeach
                    </select>
                    @error('selectedPaymentMethod') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            
                <!-- Reference Number -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Reference Number</label>
                    <input wire:model.defer="reference" type="text" class="w-full border border-gray-300 rounded-md px-4 py-2">
                    @error('reference') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            
                <!-- Screenshot Upload -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Upload Screenshot</label>
                    <input wire:model="screenshot" type="file" accept="image/*" class="w-full border border-gray-300 rounded-md p-2">
                    @error('screenshot') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            
                <!-- Submit -->
                <div class="text-center">
                    <button type="submit" class="bg-[#4A2E0F] text-white px-6 py-2 rounded-md hover:bg-[#3c2410]">
                        Submit Payment
                    </button>
                </div>
            </form>
</div>
@endsection