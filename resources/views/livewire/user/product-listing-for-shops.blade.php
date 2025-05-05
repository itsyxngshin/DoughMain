@extends('components.layouts.navbar')

@section('content')

<div class="w-full px-5 "  >
  <div class="w-full mx-auto mt-10 overflow-y-auto py-10 px-4">

        <!-- Search Bar -->
        
        @livewire('user.search-products')
            @livewire('user.modal.view-product-from-search')

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
