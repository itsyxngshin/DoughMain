@extends('layouts.seller')

@section('Sellers Chat')

@section('content')
    <div class="top-0 left-0 w-full h-auto bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center px-0 " >
        <div class="top-0 left-0 w-full h-[60px] bg-white border-b border-gray-200 bg-cover bg-center bg-no-repeat flex items-center px-6 rounded-t-xl">
            <h1 class="text-[#51331b] font-bold text-2xl px-3">BJ Bakery</h1>
        </div> 

<!--CHATTT-->
        <div class="px-12 pt-6 pb-8">
            <div class="grid grid-cols-[30%_auto] gap-5">
                
                <!-- Column 1 -->
                <div class=" py-0 gap-4">
            
                    <h1 class=" font-bold text-[#51331b] text-3xl">Chats</h1>
                    <div class=" flex gap-3 pt-6 hidden md:flex">
                        <!--Search box-->
                        <input type="text" placeholder="Search" class="pl-3 w-[50%] pr-3 py-1 text-sm border border-[#51331b] rounded-md">
                            <!-- Dropdown for Categories -->
                                <div class=" items-center ">
                                    <select name="category" class="border border-[#51331b] w-[50%] px-2 py-1 rounded-md flex">
                                        <option value="0" selected>All</option>
                                        <option value="1">Today</option>
                                        <option value="2">Tomorrow</option>
                                        <option value="3">Next Week</option>
                                    </select>
                                </div>
                    </div>
                    
                    
                    <div class="pt-3">
                        <div class="rounded-md flex hover:bg-gray-300 w-full h-[80px] bg-white">
                            <img src="{{ asset('storage/logo2.png') }}" alt="" class="w-[25%]">

                            <div class="p-4 pl-0">
                                <span class="font-semibold">Name of user</span>
                                <p class="font-light text-[15px] text-gray-300 pl-3">message</p>
                            </div>
                        </div>
                        <div class="rounded-md flex hover:bg-gray-300 w-full h-[80px] bg-white">
                            <img src="{{ asset('storage/logo2.png') }}" alt="" class="w-[25%]">

                            <div class="p-4 pl-0">
                                <span class="font-semibold">Name of user</span>
                                <p class="font-light text-[15px] text-gray-300 pl-3">message</p>
                            </div>
                        </div>
                    </div>         
                
                    
                </div>   
                
                <!--column 2-->
                <div>

                    <div class="rounded-xl w-full h-[500px] bg-white border border-gray-200">
                        <div class="w-full h-[10%] border-b border-gray-300 flex pl-3 items-center">
                            <img src="{{ asset('storage/logo2.png') }}" alt="" class="w-[6%] p3-3">
                            <span class="font-semibold text-md pl-3">Name of User</span>
                        </div>
                        <div class="bg-gray-200 w-full h-[80%]">
                            <div class="flex pl-3 ">
                                <img src="{{ asset('storage/logo2.png') }}" alt="" class="w-[6%]">
                            </div>
                        </div>
                        <div>
                            <div class="w-full h-full flex gap-4 pl-3 py-2 pr-3 items-center">
                                <input type="text" class="w-[80%] p-1 border border-gray-300 bg-gray-200 rounded-2xl pl-3 placeholder:italic focus:bg-white" placeholder="Type message...">
                                <button><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14L21 3m0 0l-6.5 18a.55.55 0 0 1-1 0L10 14l-7-3.5a.55.55 0 0 1 0-1z"/></svg></button>
                                <button> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024"><path fill="currentColor" d="M172.72 1007.632c-43.408 0-85.085-17.965-118.301-51.213c-73.648-73.888-73.648-194.063-.017-267.903L628.674 78.692c89.6-89.744 226.848-81.68 327.008 18.608c44.88 44.96 70.064 109.776 69.12 177.904c-.945 67.409-27.28 131.92-72.289 177.008L518.497 914.26c-12.08 12.945-32.336 13.536-45.231 1.393c-12.864-12.16-13.488-32.448-1.36-45.345l434.672-462.752c34-34.064 53.504-82.385 54.223-133.249c.72-50.895-17.664-98.88-50.368-131.664c-61.44-61.568-161.473-93.808-235.841-19.264L100.336 733.203c-49.376 49.503-49.36 129.008-.64 177.855c22.847 22.864 49.967 34 78.847 32.255c28.576-1.744 57.952-16.4 82.72-41.232L718.19 415.745c16.56-16.592 49.84-57.264 15.968-91.216c-19.184-19.216-32.656-18.032-37.087-17.664c-12.656 1.12-27.44 9.872-42.784 25.264l-343.92 365.776c-12.144 12.912-32.416 13.536-45.233 1.36c-12.88-12.128-13.472-32.448-1.36-45.312L608.32 287.489c27.088-27.216 54.784-41.968 82.976-44.496c22-1.953 54.72 2.736 88.096 36.208c49.536 49.631 43.376 122.432-15.28 181.216L307.184 946.72c-36.48 36.608-80.529 57.872-124.721 60.591c-3.248.224-6.496.32-9.744.32z"/></svg></button>
                                <button><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 17.5c2.33 0 4.3-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5M8.5 11A1.5 1.5 0 0 0 10 9.5A1.5 1.5 0 0 0 8.5 8A1.5 1.5 0 0 0 7 9.5A1.5 1.5 0 0 0 8.5 11m7 0A1.5 1.5 0 0 0 17 9.5A1.5 1.5 0 0 0 15.5 8A1.5 1.5 0 0 0 14 9.5a1.5 1.5 0 0 0 1.5 1.5M12 20a8 8 0 0 1-8-8a8 8 0 0 1 8-8a8 8 0 0 1 8 8a8 8 0 0 1-8 8m0-18C6.47 2 2 6.5 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2"/></svg></button>

                            </div> 
                        </div>
                    </div>
                    
                </div>
            </div>

            

             
                
        
            
        </div>
        

            

           
            
        
            
    </div>
   



@endsection
