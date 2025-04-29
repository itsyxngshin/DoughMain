@extends('components.layouts.admin')

@section('title', 'Users Management')

@section('content')
    <div  x-data="{ search: '', firstname: '', lastname: ''}" class="top-0 left-0 w-full h-auto bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center px-0 " >
        

        <h1 class="px-12 pt-6 font-bold text-[#51331b] text-3xl">Users</h1>
        
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
                <input type="text" x-model="search" placeholder="Search" class="pl-3 pr-3 py-1 text-sm border border-[#51331b] rounded-md">
               
            </div>

            <!-- Dropdown for Categories
            <div class="relative flex gap-2 items-center">
                <p class="text-sm text-gray-500 ">Schedule</p>
                <select name="category" class="border border-[#51331b] px-2 py-1 rounded-md flex">
                    <option value="0" >All</option>
                    <option value="1" selected>Today</option>
                    <option value="2">Tomorrow</option>
                    <option value="3">Next Week</option>
                </select>
            </div>

            
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
                                <th class="p-2 font-semibold">User ID</th>
                                <th class="p-2 font-semibold">Username</th>
                                <th class="p-2 font-semibold">Full Name</th>
                                <th class="p-2 font-semibold">Started since</th>
                                <th class="p-2 font-semibold"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                           
                            <tr class="border-b text-sm text-center"
                            x-data="{
                                    username: '{{ strtolower($user->username) }}',
                                    firstname: '{{ strtolower($user->first_name) }}',
                                    lastname: '{{ strtolower($user->last_name) }}'
                                }"
                                x-show="search === '' 
                                    || username.includes(search.toLowerCase()) 
                                    || firstname.includes(search.toLowerCase()) 
                                    || lastname.includes(search.toLowerCase())">
                                <td class="p-2">{{$user->id}}</td>
                                <td class="p-2">{{$user->username}}</td>
                                <td class="p-2">{{$user->first_name}} {{$user->last_name}}</td>
                                <td class="p-2">{{$user->created_at}}</td>
                                <td class="p-2">
                                    <button class="mt-2" 
                                        x-data 
                                        @click="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                                            <path fill="currentColor" d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z"/>
                                        </svg>
                                    </button>
                                </td>
                               
                                <td class="p-2">
                                    <button @click="open = true" class="mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M7.616 20q-.672 0-1.144-.472T6 18.385V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zM17 6H7v12.385q0 .269.173.442t.443.173h8.769q.23 0 .423-.192t.192-.424zM9.808 17h1V8h-1zm3.384 0h1V8h-1zM7 6v13z"/>
                                        </svg>
                                    </button>
                                </td>
                           
                            </tr>
                             @endforeach
                        </tbody>
                    </table>
                  
                </div>
            </div>
        </div>
   



@endsection
