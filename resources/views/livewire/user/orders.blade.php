@extends('components.layouts.navbar')

@section('content')
<div class="w-full h-screen p-6">
    <div class="max-w-6xl mt-10 h-screen mx-auto py-10 px-4">
        <h2 class="text-3xl font-bold mb-8 flex items-center text-[#51331b]">
                <svg class="w-7 h-7 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h18v18H3V3z" />
                </svg>
                My Orders
            </h2>
            @forelse($orders as $order)
                <article class="bg-white shadow rounded-lg mb-3">
                    <!-- Header -->
                    <header class="flex justify-between items-center px-6 py-4 border-b text-sm text-gray-600">
                        <div>
                            <strong>{{ $order->transaction_id }}</strong>
                            <span class="ml-2 text-xs text-gray-400">{{ $order->created_at->format('M d, Y - h:i A') }}</span>
                        </div>
                        <span class="font-semibold 
                            @if($order->status === 'Completed') text-green-600 
                            @elseif($order->status === 'Pending') text-yellow-600 
                            @else text-blue-600 
                            @endif">
                            {{ $order->status }}
                        </span>
                    </header>

                    <!-- One Item Preview -->
                    @php
                        $item = $order->orderItems->first();
                    @endphp
                    @if($item)
                    <div class="px-6 py-4 flex justify-between items-center">
                        <div class="flex items-center space-x-4 w-2/5">
                            <img src="{{ asset('storage/' . $item->product->product_image) }}" alt="{{ $item->product->product_name }}" class="w-12 h-12 rounded object-cover">
                            <span class="font-medium text-gray-800">{{ $item->product->product_name }}</span>
                        </div>
                        <div class="w-1/5 text-right text-gray-500">
                            ₱{{ number_format($item->quantity * $item->product->product_price, 2) }}
                        </div>

                        <div class="w-1/5 text-center text-gray-700">{{ $item->quantity }}</div>
                        <div class="w-1/5 text-right text-gray-500 ">₱{{ number_format($item->subtotal, 2) }}</div>
                    </div>
                    @endif

                    <!-- Footer -->
                    <footer class="px-6 py-4 border-t flex justify-between items-center text-sm text-gray-700">
                        <div>
                            <span class="font-medium">Payment Method:</span> {{-- $order->payment_method --}}
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="font-bold text-gray-900">Total: ₱{{ number_format($order->total_amount, 2) }}</span>

                            @if($order->status === 'Completed')
                                @livewire('user.modal.rate-order', ['orderId' => $order->id], key($order->id))
                            @endif
                        </div>
                    </footer>
                </article>
            @empty
                <p class="text-center text-gray-500">You have no orders yet.</p>
            @endforelse
    </div>
</div>
@endsection