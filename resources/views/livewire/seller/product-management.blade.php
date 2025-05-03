@extends('components.layouts.seller')

@section('content')
<div> {{-- ✅ This is the required single root element --}}
    <div x-data="{ search: '', selectedCategory: '' }"  class="top-0 left-0 w-full h-auto bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center px-0">
        <div class="top-0 left-0 w-full h-[60px] bg-white border-b border-gray-200 bg-cover bg-center bg-no-repeat flex items-center px-6 rounded-t-xl">
            <h1 class="text-[#51331b] font-bold text-2xl px-3">{{ $shop->shop_name }}</h1>
        </div>    
        
        <h1 class="px-12 pt-6 font-bold text-[#51331b] text-3xl">Products</h1>

        <div class="flex items-center h-[50px] px-12 space-between gap-10 mt-2">
            <!-- Dropdown for Items per Page -->
            <div class="flex gap-2 items-center px-6">
                <select name="contents" class="border border-[#51331b] px-2 py-1 rounded-md flex">
                    <option value="1">5</option>
                    <option value="2" selected>10</option>
                    <option value="3">15</option>
                    <option value="4">20</option>
                </select>
                <p class="text-sm text-gray-500">contents per page</p>
            </div>

            <!-- Search Bar -->
            <div class="flex">
                <input type="text" x-model="search" placeholder="Search" class="pl-3 pr-3 py-1 text-sm border border-[#51331b] rounded-md">
            </div>

            <!-- Dropdown for Categories -->
             <div>
                <div class="flex gap-2 items-center">
                    <p class="text-sm text-gray-500">Category</p>
                    <select name="category_id" class="border border-[#51331b] px-2 py-1 rounded-md flex" x-model="selectedCategory" >
                        <option value="" selected>All</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
             </div>
            

            <!-- Add Product Button -->
            <div class="ml-auto">
                <button 
                    x-data 
                    @click="window.location.href='{{ route('addproduct', ['shop_id' => $shopId]) }}'"
                    class="border border-[#51331b] text-[351331b] px-3 py-1 rounded-md text-sm flex items-center mr-3 hover:bg-[#51331b] hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5 13v-1h6V6h1v6h6v1h-6v6h-1v-6z"/>
                    </svg> 
                    Add Product
                </button>
            </div>
        </div>

        <div class="flex px-12 py-2 pb-10 gap-4 flex-grow overflow-x-auto" style="max-height: 60%">
            <div class="border px-2 py-0 border-gray-300 rounded-xl p-4 flex-1">
                <table class="min-w-full table-auto w-full border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2 font-semibold">Product ID</th>
                            <th class="p-2 font-semibold">Picture</th>
                            <th class="p-2 font-semibold">Name</th>
                            <th class="p-2 font-semibold">Price</th>
                            <th class="p-2 font-semibold">Category</th>
                            <th class="p-2 font-semibold">Stocks</th>
                            <th class="p-2 font-semibold">Products Sold</th>
                            <th class="p-2 font-semibold">Remaining Stocks</th>
                            <th class="p-2 font-semibold">Status</th>
                            <th class="p-2 font-semibold"> </th>
                            <th class="p-2 font-semibold"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)

                        @php
                            // Convert the product name and category to lowercase for case-insensitive matching
                            $productName = strtolower($product->product_name);
                            $productCategory = strtolower(optional($product->category)->category_name ?? '');
                        @endphp
                        <tr class="border-b text-sm text-center"  x-show="(search === '' || '{{ $productName }}'.includes(search.toLowerCase())) 
                        && (selectedCategory === '' || selectedCategory == '{{ $product->category->id }}')">
                            <td class="p-2">{{ $product->id }}</td>
                            <td class="p-2 items-center">
                                <img src="{{ asset('storage/' . $product->product_image) }}" alt="product image" class="w-12 h-12 object-cover m-auto rounded" />
                            </td>
                            <td class="p-2">{{ $product->product_name }}</td>
                            <td class="p-2">{{ number_format($product->product_price, 2) }}</td>
                            <td class="p-2">{{ $product->category->category_name ?? 'No Category' }}</td>
                            <td class="p-2">{{ $product->stock->quantity ?? 0 }}</td>
                            <td class="p-2">{{  $product->stockMovements->where('movement_type', 'out')->sum('quantity') }}</td>
                            <td class="p-2">
                                            {{ $product->stockMovements->where('movement_type', 'in')->sum('quantity') 
                                                - $product->stockMovements->where('movement_type', 'out')->sum('quantity') }}
                                        </td>
                            <td class="p-2 font-semibold italic 
                                @if(strtolower($product->product_status) == 'available')
                                    text-green-500
                                @elseif(strtolower($product->product_status) == 'unavailable')
                                    text-gray-600
                                @endif">{{ $product->product_status ?? N/A }}</td>
                            <td class="p-2">
                                <button class="mt-2" 
                                    x-data 
                                    @click="window.location.href='{{ route('updateproduct', $product->id) }}'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                                        <path fill="currentColor" d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z"/>
                                    </svg>
                                </button>
                            </td>
                            <td class="p-2">
                                @livewire('seller.modal.delete-product', ['productId' => $product->id], key($product->id))
                            </td>

                            <td class="p-2">
                                @livewire('seller.modal.view-product-modal', ['product' => $product], key($product->id))
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div> {{-- ✅ Closing the root wrapper div --}}
@endsection
