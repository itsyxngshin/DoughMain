@extends('components.layouts.navbar')

@section('content')
<div class="flex flex-col md:flex-row pt-20">

    <!-- Sidebar -->
    <aside class="w-full md:w-1/4 h-auto md:h-screen sticky top-0 bg-[#ffffff] p-8 shadow-lg rounded-xl space-y-8 border border-[#ffffff] mb-8 md:mb-0">
        <h2 class="text-2xl font-bold text-[#51331B] border-b pb-3 mb-3">Filters</h2>

        <!-- Sort By -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-[#4C3C2C]">Sort by</h3>
            <div class="flex flex-col space-y-2 text-base text-[#6E4B3B]">
                <label class="inline-flex items-center gap-3 hover:text-[#8E6A4A] cursor-pointer">
                    <input type="radio" name="sort" class="accent-[#D39B6A]" checked>
                    Relevance
                </label>
                <label class="inline-flex items-center gap-3 hover:text-[#8E6A4A] cursor-pointer">
                    <input type="radio" name="sort" class="accent-[#D39B6A]">
                    Distance
                </label>
            </div>
        </div>

        <!-- Quick Filters -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-[#4C3C2C]">Quick Filters</h3>
            <div class="flex flex-col space-y-2 text-base text-[#6E4B3B]">
                <label class="inline-flex items-center gap-3 hover:text-[#8E6A4A] cursor-pointer">
                    <input type="checkbox" class="accent-[#D39B6A]">
                    Ratings 4+
                </label>
                <label class="inline-flex items-center gap-3 hover:text-[#8E6A4A] cursor-pointer">
                    <input type="checkbox" class="accent-[#D39B6A]">
                    Top Products
                </label>
            </div>
        </div>

        <!-- Category filter -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-[#4C3C2C]">Categories</h3>
            <div class="flex flex-col space-y-2 text-base text-[#6E4B3B]">
                <label class="inline-flex items-center gap-3 hover:text-[#8E6A4A] cursor-pointer">
                    <input type="checkbox" class="accent-[#D39B6A]">
                    Cake
                </label>
                <label class="inline-flex items-center gap-3 hover:text-[#8E6A4A] cursor-pointer">
                    <input type="checkbox" class="accent-[#D39B6A]">
                    Bread
                </label>
                <label class="inline-flex items-center gap-3 hover:text-[#8E6A4A] cursor-pointer">
                    <input type="checkbox" class="accent-[#D39B6A]">
                    Cupcake
                </label>
                <label class="inline-flex items-center gap-3 hover:text-[#8E6A4A] cursor-pointer">
                    <input type="checkbox" class="accent-[#D39B6A]">
                    Pies and Tarts
                </label>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="w-full md:w-3/4 p-8 ml-0 md:ml-8" >

    
    @livewire('user.search-products')
    @livewire('user.modal.view-product-from-search')

 

        <!-- Deals Section 
        <div class="mb-6">
            <h2 class="text-2xl font-bold mb-4 text-[#51331B]">Bakery Deals</h2>
            <div class="flex gap-4 overflow-x-auto no-scrollbar pr-4">
                
                <div class="min-w-[250px] p-4 rounded-xl text-white bg-gradient-to-b from-[#D39B6A] to-[#8E6A4A] shadow relative flex-shrink-0">
                    <p class="text-xl font-bold">₱50 off</p>
                    <p class="mt-2">Use code: <span class="bg-white text-black px-2 py-1 rounded font-semibold">BREAD50</span></p>
                </div>

            
                <div class="min-w-[250px] p-4 rounded-xl text-white bg-gradient-to-b from-[#F2D7B6] to-[#bf9877] shadow relative flex-shrink-0">
                    <p class="text-xl font-bold">Buy 1 Get 1</p>
                    <p class="mt-1 text-sm">on Cupcakes</p>
                    <p class="text-xs mt-2">Today only</p>
                </div>

                
                <div class="min-w-[250px] p-4 rounded-xl text-white bg-gradient-to-b from-[#F3C98E] to-[#8e6d4f] shadow relative flex-shrink-0">
                    <p class="text-xl font-bold">Free Pie</p>
                    <p class="mt-1 text-sm">with ₱300+ order</p>
                    <p class="text-xs mt-2">Limited time</p>
                </div>

             
                <div class="min-w-[250px] p-4 rounded-xl text-white bg-gradient-to-b from-[#E1B17B] to-[#7A5A3C] shadow relative flex-shrink-0">
                    <p class="text-xl font-bold">15% off</p>
                    <p class="mt-1 text-sm">on Cakes</p>
                    <p class="text-xs mt-2">Use code: 
                        <span class="bg-white text-black px-2 py-1 rounded font-semibold">SWEET15</span>
                    </p>
                </div>
            </div>
        </div>
-->
        <!-- Products -->
        <h2 class="text-2xl font-bold text-[#51331B]">Products</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
            @foreach ($products as $product)
                @livewire('user.modal.view-product-from-homepage', ['productId' => $product->id], key($product->id))
            @endforeach
        </div>


        <!-- Categories -->
        <h2 class="text-2xl font-bold text-[#51331B] mt-8">Categories</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
            @foreach ($categories as $category)
                <div class="relative bg-cover bg-center rounded-lg shadow-lg flex items-end pl-2 h-32 transition-transform transform hover:scale-105 duration-300"
                    style="background-image: url('{{ asset('storage/' . $category->category_photo) }}');">
                    <a href="{{ route('category', ['id' => $category->id]) }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#51331B]/70 to-transparent rounded-lg"></div>
                        <h3 class="absolute bottom-2 left-5 text-white font-semibold z-10">
                            {{ $category->category_name }}
                        </h3>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Bakeries -->
        <h2 class="text-2xl font-bold text-[#51331B] mt-8">All Bakeries</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
            @foreach ($bakeries as $bakery)
                @if ($bakery->shopLogo) <!-- Check if the shop has a logo -->
                    <div class="relative transition-transform transform hover:scale-105 duration-300">
                        <a href="{{ route('shop.products', ['id' => $bakery->id]) }}">
                        <img src="{{ asset('storage/shop_logos/' . $bakery->shopLogo->logo_path) }}" class="rounded-lg w-full h-56 object-cover transition-transform transform hover:scale-110 duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#51331B]/70 to-transparent rounded-lg"></div> 
                            <h3 class="absolute bottom-2 left-5 text-white font-semibold z-10">
                                {{ $bakery->shop_name }}
                            </h3>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>


        <!-- Testimonials -->
        <section class="mt-12 bg-[#f9f9f9] py-8">
            <h2 class="text-2xl font-bold text-[#51331B] text-center">What Our Customers Are Saying</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                <!-- Testimonial 1 -->
                <div class="p-6 border rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 bg-white">
                    <div class="flex items-center mb-2">
                        <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                    </div>
                    <p class="text-sm italic text-gray-600">"The best pandesal I've ever had! Fresh, soft, and delicious. Highly recommend!"</p>
                    <h4 class="font-semibold mt-4 text-[#51331B]">Maria L.</h4>
                </div>

                <!-- Testimonial 2 -->
                <div class="p-6 border rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 bg-white">
                    <div class="flex items-center mb-2">
                        <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                    </div>
                    <p class="text-sm italic text-gray-600">"I love the variety of cakes here. The ube pandesal is a must-try!"</p>
                    <h4 class="font-semibold mt-4 text-[#51331B]">Jesse B.</h4>
                </div>

                <!-- Testimonial 3 -->
                <div class="p-6 border rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 bg-white">
                    <div class="flex items-center mb-2">
                        <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                    </div>
                    <p class="text-sm italic text-gray-600">"Great service and even better baked goods. I come here every weekend!"</p>
                    <h4 class="font-semibold mt-4 text-[#51331B]">Rachel S.</h4>
                </div>
            </div>
        </section>
    </main>
</div>
@endsection
