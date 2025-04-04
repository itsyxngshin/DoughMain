<div x-data="{ open: false }">
    <!-- View Product Button -->
    <button @click="open = true" class="text-[10px] border p-1 border-[#51331b] rounded hover:bg-[#51331b] hover:text-white">
        View Details
    </button>

    <!-- Modal -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
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
                        <p class="font-bold text-xl">Bakery Name</p>
                    </div>
                    <div class="border rounded border-[#FBBC04] w-[40%] justify-end">
                        <p class="text-[#FBBC04] text-[8px]">Out For Delivery</p>
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
                                <th class="p-2 font-semibold text-right">Price</th>
                               
                            </tr>
                        </thead>
                        <tbody >
                            <tr class="text-sm text-left">
                                <td class="p-2">image</td>
                                <td class="p-2">Pandesal</td>
                                <td class="p-2">Bread</td>
                                <td class="p-2">2</td>
                                <td class="p-2 text-right">20</td>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="p-2 font-semibold text-left">Subtotal:</td>
                                <td class="text-right font-semibold">P 170</td>
                            </tr>
                        </tbody>
                </table>
            </div>
            <div class="w-full p-6 pt-0">
                <table class="border-b border-b-1 border-gray-200 w-full ">
                    <tbody>
                        <tr >
                            <td class="text-left">Order ID:</td>
                            <td class="text-right">000000</td>
                        </tr>
                        <tr>
                            <td class="text-left">Total Amount:</td>
                            <td class="text-right">P 200.00</td>
                        </tr>
                        <tr>
                            <td class="text-left">Payment Method</td>
                            <td class="text-right">Cash On Delivery</td>
                        </tr>
                        <tr>
                            <td class="text-left">Reference No.</td>
                            <td class="text-right">01010101010101</td>
                        </tr>
                        <tr>
                            <td class="text-left">Tracking No.</td>
                            <td class="text-right">109439204</td>

                        </tr>
                        <tr class="">
                            <td class="text-left">Status</td>
                            <td class="font-bold text-right">Paid</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>

            <!-- Actions -->
            <div class="mt-4 flex gap-3 justify-end">
                <button class="px-4 py-2 bg-transparent text-[#51331b] hover:underline"  @click="open = false">Cancel</button>
                <button class="px-4 py-2 bg-[#51331b] text-white rounded">Export</button>
            </div>
        </div>
    </div>
</div>
