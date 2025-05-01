@extends('components.layouts.navbar')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <h2 class="text-3xl font-bold mb-8 flex items-center text-brown-800">
        <svg class="w-7 h-7 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h18v18H3V3z" />
        </svg>
        My Orders
    </h2>

    <!-- Orders List -->
    <section class="space-y-6">

        <!-- Order Card -->
        <article class="order-card bg-white shadow rounded-lg">
            <!-- Order Header -->
            <header class="flex justify-between items-center px-6 py-4 border-b text-sm text-gray-600">
                <div>
                    <strong>Order #1001</strong>
                    <span class="ml-2 text-xs text-gray-400">Apr 28, 2025 - 2:30 PM</span>
                </div>
                <span class="text-green-600 font-semibold">Delivered</span>
            </header>

            <!-- Items -->
            <div class="order-items divide-y">
                <div class="order-item px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center space-x-4 w-2/5">
                        <img src="https://via.placeholder.com/50" alt="Pandesal" class="w-12 h-12 rounded object-cover">
                        <span class="font-medium text-gray-800">Pandesal</span>
                    </div>
                    <div class="w-1/5 text-center text-gray-700">₱5.00</div>
                    <div class="w-1/5 text-center text-gray-700">10</div>
                    <div class="w-1/5 text-right text-gray-800 font-semibold">₱50.00</div>
                </div>

                <div class="order-item px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center space-x-4 w-2/5">
                        <img src="https://via.placeholder.com/50" alt="Chiffon" class="w-12 h-12 rounded object-cover">
                        <span class="font-medium text-gray-800">Chiffon</span>
                    </div>
                    <div class="w-1/5 text-center text-gray-700">₱160.00</div>
                    <div class="w-1/5 text-center text-gray-700">1</div>
                    <div class="w-1/5 text-right text-gray-800 font-semibold">₱160.00</div>
                </div>
            </div>

            <!-- Order Footer -->
            <footer class="px-6 py-4 border-t flex justify-between items-center text-sm text-gray-700">
                <div>
                    <span class="font-medium">Payment Method:</span> GCash
                </div>
                <div class="font-bold text-gray-900">Total: ₱210.00</div>
            </footer>
        </article>

        <!-- Another Order -->
        <article class="order-card bg-white shadow rounded-lg">
            <header class="flex justify-between items-center px-6 py-4 border-b text-sm text-gray-600">
                <div>
                    <strong>Order #1000</strong>
                    <span class="ml-2 text-xs text-gray-400">Apr 25, 2025 - 10:15 AM</span>
                </div>
                <span class="text-yellow-600 font-semibold">Pending</span>
            </header>

            <div class="order-items divide-y">
                <div class="order-item px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center space-x-4 w-2/5">
                        <img src="https://via.placeholder.com/50" alt="Ensaymada" class="w-12 h-12 rounded object-cover">
                        <span class="font-medium text-gray-800">Ensaymada</span>
                    </div>
                    <div class="w-1/5 text-center text-gray-700">₱35.00</div>
                    <div class="w-1/5 text-center text-gray-700">2</div>
                    <div class="w-1/5 text-right text-gray-800 font-semibold">₱70.00</div>
                </div>
            </div>

            <footer class="px-6 py-4 border-t flex justify-between items-center text-sm text-gray-700">
                <div>
                    <span class="font-medium">Payment Method:</span> Cash on Delivery
                </div>
                <div class="font-bold text-gray-900">Total: ₱70.00</div>
            </footer>
        </article>

    </section>
</div>
@endsection
