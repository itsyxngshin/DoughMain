@extends('components.layouts.navbar')

@section('content')
<section>
  <div class="container mx-auto px-8 mt-0">

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
    <h1 class="text-center text-4xl font-semibold mt-10 italic">Pastries</h1>
    <h3 class="text-xl font-semibold mt-8 text-center">Cakes</h3>
    <p class="text-gray-600 mb-4 text-center">Indulge in a delightful selection of soft, moist, and flavorful cakes.</p>

    <!-- Divider -->
    <hr class="my-8 border-t-2 border-gray-300">

    <!-- Kodie Bakery -->
    <h4 class="text-lg font-semibold text-center mt-6">Kodie Bakery</h4>
    <div class="grid md:grid-cols-3 gap-6">
      @foreach([
        ['name' => 'Ube Cake', 'img' => 'ube2.png', 'desc' => 'Moist chiffon cake with ube halaya.', 'price' => '₱160.00']
      ] as $cake)
        <div class="searchable-item bg-transparent hover:bg-gray-200 p-5 shadow-lg rounded-lg text-center transition-transform transform hover:scale-105 duration-300">
          <a href="#" class="openModal" data-name="{{ $cake['name'] }}" data-img="{{ asset('storage/' . $cake['img']) }}" data-desc="{{ $cake['desc'] }}" data-price="{{ $cake['price'] }}">
            <img src="{{ asset('storage/' . $cake['img']) }}" alt="{{ $cake['name'] }}" class="w-40 mx-auto transition-transform transform hover:scale-110 duration-300">
          </a>
          <h4 class="font-semibold">{{ $cake['name'] }}</h4>
          <p class="text-gray-500">{{ $cake['desc'] }}</p>
          <p class="text-gray-800 font-bold">{{ $cake['price'] }}</p>
        </div>
      @endforeach
    </div>

    <!-- BJ's Bakery -->
    <h4 class="text-lg font-semibold text-center mt-10">BJ's Bakery</h4>
    <div class="grid md:grid-cols-3 gap-6">
      @foreach([
        ['name' => 'Chiffon Cake', 'img' => 'chiffon.png', 'desc' => 'A buttery and fluffy sponge cake.', 'price' => '₱160.00'],
        ['name' => 'Yema Cake', 'img' => 'yema.png', 'desc' => 'Chiffon cake topped with sweet yema custard.', 'price' => '₱160.00']
      ] as $cake)
        <div class="searchable-item bg-transparent hover:bg-gray-200 p-5 shadow-lg rounded-lg text-center transition-transform transform hover:scale-105 duration-300">
          <a href="#" class="openModal" data-name="{{ $cake['name'] }}" data-img="{{ asset('storage/' . $cake['img']) }}" data-desc="{{ $cake['desc'] }}" data-price="{{ $cake['price'] }}">
            <img src="{{ asset('storage/' . $cake['img']) }}" alt="{{ $cake['name'] }}" class="w-40 mx-auto transition-transform transform hover:scale-110 duration-300">
          </a>
          <h4 class="font-semibold">{{ $cake['name'] }}</h4>
          <p class="text-gray-500">{{ $cake['desc'] }}</p>
          <p class="text-gray-800 font-bold">{{ $cake['price'] }}</p>
        </div>
      @endforeach
    </div>
   <!-- Product Modal -->
<div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
        <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-red-500">✕</button>
        <img id="modalImage" src="" class="w-40 mx-auto mb-3">
        <h2 id="modalName" class="text-xl font-bold text-center"></h2>
        <p id="modalDesc" class="text-gray-600 text-center"></p>
        <p id="modalPrice" class="text-gray-800 font-bold text-center"></p>

        <!-- Quantity & Add to Cart in One Row -->
        <div class="flex items-center justify-between mt-4">
            <!-- Quantity Selector with Plus & Minus -->
            <div class="flex items-center border rounded">
                <button id="decreaseQuantity" class="px-3 py-1 text-gray-800 rounded-l">−</button>
                <input type="number" id="modalQuantity" value="1" min="1" class="w-16 p-1 text-center border-none">
                <button id="increaseQuantity" class="px-3 py-1 text-gray-800 rounded-r">+</button>
            </div>

            <!-- Add to Cart Button (Dark Background) -->
            <a id="addToCartLink" href="#" class="text-white text-center py-2 px-7 rounded"
               style="background-color: #1E1E1E;">Add to Cart</a>
        </div>
    </div>
</div>

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

  function updateCartLink() {
    const quantity = Math.max(1, parseInt(modalQuantity.value) || 1);
    modalQuantity.value = quantity;
    addToCartLink.href = `/cart?name=${encodeURIComponent(modalName.textContent)}&img=${encodeURIComponent(modalImage.src)}&price=${encodeURIComponent(modalPrice.textContent)}&quantity=${quantity}`;
  }

  document.querySelectorAll(".openModal").forEach(button => {
    button.addEventListener("click", function (event) {
      event.preventDefault();
      modalImage.src = this.dataset.img;
      modalName.textContent = this.dataset.name;
      modalDesc.textContent = this.dataset.desc;
      modalPrice.textContent = this.dataset.price;
      modalQuantity.value = 1;
      updateCartLink();
      modal.classList.remove("hidden");
    });
  });

  increaseQuantity.addEventListener("click", () => {
    modalQuantity.value = parseInt(modalQuantity.value) + 1;
    updateCartLink();
  });

  decreaseQuantity.addEventListener("click", () => {
    if (parseInt(modalQuantity.value) > 1) {
      modalQuantity.value = parseInt(modalQuantity.value) - 1;
      updateCartLink();
    }
  });

  modalQuantity.addEventListener("input", updateCartLink);
  closeModal.addEventListener("click", () => modal.classList.add("hidden"));
  modal.addEventListener("click", event => {
    if (event.target === modal) modal.classList.add("hidden");
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Livewire.on('cart-added-success', () => {
        Swal.fire({
            icon: 'success',
            title: 'Added to cart!',
            text: 'Explore more on our variety of baked goods',
            confirmButtonColor: '#4A2E0F',
            timer: 6000, // ⏱️ stays for 3 seconds
            timerProgressBar: true,
            showConfirmButton: false, // no need for user to click
        }).then(() => {
            window.location.href = "{{ route('homepage') }}"; // Redirect after confirmation
        });
    });
</script>
@endpush
@endsection
