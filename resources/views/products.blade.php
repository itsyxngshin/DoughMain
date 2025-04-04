@extends('layouts.navbar')

@section('content')
<section>
  <div class="container mx-auto px-8 mt-0">

    <!-- Search Bar -->
    <div class="sticky top-1 py-2 z-50 ml-3">
      <div class="max-w-lg mx-auto ml-11 relative">  
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

    <!-- Bakery Banner -->
    <div class="relative">
      <img src="{{ asset('storage/image3.jpg') }}" alt="Bakery Display" class="w-full h-80 object-cover rounded-lg shadow-md">
      <h1 class="absolute top-10 left-10 text-white text-4xl font-bold">BJ's Bakery</h1>
    </div>

    <h1 class="text-center text-4xl font-semibold mt-10 italic">Pastries</h1>

    <!-- Cakes Section -->
    <h3 class="text-xl font-semibold mt-8 text-center">Cakes</h3>
    <p class="text-gray-600 mb-4 text-center">Indulge in a delightful selection of soft, moist, and flavorful cakes.</p>
    
    <div class="grid md:grid-cols-3 gap-6">
      @foreach([
        ['name' => 'Chiffon Cake', 'img' => 'chiffon.png', 'desc' => 'A buttery and fluffy sponge cake.', 'price' => '₱160.00'],
        ['name' => 'Yema Cake', 'img' => 'yema.png', 'desc' => 'Chiffon cake topped with sweet yema custard.', 'price' => '₱160.00'],
        ['name' => 'Ube Cake', 'img' => 'ube2.png', 'desc' => 'Moist chiffon cake with ube halaya.', 'price' => '₱160.00']
      ] as $cake)
        <div class="searchable-item bg-white p-5 shadow-lg rounded-lg text-center transition-transform transform hover:scale-105 duration-300">
          <a href="#" class="openModal" data-name="{{ $cake['name'] }}" data-img="{{ asset('storage/' . $cake['img']) }}" data-desc="{{ $cake['desc'] }}" data-price="{{ $cake['price'] }}">
            <img src="{{ asset('storage/' . $cake['img']) }}" alt="{{ $cake['name'] }}" class="w-40 mx-auto transition-transform transform hover:scale-110 duration-300">
          </a>
          <h4 class="font-semibold">{{ $cake['name'] }}</h4>
          <p class="text-gray-500">{{ $cake['desc'] }}</p>
          <p class="text-gray-800 font-bold">{{ $cake['price'] }}</p>
        </div>
      @endforeach
    </div>

    <!-- Breads Section -->
    <h3 class="text-xl font-semibold mt-10 text-center">Breads</h3>
    <p class="text-gray-600 mb-4 text-center">Classic Filipino breads, from soft and fluffy rolls to sweet and savory treats.</p>

    <div class="grid md:grid-cols-3 gap-6">
      @foreach([
        ['name' => 'Spanish Bread', 'img' => 'spanish.png', 'desc' => 'A soft, rolled bread filled with a sweet, buttery mixture.', 'price' => '₱5.00'],
        ['name' => 'Kababayan', 'img' => 'kababayan.webp', 'desc' => 'A cupcake-shaped Filipino bread that is slightly sweet and buttery.', 'price' => '₱5.00'],
        ['name' => 'Monay', 'img' => 'monay.png', 'desc' => 'Dense and chewy bread with a sweet taste.', 'price' => '₱5.00']
      ] as $bread)
        <div class="searchable-item bg-white p-5 shadow-lg rounded-lg text-center transition-transform transform hover:scale-105 duration-300">
          <a href="#" class="openModal" data-name="{{ $bread['name'] }}" data-img="{{ asset('storage/' . $bread['img']) }}" data-desc="{{ $bread['desc'] }}" data-price="{{ $bread['price'] }}">
            <img src="{{ asset('storage/' . $bread['img']) }}" alt="{{ $bread['name'] }}" class="w-32 mx-auto transition-transform transform hover:scale-110 duration-300">
          </a>
          <h4 class="font-semibold">{{ $bread['name'] }}</h4>
          <p class="text-gray-500">{{ $bread['desc'] }}</p>
          <p class="text-gray-800 font-bold">{{ $bread['price'] }}</p>
        </div>
      @endforeach
    </div>

    <!-- Pies and Tarts Section -->
<h3 class="text-xl font-semibold mt-10 text-center">Pies and Tarts</h3>
<p class="text-gray-600 mb-4 text-center">Delicious Filipino pies and tarts with rich fillings.</p>

<div class="grid md:grid-cols-3 gap-6">
  @foreach([
    ['name' => 'Buko Pie', 'img' => 'buko.png', 'desc' => 'Flaky pastry filled with young coconut.', 'price' => '₱120.00'],
    ['name' => 'Pineapple Pie', 'img' => 'pine.png', 'desc' => 'Sweet pie with caramelized pineapple.', 'price' => '₱120.00'],
    ['name' => 'Egg Pie', 'img' => 'egg.png', 'desc' => 'Creamy custard pie with a crisp crust.', 'price' => '₱120.00']
  ] as $pie)
    <div class="searchable-item bg-white p-5 shadow-lg rounded-lg text-center transition-transform transform hover:scale-105 duration-300">
      <a href="#" class="openModal" data-name="{{ $pie['name'] }}" data-img="{{ asset('storage/' . $pie['img']) }}" data-desc="{{ $pie['desc'] }}" data-price="{{ $pie['price'] }}">
        <img src="{{ asset('storage/' . $pie['img']) }}" alt="{{ $pie['name'] }}" class="w-40 mx-auto transition-transform transform hover:scale-110 duration-300">
      </a>
      <h4 class="font-semibold">{{ $pie['name'] }}</h4>
      <p class="text-gray-500">{{ $pie['desc'] }}</p>
      <p class="text-gray-800 font-bold">{{ $pie['price'] }}</p>
    </div>
  @endforeach
</div>
    
  </div>
</section>

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

    // Open Modal Event
    document.querySelectorAll(".openModal").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            modalImage.src = this.dataset.img;
            modalName.textContent = this.dataset.name;
            modalDesc.textContent = this.dataset.desc;
            modalPrice.textContent = this.dataset.price;
            modalQuantity.value = 1; // Default quantity is 1

            updateCartLink();
            modal.classList.remove("hidden");
        });
    });

    // Update Cart Link When Quantity Changes
    function updateCartLink() {
        let quantity = Math.max(1, parseInt(modalQuantity.value) || 1);
        modalQuantity.value = quantity; // Prevent invalid values

        addToCartLink.href = `/cart?name=${encodeURIComponent(modalName.textContent)}&img=${encodeURIComponent(modalImage.src)}&price=${encodeURIComponent(modalPrice.textContent)}&quantity=${quantity}`;
    }

    modalQuantity.addEventListener("input", updateCartLink);

    // Increase Quantity
    increaseQuantity.addEventListener("click", function () {
        modalQuantity.value = parseInt(modalQuantity.value) + 1;
        updateCartLink();
    });

    // Decrease Quantity (Minimum 1)
    decreaseQuantity.addEventListener("click", function () {
        if (parseInt(modalQuantity.value) > 1) {
            modalQuantity.value = parseInt(modalQuantity.value) - 1;
            updateCartLink();
        }
    });

    // Close Modal
    closeModal.addEventListener("click", function () {
        modal.classList.add("hidden");
    });

    // Close Modal When Clicking Outside of It
    modal.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    });
});
</script>


@endsection
