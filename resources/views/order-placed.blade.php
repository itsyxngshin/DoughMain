@extends('components.layouts.none')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-white px-4">
    <div class="max-w-md w-full text-center p-8 bg-white border border-gray-300 shadow-lg rounded-lg">
        <h1 class="text-3xl font-extrabold text-[#4A2E0F] mb-6">Order Placed</h1>

        <!-- Small Check Icon -->
        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-[#4A2E0F] flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
            </svg>
        </div>

        <!-- Large Check Icon (added below the order placed message) -->
        <div class="w-40 h-40 mx-auto mb-6 rounded-full bg-[#4A2E0F] flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32 text-white" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
            </svg>
        </div>

        <!-- Message -->
        <p class="text-[#4A2E0F] text-lg mb-4">Thank you for placing your order!</p>

        <hr class="my-6 border-t border-gray-300">

        <p class="text-sm text-gray-600 mb-6">Go to My Orders for more info.</p>

        <!-- Buttons -->
        <div class="flex justify-center space-x-4">
            <a href="homepage">
                <button class="px-6 py-2 border border-[#4A2E0F] text-[#4A2E0F] rounded-md hover:bg-gray-100">
                    Home
                </button>
            </a>
            <a href="#">
                <button class="px-6 py-2 border bg-[#4A2E0F] text-[#4A2E0F] rounded-md hover:bg-[#3a240f]">
                    My Orders
                </button>
            </a>
        </div>
    </div>
</div>
@endsection
