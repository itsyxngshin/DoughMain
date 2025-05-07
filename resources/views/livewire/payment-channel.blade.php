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
        @livewire('user.modal.order-process', [
                'cartItems' => $cartItems,
                'orderTotal' => $orderTotal,
                'paymentMethods' => $paymentMethods,
            ])
        
        
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Livewire.on('payment-success', () => {
        Swal.fire({
            icon: 'success',
            title: 'Payment Successful',
            text: 'Your order has been placed!',
            confirmButtonColor: '#4A2E0F',
            timer: 6000, // ⏱️ stays for 3 seconds
            timerProgressBar: true,
            showConfirmButton: false, // no need for user to click
        }).then(() => {
            window.location.href = "{{ route('homepage') }}"; // Redirect after confirmation
        });
    });
</script>
@endpush
@endsection