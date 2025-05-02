@extends('components.layouts.navbar')

@section('content')
<section>
  <div class="container mx-auto px-8 mt-0 pt-20">

    <!-- Search Bar -->
    <div class="sticky top-1 py-2 z-50 ml-3 mt-3">
      <div class="w-[700px] mx-auto relative">
        <!-- Search Icon -->
        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-4.35-4.35m2.85-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        
        <!-- Search Input Field -->
        <input type="text" id="searchInput"
               placeholder="Search products, categories..."
               class="w-full p-2.5 pl-10 border border-gray-300 rounded-full focus:outline-none 
                      focus:ring-2 focus:ring-yellow-500 transition-all duration-200">
      </div>
    </div>

    <!-- Cakes Section -->
    <h1 class="text-center text-4xl font-semibold mt-10 italic">{{$category->category_name}}</h1>
    <p class="text-gray-600 mb-4 text-center">{{$category->description}}</p>

    <!-- Divider -->
    <hr class="my-8 border-t-2 border-gray-300">

    <!-- Kodie Bakery -->
@foreach($bakeries as $bakery)
    @php
        // Check if the bakery has products in the selected category
        $hasProducts = $bakery->products()->where('category_id', $category->id)->exists();
    @endphp

    @if($hasProducts)
        <h4 class="text-lg font-semibold text-center mt-6">{{ $bakery->shop_name }}</h4>
        
        @livewire('user.modal.view-produc-from-category', [
            'shopId' => $bakery->id,
            'categoryId' => $category->id
        ], key($bakery->id . '-' . $category->id))
    @endif
@endforeach


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

</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchInput");
  const searchableItems = document.querySelectorAll(".searchable-item");

  searchInput.addEventListener("input", function () {
    const query = searchInput.value.toLowerCase().trim();
    searchableItems.forEach(item => {
      const productName = item.querySelector("h4").textContent.toLowerCase();
      const productDesc = item.querySelector("p").textContent.toLowerCase();
      item.style.display = productName.includes(query) || productDesc.includes(query) ? "block" : "none";
    });
  });


  const reviewModal = document.getElementById("reviewModal");
  const reviewSection = document.getElementById("reviewSection");
  const closeReviewModal = document.getElementById("closeReviewModal");

  reviewSection.addEventListener("click", () => reviewModal.classList.remove("hidden"));
  closeReviewModal.addEventListener("click", () => reviewModal.classList.add("hidden"));
  reviewModal.addEventListener("click", event => {
    if (event.target === reviewModal) reviewModal.classList.add("hidden");
  });
});
</script>
@endsection
