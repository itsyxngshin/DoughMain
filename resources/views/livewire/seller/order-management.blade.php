@extends('components.layouts.seller')

@section('content')
<div class="p-6 pt-20 h-screen overflow-hidden">
    <div x-data="{ search: '', firstname: '', lastname: ''}" class="top-0 left-0 w-full mt-3 bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center px-0 " >
        <div class="top-0 left-0 w-full h-[60px] bg-white border-b border-gray-200 bg-cover bg-center bg-no-repeat flex items-center px-6 rounded-t-xl">
            <h1 class="text-[#51331b] font-bold text-2xl px-3">{{$shop->shop_name ?? 'N/A'}}</h1>
        </div> 

        <h1 class="px-12 pt-6 font-bold text-[#51331b] text-3xl">Orders</h1>
        
        <div class="flex items-center h-[50px] px-12 space-between gap-10 mt-2">
            <!-- Dropdown for Items per Page -->
            

            <!-- Search Bar -->
            <div class=" flex">
                <input type="text" x-model="search" placeholder="Search" class="pl-3 pr-3 py-1 text-sm border border-[#51331b] rounded-md">
               
            </div>

            <!-- Dropdown for Categories -->
            <div class=" flex gap-2 items-center" >
                <p class="text-sm text-gray-500 "></p>
                <select name="category" class="border border-[#51331b] px-2 py-1 rounded-md flex">
                    <option value="0" >All</option>
                    <option value="1" selected>Today</option>
                    <option value="2">Tomorrow</option>
                    <option value="3">Next Week</option>
                </select>
            </div>      
        </div>
            <div class="flex px-12 py-2 pb-10 gap-4 flex-grow " style="max-height: 60%">
                <div class="border px-2 py-0 border-gray-300 rounded-xl p-4 flex-1">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b ">
                                <th class="p-2 font-semibold">Order ID</th>
                                <th class="p-2 font-semibold">Customer Name</th>
                                <th class="p-2 font-semibold">Date Ordered</th>
                                <th class="p-2 font-semibold">Time Ordered</th>
                                <th class="p-2 font-semibold">Total Amount</th>
                                <th class="p-2 font-semibold">Payment Method</th>
                                <th class="p-2 font-semibold">Order Status</th>
                                <th class="p-2 font-semibold"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            
                           
                            <tr class="border-b text-sm text-center" 
                                x-data="{
                                    orderId: '{{ $order->id }}',
                                    username: '{{ strtolower($order->user->username) }}',
                                    firstname: '{{ strtolower($order->user->first_name) }}',
                                    lastname: '{{ strtolower($order->user->last_name) }}'
                                }"
                                x-show="search === '' 
                                    || search === orderId.toString()
                                    || username.includes(search.toLowerCase()) 
                                    || firstname.includes(search.toLowerCase()) 
                                    || lastname.includes(search.toLowerCase())">
                                <td class="p-2">{{ $order->id}}</td>
                                <td class="p-2">{{$order->user->first_name ?? 'N/A'}} {{$order->user->last_name ?? 'N/A'}}</td>
                                <td class="p-2">{{ $order->created_at->timezone('Asia/Manila')->format('M d, Y') }}</td>
                                <td class="p-2">{{ $order->created_at->timezone('Asia/Manila')->format('h:i A') }}</td>
                                <td class="p-2">{{$order->total_amount}}</td>
                                <td class="p-2">{{ $order->payment->mode_of_payment->payment_method ?? 'N/A' }}</td>
                                <td class="p-2 font-semibold
                                        @if(strtolower($order->status) == 'pending')
                                            text-yellow-500
                                        @elseif(strtolower($order->status) == 'completed')
                                            text-green-600
                                        @elseif(strtolower($order->status) == 'on process')
                                            text-yellow-600
                                        @elseif(strtolower($order->status) == 'out for delivery')
                                            text-orange-600
                                        @elseif(strtolower($order->status) == 'cancelled')
                                            text-red-600
                                        @else
                                            text-gray-600
                                        @endif
                                    ">
                                        {{ ucfirst($order->status) }}
                                    </td>
                                <td class="p-2"> @livewire('seller.modal.view-order', ['orderId' => $order->id], key($order->id))</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  
                </div>
            </div>
        </div>
   
</div>
   



@endsection
