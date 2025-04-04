@extends('layouts.admin')

@section('Bakery Management')

@section('content')
    <div class="top-0 left-0 w-full h-auto bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center px-0 " >
        
        <h1 class="px-12 pt-6 font-bold text-[#51331b] text-3xl">Bakeries</h1>
        <div class="flex items-center h-[50px] px-12 space-between gap-10 mt-2">
            
        <!-- Dropdown for Items per Page -->
            <div class=" flex gap-2 items-center px-6">
                <select name="contents" class="border border-[#51331b] px-2 py-1 rounded-md flex">
                    <option value="1">5</option>
                    <option value="2" selected>10</option>
                    <option value="3">15</option>
                    <option value="4">20</option>
                </select>
                <p class="text-sm text-gray-500">contents per page</p>
            </div>

            <!-- Search Bar -->
            <div class=" flex">
                <input type="text" placeholder="Search" class="pl-3 pr-3 py-1 text-sm border border-[#51331b] rounded-md">
               
            </div>

            <!-- Dropdown for Categories -->
            <div class=" flex gap-2 items-center">
                <p class="text-sm text-gray-500 ">Category</p>
                <select name="category" class="border border-[#51331b] px-2 py-1 rounded-md flex">
                    <option value="" selected>All</option>
                    <option value="1" selected>Bread</option>
                    <option value="2">Pastries</option>
                    <option value="3">Cake</option>
                </select>
            </div>

                <!-- Add Bakery Button -->
                <div class="ml-auto">
                    <button 
                        x-data 
                        @click="window.location.href='{{ route('addproduct') }}'" 
                        class="border border-[#51331b] text-[351331b] px-3 py-1 rounded-md text-sm flex items-center mr-3 hover:bg-[#51331b] hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 13v-1h6V6h1v6h6v1h-6v6h-1v-6z"/></svg> Add Bakery
                    </button>
                </div>
            
            
            
        </div>
            



            <div class="flex px-12 py-2 pb-10 gap-4 flex-grow " style="max-height: 60%">
                <div class="border px-2 py-0 border-gray-300 rounded-xl p-4 flex-1">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b ">
                                <th class="p-2 font-semibold">Bakery ID</th>
                                <th class="p-2 font-semibold">Picture</th>
                                <th class="p-2 font-semibold">Name</th>
                                <th class="p-2 font-semibold">Date Created</th>
                                <th class="p-2 font-semibold">Available Stocks</th>
                                <th class="p-2 font-semibold">Products Sold</th>
                                <th class="p-2 font-semibold">Status</th>
                                <th class="p-2 font-semibold"> </th>
                                <th class="p-2 font-semibold"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b text-sm text-center">
                                <td class="p-2">00121</td>
                                <td class="p-2 items-center"><img src="#" alt="Thumbnail" class="w-12"></td>
                                <td class="p-2">Name</td>
                                <td class="p-2">P 250.00</td>
                                <td class="p-2">T-Shirt</td>
                                <td class="p-2">20</td>
                                <td class="p-2">2</td>

                            <!-- INSERT BUTTON FOR MODALS AND CONNECT THE PAGES-->
                                <td class="p-2"><button class="mt-2" 
                                    x-data 
                                    @click="window.location.href='{{ route('admin.updatebakery') }}'"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="currentColor" d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z"/></svg></button></td>
                                <td class="p-2"></td>
                                <td class="p-2"></td>

                            </tr>
                        </tbody>
                    </table>
                  
                </div>
            </div>
        </div>
   



@endsection
