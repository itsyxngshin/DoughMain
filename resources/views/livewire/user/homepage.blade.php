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
        @foreach ($categories as $category)
            <label class="inline-flex items-center gap-3 hover:text-[#8E6A4A] cursor-pointer">
                <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}" class="accent-[#D39B6A]">
                {{ $category->category_name }}
            </label>
        @endforeach
    </div>
</div>


    </aside>

    <!-- Main Content -->
    <main class="w-full md:w-3/4 p-8 ml-0 md:ml-8" >

    
    @livewire('user.search-products')
    @livewire('user.modal.view-product-from-search')

        <div >
        @if (count($selectedCategories) > 0)
        <h2 class="text-2xl font-bold text-[#51331B]">Filtered Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
            @foreach ($products as $product)
                @livewire('user.modal.view-product-from-homepage', ['productId' => $product->id], key($product->id))
            @endforeach
        </div>
    @else
        {{-- Full homepage layout (products, categories, bakeries, testimonials) --}}
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
                @forelse ($testimonials as $review)
                    <div class="p-6 border rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 bg-white">
                        <p class="text-sm italic ">{{ $review->shop->shop_name ?? 'Secret Shop'}}</p>
                        <div class="flex items-center mt-3">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="text-yellow-400">
                                    {{ $i <= $review->rating ? '★' : '☆' }}
                                </span>
                            @endfor
                        </div>
                        <p class="text-sm italic text-gray-600">"{{ $review->review_text }}"</p>
                        <h4 class="font-semibold mt-4 text-[#51331B]">
                            -{{ $review->user->username ?? 'Anonymous' }}
                        </h4>
                    </div>
                @empty
                    <p class="text-center col-span-full text-gray-500">No reviews yet.</p>
                @endforelse
            </div>
        </section>
    @endif
        </div>

    </main>
</div>
@endsection
