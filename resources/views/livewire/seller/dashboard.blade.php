@extends('components.layouts.seller')

@section('Product Management')

@section('content')
<div class="p-6 w-auto overflow-hidden h-screen pt-20">
    <div class="bg-white pb-5 shadow-lg bg-cover mt-3 bg-center bg-no-repeat items-center">
        <h1 class="px-12 pt-6 font-bold text-[#51331b] text-3xl">Dashboard</h1>

        <div class="px-12 pt-3 pb-3">
            <div class="flex gap-3">
                <div class="border flex shadow-md rounded-xl shadow-gray-[10%] w-[30%] h-auto p-6 py-3 items-center gap-20">
                    <div>
                        <p class="font-bold text-[#51331b] text-3xl">Orders</p>
                        <span class="italic text-xs text-gray-500">as of {{ now()->format('m/d/Y') }}</span>
                    </div>
                    <span class="text-4xl font-bold">{{ $totalOrdersLast30Days }}</span>
                </div>
                <div class="border flex shadow-md rounded-xl shadow-gray-[10%] w-[30%] h-auto p-6 py-3 items-center gap-10">
                    <div>
                        <p class="font-bold text-[#51331b] text-3xl">Products</p>
                        <span class="italic text-xs text-gray-500">as of {{ now()->format('m/Y') }}</span>
                    </div>
                    <span class="text-4xl font-bold">{{ $totalProductsThisWeek }}</span>
                </div>

                <div class="border flex shadow-md rounded-xl shadow-gray-[10%] w-[30%] h-auto p-6 py-3 items-center gap-7">
                    <div>
                        <p class="font-bold text-[#51331b] text-2xl">Products Sold</p>
                        <span class="italic text-xs text-gray-500">as of {{ now()->format('m/d/Y') }}</span>
                    </div>
                    <span class="text-4xl font-bold">{{ $totalProductsSold }}</span>
                </div>
                <div class="border flex shadow-md rounded-xl shadow-gray-[10%] w-[30%] h-auto p-6 py-3 items-center gap-5">
                    <div>
                        <p class="font-bold text-[#51331b] text-2xl">Total Revenue</p>
                        @if($shop) <!-- Check if $shop exists -->
                            <span class="italic text-xs text-gray-500">
                                since {{ \Carbon\Carbon::parse($shop->created_at)->format('m/d/Y') }}
                            </span>
                        @else
                            <span class="italic text-xs text-gray-500">Shop not available</span>
                        @endif
                    </div>
                    <span class="text-3xl font-bold">₱{{ number_format($totalRevenue, 2) }}</span>
                </div>

            </div>
        </div>

        <div class="pl-12 pr-12 flex space-x-5 ">
            <div class="card">
                <div class="card-body border rounded-xl w-full border-gray-300 p-6 py-3">
                    <h2 class="font-bold text-xl pb-3 text-[#51331b]">Recent Orders</h2>
                    <table class="table table-striped text-[12px]">
                        <thead>
                            <tr>
                                <th class="p-1">#</th>
                                <th class="p-1">Customer</th>
                                <th class="p-1">Amount</th>
                                <th class="p-1">Status</th>
                                <th class="p-1">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td class="p-1">{{ $loop->iteration }}</td>
                                    <td class="p-1">{{ $order->customer_name ?? 'N/A' }}</td>
                                    <td class="p-1">₱{{ number_format($order->total_amount, 2) }}</td>
                                    <td class="p-1">
                                        <span class="badge
                                            @if($order->status == 'completed') bg-success
                                            @elseif($order->status == 'pending') bg-warning
                                            @elseif($order->status == 'cancelled') bg-danger
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="p-1">{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-body border rounded-xl w-full border-gray-300 p-6 mt-3 py-3">
                    <h2 class="font-bold text-xl pb-3 text-[#51331b]">Reviews</h2>
                    <table class="table text-[12px] table-striped">
                        <thead>
                            <tr>
                                <th class="p-1">#</th>
                                <th class="p-1">Username</th>
                                <th class="p-1">Review</th>
                                <th class="p-1">Rate</th>
                                <th class="p-1">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td class="p-1">{{ $loop->iteration }}</td>
                                    <td class="p-1">{{ $review->user->username ?? 'Anonymous' }}</td>
                                    <td class="p-1">{{ $review->review_text ?? 'No Review' }}</td>
                                    <td class="p-1">
                                        <span class="badge 
                                            @if($review->rating >= 4) bg-success 
                                            @elseif($review->rating >= 3) bg-warning 
                                            @else bg-danger @endif">
                                            {{ $review->rating ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="p-1">{{ \Carbon\Carbon::parse($review->created_at)->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Placeholder for Chart -->
            <div class="card w-[70%] h-auto border border-gray-200 rounded-xl p-6">
                <div class="card-header">
                    <h2 class="font-semibold text-[#51331b]">{{$shop->shop_name}} Sales Chart</h2>
                </div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($monthlySalesLabels),
                datasets: [{
                    label: 'Sales (₱)',
                    data: @json($monthlySalesData),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + value;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

@endsection
