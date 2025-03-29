@extends('layouts.seller')

@section('Product Management')

@section('content')
    <div class="top-0 left-0 w-full h-auto bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center px-0 " >
        <div class="top-0 left-0 w-full h-[60px] bg-white border-b border-gray-200 bg-cover bg-center bg-no-repeat flex items-center px-6 rounded-t-xl">
            <h1 class="text-[#51331b] font-bold text-3xl px-6">BJ Bakery</h1>
        </div>    

        <div class="flex items-center h-[50px] px-12 space-between gap-10 mt-8">
            <!-- Dropdown for Items per Page -->
            <div class="relative flex gap-2 items-center px-6">
                <button class="border border-[#51331b] px-2 py-1 rounded-md flex items-center">
                    10 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="m8 10.207l3.854-3.853l-.707-.708L8 8.793L4.854 5.646l-.708.708z" clip-rule="evenodd"/></svg>
                </button>
                <p class="text-sm text-gray-500">contents per page</p>
            </div>

            <!-- Search Bar -->
            <div class="relative flex">
                <input type="text" placeholder="Search" class="pl-3 pr-3 py-1 text-sm border border-[#51331b] rounded-md">
               
            </div>

            <!-- Dropdown for Categories -->
            <div class="relative flex gap-2 items-center">
                <p class="text-sm text-gray-500 ">Category</p>
                <button class="border border-[#51331b] px-3 py-1 rounded-md flex items-center">
                    All <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="m8 10.207l3.854-3.853l-.707-.708L8 8.793L4.854 5.646l-.708.708z" clip-rule="evenodd"/></svg>
                </button>
            </div>

                <!-- Add Product Button -->
                <div class="ml-auto">
                    <button class="border border-[#51331b] text-[351331b] px-3 py-1 rounded-md text-sm flex items-center mr-3 hover:bg-[#51331b] hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 13v-1h6V6h1v6h6v1h-6v6h-1v-6z"/></svg> Add Product
                    </button>
                </div>
            
            
            
        </div>
            



            <div class="flex px-12 py-2 pb-10 gap-4 flex-grow " style="max-height: 60%">
                <div class="border px-2 py-0 border-gray-300 rounded-xl p-4 flex-1">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b ">
                                <th class="p-2 font-semibold">Product ID</th>
                                <th class="p-2 font-semibold">Picture</th>
                                <th class="p-2 font-semibold">Name</th>
                                <th class="p-2 font-semibold">Price</th>
                                <th class="p-2 font-semibold">Category</th>
                                <th class="p-2 font-semibold">Available Stocks</th>
                                <th class="p-2 font-semibold">Products Sold</th>
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
                                <td class="p-2"><button class="mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="currentColor" d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z"/></svg></button></td>
                                <td class="p-2"><button class="mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7.616 20q-.672 0-1.144-.472T6 18.385V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zM17 6H7v12.385q0 .269.173.442t.443.173h8.769q.23 0 .423-.192t.192-.424zM9.808 17h1V8h-1zm3.384 0h1V8h-1zM7 6v13z"/></svg></button></td>
                                <td class="p-2"><button class="text-[10px] border p-1 border-[#51331b] rounded hover:bg-[#51331b] hover:text-white">View Product</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
   

<!-- Delete Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-5 rounded shadow-md w-1/3">
        <p>Are you sure you want to delete this product?</p>
        <div class="mt-4 flex justify-end gap-2">
            <button class="bg-gray-300 px-4 py-2 rounded" data-modal-close="deleteModal">Cancel</button>
            <button class="bg-red-500 text-white px-4 py-2 rounded">Delete Product</button>
        </div>
    </div>
</div>

@endsection
