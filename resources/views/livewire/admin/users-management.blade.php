@extends('components.layouts.admin')

@section('title', 'Users Management')

@section('content')
    <div  x-data="{ search: '', firstname: '', lastname: ''}" class="top-0 left-0 w-full h-auto bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center px-0 " >
        

        <h1 class="px-12 pt-6 font-bold text-[#51331b] text-3xl">Users</h1>
        
        <div class="flex items-center h-[50px] px-12 space-between gap-10 mt-2">
            

            <!-- Search Bar -->
            <div class=" flex">
                <input type="text" x-model="search" placeholder="Search" class="pl-3 pr-3 py-1 text-sm border border-[#51331b] rounded-md">
               
            </div>

            
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
                                @livewire('admin.modal.view-user', ['userId' => $user->id], key($user->id))
                                </td>
                           
                            </tr>
                             @endforeach
                        </tbody>
                    </table>
                  
                </div>
            </div>
        </div>
   



@endsection
