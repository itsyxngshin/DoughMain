@extends('components.layouts.admin')

@section('Bakery Management')

@section('content')
    <div x-data="{ search: ''}" class="top-0 left-0 w-full h-auto bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center px-0 " >
        
        <h1 class="px-12 pt-6 font-bold text-[#51331b] text-3xl">Bakeries</h1>
        <div  class="flex items-center h-[50px] px-12 space-between gap-10 mt-2">
            
        

            <!-- Search Bar -->
            <div class=" flex">
                <input type="text" x-model="search" placeholder="Search" class="pl-3 pr-3 py-1 text-sm border border-[#51331b] rounded-md">
               
            </div>

            <!-- Dropdown for Categories
            <div class=" flex gap-2 items-center">
                <p class="text-sm text-gray-500 ">Category</p>
                <select name="category" class="border border-[#51331b] px-2 py-1 rounded-md flex">
                    <option value="" selected>All</option>
                    <option value="1" selected>Bread</option>
                    <option value="2">Pastries</option>
                    <option value="3">Cake</option>
                </select>
            </div>
-->
            
            
        </div>
            



            <div class="flex px-12 py-2 pb-10 gap-4 flex-grow " style="max-height: 60%">
                <div class="border px-2 py-0 border-gray-300 rounded-xl p-4 flex-1">
                    <table class="w-full border-collapse">
                        <thead>
                           
                            <tr class="border-b ">
                                <th class="p-2 font-semibold">Bakery ID</th>
                                <th class="p-2 font-semibold">Profile Picture</th>
                                <th class="p-2 font-semibold">Bakery Name</th>
                                <th class="p-2 font-semibold">Started since</th>
                                <th class="p-2 font-semibold"> </th>
                                <th class="p-2 font-semibold"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shops as $shop)
                             @php
                                $shopName = strtolower($shop->shop_name);
                            @endphp
                            <tr class="border-b text-sm text-center" x-show="(search === '' || '{{ $shopName }}'.includes(search.toLowerCase()))">
                                <td class="p-2">{{$shop->id}}</td>
                                <td class="p-2 items-center"><img src="{{ asset('storage/shop_logos/' . $shop->shopLogo->logo_path) }}" alt="{{$shop->shopLogo->logo_path}}" class="w-20 h-20 rounded object-cover m-auto"></td>
                                <td class="p-2">{{$shop->shop_name}}</td>
                                <td class="p-2">{{$shop->created_at}}</td>
                               
                            
                            <!-- INSERT BUTTON FOR MODALS AND CONNECT THE PAGES-->
                                <td class="p-2"> @livewire('admin.modal.view-bakery', ['shopId' => $shop->id], key($shop->id))</td>
                                
                                <!--<td class="p-2">
                                    livewire('admin.modal.delete-bakery', ['shopId' => $shop->id], key($shop->id))
                                </td>
                                -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  
                </div>
            </div>
        </div>
   



@endsection
