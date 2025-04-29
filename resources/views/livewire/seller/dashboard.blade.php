@extends('components.layouts.seller')

@section('Product Management')

@section('content')
<div class="top-0 left-0 w-auto h-auto bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center" >
          
    <h1 class="px-12 pt-6 font-bold text-[#51331b] text-3xl">Dashboard</h1>
    
    <div class="px-12 pt-3 pb-3">
        <div class="flex gap-3">
            <div class="border flex shadow-md rounded-xl shadow-gray-[10%] w-[30%] h-auto p-6 py-3 items-center gap-20">
                <div class="">  
                    <p class="font-bold text-[#51331b] text-3xl ">Orders</p>
                    <span class="italic text-xs text-gray-500">as of {{ now()->format('m/d/Y') }}</span>
                    
                </div>
                <span class="text-4xl font-bold">{{ $totalOrdersLast30Days }}</span>
            </div>
            <div class="border flex shadow-md rounded-xl shadow-gray-[10%] w-[30%] h-auto p-6 py-3 items-center gap-10">
                <div class="">  
                    <p class="font-bold text-[#51331b] text-3xl ">Products</p>
                    <span class="italic text-xs text-gray-500">as of {{ now()->format('m/Y') }}</span>
                    
                </div>
                <span class="text-4xl font-bold">{{ $totalProductsThisWeek }}</span>
            </div>
            
            
            <div class="border flex shadow-md rounded-xl shadow-gray-[10%] w-[30%] h-auto p-6 py-3 items-center gap-5">
                <div class="">  
                    <p class="font-bold text-[#51331b] text-3xl ">Products Sold</p>
                    <span class="italic text-xs text-gray-500">as of {{ now()->format('m/Y') }}</span>
                    
                </div>
                <span class="text-4xl font-bold">{{ $totalProductsSold }}</span>
            </div>
            <div class="border flex shadow-md rounded-xl shadow-gray-[10%] w-[30%] h-auto p-6 py-3 items-center gap-5">
                <div class="">  
                    <p class="font-bold text-[#51331b] text-3xl ">Total Revenue</p>
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
    
    <div class="pl-12 pr-12  pb-6 flex gap-3 grid-col-[30%_100%]">
        
            <div class="card">
                <div class="card-body border rounded-xl w-full border-gray-300 p-6 py-3">
                    <h2 class="font-bold text-xl pb-3">Recent Orders</h2>
                    <table class="table table-striped text-[12px]">
                        <thead>
                            <tr>
                                <th class="p-1">#</th>
                                <th class="p-1">Customer</th>
                                <th class="p-1">Amount</th>
                                <th class="p-1">Status</th>
                                <th class="p-1" >Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-1">1</td>
                                <td class="p-1">John Doe</td>
                                <td class="p-1">$120.00</td>
                                <td class="p-1"><span class="badge bg-success">Completed</span></td>
                                <td class="p-1">2025-03-12</td>
                            </tr>
                            <tr>
                                <td class="p-1">2</td>
                                <td class="p-1">Jane Smith</td>
                                <td class="p-1">$80.00</td>
                                <td class="p-1"><span class="badge bg-warning">Pending</span></td>
                                <td class="p-1">2025-03-11</td>
                            </tr>
                            <tr>
                                <td class="p-1">3</td>
                                <td class="p-1">Michael Brown</td>
                                <td class="p-1">$150.00</td>
                                <td class="p-1"><span class="badge bg-danger">Cancelled</span></td>
                                <td class="p-1">2025-03-10</td>
                            </tr>
                        </tbody>
                    </table>
                </div> 

                <div class="card-body border rounded-xl w-full border-gray-300 p-6 mt-3 py-3">
                    <h2 class="font-bold text-xl pb-3">Completed Orders</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>$120.00</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td>2025-03-12</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jane Smith</td>
                                <td>$80.00</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>2025-03-11</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Michael Brown</td>
                                <td>$150.00</td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                                <td>2025-03-10</td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
            </div>

            
        

        <!-- Placeholder for Chart -->
        <div class="card w-full h-auto border border-gray-200 rounded-xl p-6">
                <div class="card-header">
                    Sales Chart
                </div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
                
    </div>




            
</div>







        <!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Sales ($)',
                data: [5000, 7000, 8000, 9000, 11000, 13000],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }]
        }
    });
</script>
@endsection