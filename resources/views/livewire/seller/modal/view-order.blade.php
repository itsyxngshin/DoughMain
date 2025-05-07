<div x-data="{ open: false }">
    <!-- View Product Button -->
    <button @click="open = true" class="text-[10px] border p-1 border-[#51331b] rounded hover:bg-[#51331b] hover:text-white">
        View Order
    </button>

    <!-- Modal -->
    <div x-show="open" x-cloak wire:ignore.self class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-[40%] h-auto rounded-xl p-6">
            <div class="relative">
                <div class="absolute top-0 right-0">
                    <button @click="open = false" class="bg-transparent text-gray-600 p-1 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 2048 2048">
                            <path fill="currentColor" d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z"/>
                        </svg>
                    </button>
                </div>
                <div class="flex border-b-1 border-gray-400 items-center p-6 py-2 gap-5 w-full">
                    <div class="w-full items-center flex gap-3">
                        <img src="" alt="" class="rounded-full w-[30px] h-[30px]">
                        <p class="font-bold text-xl">{{$selectedOrder->shop->shop_name}}</p>
                    </div>
                    <div class="border rounded border-[#FBBC04] w-[40%] justify-end
                        @if(strtolower($selectedOrder->status) == 'pending') border-yellow-500
                        @elseif(strtolower($selectedOrder->status) == 'completed') border-green-600
                        @elseif(strtolower($selectedOrder->status) == 'on process') border-yellow-600
                        @elseif(strtolower($selectedOrder->status) == 'out for delivery') border-orange-600
                        @elseif(strtolower($selectedOrder->status) == 'cancelled') border-red-600
                        @else border-gray-600 @endif">
                        <p class="text-[#FBBC04] text-[12px] 
                        @if(strtolower($selectedOrder->status) == 'pending') text-yellow-500
                            @elseif(strtolower($selectedOrder->status) == 'completed') text-green-600
                            @elseif(strtolower($selectedOrder->status) == 'on process') text-yellow-600
                            @elseif(strtolower($selectedOrder->status) == 'out for delivery') text-orange-600
                            @elseif(strtolower($selectedOrder->status) == 'cancelled') text-red-600
                            @else text-gray-600 @endif">
                            {{ ucfirst($selectedOrder->status) }}
                        </p>

                    </div>
                </div>  
            </div>
            
            
            <div class="w-full p-6 pt-0">
                <table class="border-t border-t-1 border-b border-b-1 border-gray-200 w-full">
                        <thead>
                            <tr class=" text-left">
                                <th class="p-2 font-semibold"> </th>
                                <th class="p-2 font-semibold">Item</th>
                                <th class="p-2 font-semibold">Category</th>
                                <th class="p-2 font-semibold">Quantity</th>
                                <th class="p-2 font-semibold">Unit Price</th>
                                <th class="p-2 font-semibold text-right">Total Price</th>
                               
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($selectedOrder->orderItems as $item)
                                @if ($item && $item->product)
                                    <tr>
                                        <td class="p-2">
                                            <img src="{{ asset('storage/' . $item->product->product_image) }}" alt="product image" class="w-auto h-12 object-cover m-auto" />
                                        </td>
                                        <td class="p-2">{{ $item->product->product_name }}</td>
                                        <td class="p-2">{{ $item->product->category->category_name ?? 'No category' }}</td>
                                        <td class="p-2">{{ $item->quantity }}</td>
                                        <td class="p-2">{{ $item->product->product_price }}</td>
                                        <td class="p-2 text-right">{{ number_format($item->quantity * $item->product->product_price, 2) }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center text-red-500 ">Missing product data</td>
                                    </tr>
                                @endif
                            @endforeach

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="p-2 font-semibold text-left">Subtotal:</td>
                                <td class="p-2 text-right font-semibold">{{ $selectedOrder->total_amount }}</td>
                            </tr>
                        </tbody>
                </table>
            </div>
            <div class="w-full p-6 pt-0">
                <table class="border-b border-b-1 border-gray-200 w-full ">
                    <tbody>
                    <tr>
                            <td class="text-left font-semibold">Order ID:</td>
                            <td class="pr-2 text-right">{{ $selectedOrder->id }}</td>
                        </tr>
                        
                        </tr>
                        <tr>
                            <td class="text-left font-semibold">Payment Method:</td>
                            <td class="pr-2 text-right">{{ $selectedOrder->payment_method }}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-semibold">Transaction Number:</td>
                            <td class="pr-2 text-right">@if($selectedOrder && $selectedOrder->payment)
                                                        {{ $selectedOrder->payment->provider_transc_id }}
                                                    @else
                                                        No Order
                                                    @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left font-semibold">Order Status:</td>
                            <td class="pr-2 text-right">{{ ucfirst($selectedOrder->status) }}</td>
                        </tr>  
                        <!--<tr>
                            <td class="text-left font-semibold">Shipping Fee:</td>
                            <td class="pr-2 text-right">+ {{ $selectedOrder->fee->fee_amount ?? 0}}</td>
                        </tr>-->
                        <tr>
                            <td class="text-left font-semibold">Total Amount:</td>
                            <td class="pr-2 text-right text-xl font-semibold">{{ $selectedOrder->total_amount }}</td>                     
                    </tbody>
                </table>
            </div>

            <!-- Actions -->
            <div class="mt-4 flex gap-3 justify-end">
                <button class="px-4 py-2 bg-transparent text-[#51331b] hover:underline"  @click="open = false">Cancel</button>
                
                @if(strtolower($selectedOrder->status) == 'pending')
                    <span>
                        @livewire('seller.modal.drop-order-confirmation', ['orderId' => $selectedOrder->id], key('drop-'.$selectedOrder->id))
                    </span>
                @endif
            
                <span>
                @if(strtolower($selectedOrder->status) == 'on process')
                    @livewire('seller.modal.out-for-delivery-order-confirmation', ['orderId' => $selectedOrder->id], key($selectedOrder->id))
                @elseif(strtolower($selectedOrder->status) == 'out for delivery')
                    @livewire('seller.modal.order-completion', ['orderId' => $selectedOrder->id], key($selectedOrder->id))
                @elseif(strtolower($selectedOrder->status) == 'pending')
                @livewire('seller.modal.approve-pending-order-confirmation', ['orderId' => $selectedOrder->id], key($selectedOrder->id))
                @elseif(strtolower($selectedOrder->status) == 'completed')
                    @livewire('seller.modal.view-customer-review', ['orderId' => $selectedOrder->id], key($selectedOrder->id))
                @endif
                </span>
            </div>
        </div>
    </div>
</div>
