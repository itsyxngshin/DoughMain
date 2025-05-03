@extends('components.layouts.admin')

@section('content')
<div class="top-0 left-0 w-auto h-auto bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center" >
          
          <h1 class="px-12 pt-6 font-bold text-[#51331b] text-3xl">Dashboard</h1>
          
          <div class="px-12 py-6">
              <div class="flex gap-3">
                  <div class="border shadow-md rounded-xl shadow-gray-[10%] w-[35%] h-auto p-6 py-3 items-center gap-8">
                      <p class="font-semibold text-[#51331b] text-xl">Bakeries</p>
                      <span class="text-4xl  font-bold">{{ $totalShops }}</span>
                  </div>
                  <div class="border shadow-md rounded-xl shadow-gray-[10%] w-[35%] h-auto p-6 py-3 items-center gap-8">
                      <p class="font-semibold text-[#51331b] text-xl">Users</p>
                      <span class="text-4xl font-bold">{{ $totalUsers}}</span>
                  </div>
                  <div class="border shadow-md rounded-xl shadow-gray-[10%] w-[35%] h-auto p-6 py-3 items-center gap-8">
                      <p class="font-semibold text-[#51331b] text-xl">Monthly Orders</p>
                      <span class="text-4xl font-bold">{{ $monthlyOrders }}</span>
                  </div>
                  
              </div>
          </div>
          
          <div class="pl-12 pr-12  pb-6 flex gap-3 grid-col-[30%_100%]">
              
                  <div class="card">
                  <div class="card-body border rounded-xl w-full border-gray-300 p-6 py-3">
                    <h2 class="font-bold text-xl pb-3">Top Shops</h2>
                    <table class="table table-striped text-[12px]">
                        <thead>
                            <tr>
                                <th class="px-3 py-1">#</th>
                                <th class="px-3 py-1">Shop</th>
                                <th class="px-3">Orders</th>
                                <th class="px-3 p-1">Avg. Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topShops as $index => $shopData)
                                <tr>
                                    <td class="px-3 py-1">{{ $index + 1 }}</td>
                                    <td class="px-3 py-1">{{ $shopData->shop->shop_name ?? 'Unknown' }}</td>
                                    <td class="px-3 py-1">{{ $shopData->total_orders }}</td>
                                    <td class="px-3 p-1">
                                        {{ number_format($shopData->average_rating ?? 0) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

      
                      <div class="card-body border rounded-xl w-full border-gray-300 p-6 mt-4 py-3">
                          <h2 class="font-bold text-xl pb-3">Top Users</h2>
                          <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th class="p-1">#</th>
                                      <th class="p-1">Username</th>
                                      <th class="p-1">Orders</th>
                                      <th class="p-1">Date</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($topUsers as $index => $user)
                                        <tr>
                                            <td class="p-1">{{ $index + 1 }}</td>
                                            <td class="p-1">{{ $user->user->username ?? 'N/A' }}</td>
                                            <td class="p-1">{{ $user->total_orders }}</td> 
                                            <td class="p-1">{{ \Carbon\Carbon::parse($user->last_order_date)->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                          </table>
                      </div> 
                  </div>

              <!-- Placeholder for Chart -->
                <div class="card w-full h-auto border border-gray-200 rounded-xl p-6">
                    <div class="card-header">
                        DoughMain Performance Chart
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
                    labels: @json($allMonths),  // Array of month names
                    datasets: [{
                        label: 'Sales ($)',
                        data: @json($orders),  // Array of orders 
                        backgroundColor: 'rgba(156, 109, 66, 0.2)',
                        borderColor: '#51331b',
                        borderWidth: 2
                    }]
                }
            });
        </script>
@endsection
