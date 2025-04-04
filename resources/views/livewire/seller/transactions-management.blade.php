@extends('layouts.seller')

@section('Transactions Management')

@section('content')
    <div class="top-0 left-0 w-full h-auto bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center px-0 " >
        <div class="top-0 left-0 w-full h-[60px] bg-white border-b border-gray-200 bg-cover bg-center bg-no-repeat flex items-center px-6 rounded-t-xl">
            <h1 class="text-[#51331b] font-bold text-2xl px-3">BJ Bakery</h1>
        </div> 

        <!--
        <div class="px-12 pt-6 flex gap-10">
            <div class="border shadow-md rounded-xl shadow-gray-[10%] w-auto h-auto p-6 py-9 items-center flex gap-8">
                <p class="font-semibold text-[#51331b] text-xl">Number of Transactions</p>
                <span class="text-4xl font-bold">1</span>
            </div>
            <div class="border shadow-md rounded-xl shadow-gray-[10%] w-auto h-auto p-6 py-9 items-center flex gap-5">
                <p class="font-semibold text-[#51331b] text-xl">Total Amount of Transactions</p>
                <span class="text-4xl font-bold">P 200</span>
            </div>
            <div class="border shadow-md rounded-xl shadow-gray-[10%] w-auto h-auto p-6 py-9 items-center flex gap-5">
                <p class="font-semibold text-[#51331b] text-xl">Total Earnings</p>
                <span class="text-4xl  font-bold">P 170</span>
            </div>
        </div>
-->
        <h1 class="px-12 pt-6 font-bold text-[#51331b] text-3xl">Transactions</h1>
        
        <div class="flex items-center h-[50px] px-12 space-between gap-10 mt-2">
            <!-- Dropdown for Items per Page -->
            <div class="relative flex gap-2 items-center px-6">
                <select name="contents" class="border border-[#51331b] px-2 py-1 rounded-md flex">
                    <option value="1">5</option>
                    <option value="2" selected>10</option>
                    <option value="3">15</option>
                    <option value="4">20</option>
                </select>
                <p class="text-sm text-gray-500">contents per page</p>
            </div>

            <!-- Search Bar -->
            <div class="relative flex">
                <input type="text" placeholder="Search" class="pl-3 pr-3 py-1 text-sm border border-[#51331b] rounded-md">
               
            </div>

            <!-- Dropdown for Categories -->
            <div class="relative flex gap-2 items-center">
                <p class="text-sm text-gray-500 ">Schedule</p>
                <select name="category" class="border border-[#51331b] px-2 py-1 rounded-md flex">
                    <option value="0" >All</option>
                    <option value="1" selected>Today</option>
                    <option value="2">Tomorrow</option>
                    <option value="3">Next Week</option>
                </select>
            </div>

            <!-- Dropdown for filter by 
            <div class="relative flex gap-2 items-center">
                <p class="text-sm text-gray-500 ">Filter by</p>
                <select name="category" class="border border-[#51331b] px-2 py-1 rounded-md flex">
                    <option value="0" selected>-</option>
                    <option value="1" >Status (Completed) </option>
                    <option value="2">Status</option>
                    <option value="3">Next Week</option>
                </select>
            </div>
            -->
            
            
        </div>
            



            <div class="flex px-12 py-2 pb-10 gap-4 flex-grow " style="max-height: 60%">
                <div class="border px-2 py-0 border-gray-300 rounded-xl p-4 flex-1">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b ">
                                <th class="p-2 font-semibold">Transaction ID</th>
                                <th class="p-2 font-semibold">Order Date & Time</th>
                                <th class="p-2 font-semibold">Shop Name</th>
                                <th class="p-2 font-semibold">Customer Name</th>
                                <th class="p-2 font-semibold">Order ID</th>
                                <th class="p-2 font-semibold">Total Amount</th>
                                <th class="p-2 font-semibold">Payment Method</th>
                                <th class="p-2 font-semibold">Status</th>
                                <th class="p-2 font-semibold"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b text-sm text-center">
                                <td class="p-2">00121</td>
                                <td class="p-2">12/28/25 12:09 PM</td>
                                <td class="p-2">Shop Name</td>
                                <td class="p-2">John Doe</td>
                                <td class="p-2">00011001</td>
                                <td class="p-2">200.00</td>
                                <td class="p-2">E-Wallet</td>
                                <td class="p-2 font-semibold">Completed</td>
                                <td class="p-2"> @livewire('seller.modal.view-details')</td>

                            </tr>
                        </tbody>
                    </table>
                  
                </div>
            </div>
        </div>
   



@endsection
