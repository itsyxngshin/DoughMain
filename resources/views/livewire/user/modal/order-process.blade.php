<div class="w-1/2 bg-white rounded-lg shadow-md p-6">
    <!-- Title -->
    <h2 class="text-2xl font-bold text-[#4A2E0F] mb-6 text-center">Payment Details</h2>
    
    
    <form wire:submit.prevent="submitPayment" class="space-y-5">

    <div>
        <label class="block text-gray-700 font-semibold mb-1">Select Payment Method</label>
        <select wire:model.live="selectedPaymentMethod" class="w-full border border-gray-300 rounded-md px-4 py-2">
            <option value="">-- Choose a method --</option>
            @foreach($paymentMethods as $method)
                <option value="{{ $method->id }}">{{ $method->payment_method }}</option>
            @endforeach
        </select>
        
        @error('selectedPaymentMethod') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Payment details rendered below -->
@if ($shopPaymentDetail)
    <div class="mt-4 border p-4 bg-gray-100 rounded">
        <p><strong>Account Name:</strong> {{ $shopPaymentDetail->account_name }}</p>
        <p><strong>Account Number:</strong> {{ $shopPaymentDetail->account_number }}</p>
        <p><strong>Status:</strong> {{ ucfirst($shopPaymentDetail->status) }}</p>
    </div>
@elseif(in_array($selectedPaymentMethod, [3, 4]))  <!-- Check for Cash on Delivery or Cash on Pickup -->
    <div class="mt-4 text-sm text-red-500">
        Leave reference and screenshot blank.
    </div>
@elseif($selectedPaymentMethod)
    <div class="mt-4 text-sm text-red-500">
        No payment details available for this method.
    </div>
@endif

            
    
        <!-- Reference Number -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Reference Number</label>
            <input wire:model.lazy="reference" type="text" class="w-full border border-gray-300 rounded-md px-4 py-2">
            @error('reference') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    
        <!-- Screenshot Upload -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Upload Screenshot</label>
            <input wire:model="screenshot" type="file" accept="image/*" class="w-full border border-gray-300 rounded-md p-2">
            @error('screenshot') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Delivery Address</label>
            <input wire:model.defer="deliveryAddress" type="text" class="w-full border border-gray-300 rounded-md px-4 py-2" readonly>
            @error('deliveryAddress') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    
        <!-- Submit -->
        <div class="text-center">
            <button type="submit" class="bg-[#4A2E0F] text-white px-6 py-2 rounded-md hover:bg-[#3c2410]">
                Submit Payment
            </button>
        </div>
    </form>
</div>
