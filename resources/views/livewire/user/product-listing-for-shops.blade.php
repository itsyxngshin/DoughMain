@extends('components.layouts.navbar')

@section('content')
<section>
  <div class="container mx-auto px-8 mt-0">

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
    <div class="relative">
      <img src="{{ asset('storage/' . $bakery->shopLogo->logo_path) }}" alt="Bakery Display" class="w-full h-80 object-cover rounded-lg shadow-md">
      <div class="absolute inset-0 bg-black bg-opacity-30 rounded-lg"></div>
      <h1 class="absolute top-10 left-10 text-white text-4xl font-bold">{{ $bakery->shop_name}}</h1>

      <!-- Review Section with Transparent Background -->
      <div class="absolute bottom-4 left-4 p-3 rounded-lg cursor-pointer bg-transparent" id="reviewSection">
        <div class="flex items-center">
          <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
          <span class="font-semibold text-white ml-2">4/5 stars</span>
        </div>
        <p class="text-black-500 text-xs">Click to see reviews</p>
      </div>
    </div>

    <h1 class="text-center text-4xl font-semibold mt-10 italic">{{$bakery->shop_name}}</h1>
    <p class="text-gray-600 mb-4 mt-4 text-center">{{$bakery->shop_description}}</p>
    <div class="relative my-12">
  <div class="border-t border-gray-300"></div>
  <div class="absolute inset-0 flex items-center justify-center">
    <span class="bg-white px-4 text-gray-500 text-sm tracking-wide uppercase">Our Selection</span>
  </div>
</div>


    @foreach($categories as $category)
    
            <div class="my-10 text-center">
                <span class="inline-block text-gray-400 text-xl tracking-widest">&#10022;&#10022;&#10022;</span>
            </div>

        @livewire('user.modal.view-shop-product', ['shopId' => $bakery->id, 'categoryId' => $category->id], key($bakery->id . '-' . $category->id))
    @endforeach







  </div>
</section>

<!-- Product Modal -->

<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
        <button id="closeReviewModal" class="absolute top-2 right-2 text-gray-500 hover:text-red-500">✕</button>

        <h2 class="text-xl font-semibold text-center">Customer Reviews</h2>

        <!-- Reviews Content -->
        <div class="mt-4">
            <div class="flex items-center">
                <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                <p class="text-gray-700 text-sm ml-2">“Great cakes! My favorite is the Yema cake. It's so moist and fluffy.” – Sarah</p>
            </div>
            <div class="flex items-center mt-4">
                <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9734;&#9734;</span>
                <p class="text-gray-700 text-sm ml-2">“The bread is soft, but I think the pies could use a little more flavor.” – John</p>
            </div>
            <div class="flex items-center mt-4">
                <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9734;&#9734;</span>
                <p class="text-gray-700 text-sm ml-2">“Love the fresh taste of the pastries! Will definitely return.” – Emma</p>
            </div>
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

    // Modal Elements
    const modal = document.getElementById("productModal");
    const closeModal = document.getElementById("closeModal");
    const modalImage = document.getElementById("modalImage");
    const modalName = document.getElementById("modalName");
    const modalDesc = document.getElementById("modalDesc");
    const modalPrice = document.getElementById("modalPrice");
    const modalQuantity = document.getElementById("modalQuantity");
    const addToCartLink = document.getElementById("addToCartLink");
    const decreaseQuantity = document.getElementById("decreaseQuantity");
    const increaseQuantity = document.getElementById("increaseQuantity");

    

    // Review Modal Elements
    const reviewModal = document.getElementById("reviewModal");
    const reviewSection = document.getElementById("reviewSection");
    const closeReviewModal = document.getElementById("closeReviewModal");

    // Open Review Modal Event
    reviewSection.addEventListener("click", function () {
        reviewModal.classList.remove("hidden");
    });

    // Close Review Modal
    closeReviewModal.addEventListener("click", function () {
        reviewModal.classList.add("hidden");
    });

    // Close Review Modal When Clicking Outside of It
    reviewModal.addEventListener("click", function (event) {
        if (event.target === reviewModal) {
            reviewModal.classList.add("hidden");
        }
    });
});
</script>

@endsection
