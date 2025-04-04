@extends('layouts.navbar')

@section('content')
<div class="">
    <div class="w-full max-w-30xl bg-white shadow-lg rounded-lg p-6 mt-5">
        <!-- Title -->
        <h2 class="text-2xl font-bold text-brown-700 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="mr-2" fill="currentColor">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4H6zm0 2h12l1.5 2H4.5L6 4zM5 8h14v10H5V8zm6 2a2 2 0 0 1 2 2v2h-2v-2h-2v2H7v-2a2 2 0 0 1 2-2h2z"/>
            </svg>
            My Bag
        </h2>

        <!-- Cart Header -->
        <div class="mt-4 bg-white p-3 rounded-lg grid grid-cols-4 text-sm font-semibold text-gray-600 border">
            <span class="col-span-2">Unit Price</span>
            <span>Quantity</span>
            <span class="text-right">Total Price</span>
        </div>

        <!-- Cart Item -->
        <div class="bg-white p-4 border rounded-lg mt-3">
            <!-- Shop Name -->
            <div class="flex items-center mb-2">
                <input type="checkbox" class="mr-2">
                <span class="text-lg font-semibold text-brown-700 flex items-center">
                    BJ Bakery
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="ml-1">
                        <path d="M2 2h12v12H2z"/>
                    </svg>
                </span>
            </div>

            <!-- Item Row -->
            <div class="flex items-center justify-between border-t pt-3">
                <div class="flex items-center space-x-3">
                    <input type="checkbox" class="mr-2">
                    <img src="{{ asset('storage/pandesal.png') }}" class="w-12 h-12 rounded-lg object-cover" alt="Pandesal">
                    <span class="text-gray-700">Pandesal</span>
                </div>
                <span class="text-gray-700">₱ 5.00</span>

                <!-- Quantity -->
                <div class="flex items-center">
                    <button class="px-2 py-1 bg-gray-300 text-gray-700 rounded-l-lg">-</button>
                    <input type="text" value="20" class="w-12 text-center border">
                    <button class="px-2 py-1 bg-gray-300 text-gray-700 rounded-r-lg">+</button>
                </div>

                <span class="text-gray-700 font-semibold">₱ 100.00</span>
                <button class="text-red-500">Delete</button>
            </div>

            <!-- Shipping Promo -->
            <div class="flex items-center text-sm text-gray-600 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="mr-2">
                    <path d="M2 5h12v10H2z"/>
                </svg>
                <span>50% off shipping with min order of ₱299</span>
                <a href="#" class="text-blue-500 ml-2">Learn more</a>
            </div>
        </div>

        <!-- Select All & Checkout -->
        <div class="flex items-center justify-between bg-white p-3 rounded-lg mt-4 border">
            <div class="flex items-center">
                <input type="checkbox" class="mr-2">
                <span>Select All (1)</span>
            </div>
            <div class="text-lg font-semibold">
                Total (1 item): <span class="text-brown-700">₱100</span>
            </div>
            <button class="px-6 py-2 bg-[#1E1E1E] text-white font-semibold rounded-lg shadow-md hover:bg-black">
                Check Out
            </button>
        </div>
    </div>
</div>
@endsection
