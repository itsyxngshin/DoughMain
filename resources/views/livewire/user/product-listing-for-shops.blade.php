@extends('components.layouts.navbar')

@section('content')

<div class="w-full mx-5"  >
  <div class="w-full mx-auto py-10 px-4">

        <!-- Search Bar -->
        <div class="sticky top-1 py-2 z-50 ml-3 mb-5 mt-3">
            <div class="w-[700px] mx-auto relative">
            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" 
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M21 21l-4.35-4.35m2.85-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="searchInput" 
                placeholder="Search products, categories..." 
                class="w-full p-2.5 pl-10 border border-gray-300 rounded-full focus:outline-none 
                        focus:ring-2 focus:ring-yellow-500 transition-all duration-200">
        </div>
        </div>

        <!-- Bakery Banner with Review Section -->
        <div class="relative ">
            <img src="{{ asset('storage/shop_logos/' . $bakery->shopLogo->logo_path) }}" alt="Bakery Display" class="w-full h-80 object-cover rounded-lg shadow-md">
            <div class="absolute inset-0 bg-black bg-opacity-30 rounded-lg"></div>
            <h1 class="absolute top-10 left-10 text-white text-4xl font-bold">{{ $bakery->shop_name}}</h1>

            <!-- Review Section with Transparent Background -->
             <div>
                
             </div>
            @livewire('user.modal.click-to-see-reviews', ['shopId' => $bakery->id])

                </div>

                    <h1 class="text-center text-4xl font-semibold mt-10 italic">{{$bakery->shop_name}}</h1>
                    <p class="text-gray-600 mb-4 mt-4 text-center">{{$bakery->shop_description}}</p>
                    <div class="relative my-12">
                <div class="border-t border-gray-300"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="bg-white px-4 text-gray-500 text-sm tracking-wide uppercase">Our Selection</span>
                </div>
            </div>

            <div class=" w-full">
                @foreach($categories as $category)
                    @php
                        // Check if the bakery has products in the selected category
                        $hasProducts = $bakery->products()
                            ->where('category_id', $category->id)
                            ->exists();
                    @endphp

                    @if($hasProducts)
                        <!-- Only render Livewire component if the bakery has products in the selected category -->
                        @livewire('user.modal.view-shop-product', ['shopId' => $bakery->id, 'categoryId' => $category->id], key($bakery->id . '-' . $category->id))
                        <div class="my-10 text-center">
                            <span class="inline-block text-gray-400 text-xl tracking-widest">&#10022;&#10022;&#10022;</span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

    
</div>



<script>
document.addEventListener("DOMContentLoaded", function () {
    // Search Functionality
    const searchInput = document.getElementById("searchInput");
    const searchableItems = document.querySelectorAll(".searchable-item");

    searchInput.addEventListener("input", function () {
        const query = searchInput.value.toLowerCase().trim();

        searchableItems.forEach(item => {
            const productName = item.querySelector("h4").textContent.toLowerCase();
            const productDesc = item.querySelector("p").textContent.toLowerCase();

            if (productName.includes(query) || productDesc.includes(query)) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    });

    
});
</script>

@endsection
