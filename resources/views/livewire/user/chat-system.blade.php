@extends('components.layouts.navbar')

@section('Sellers Chat')

@section('content')
    <div class="top-0 left-0 w-full h-auto bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center px-0 " >
        <div class="top-0 left-0 w-full h-[60px] bg-white border-b border-gray-200 bg-cover bg-center bg-no-repeat flex items-center px-6 rounded-t-xl">
            <h1 class="text-[#51331b] font-bold text-2xl px-3">BJ Bakery</h1>
        </div>  

<!--CHATTT-->
    @livewire('user.chatbox')        
    </div>
   



@endsection
