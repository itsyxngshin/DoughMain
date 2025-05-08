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
      <img src="{{ asset('storage/image1.jpg') }}" alt="Bakery Display" class="w-full h-80 object-cover rounded-lg shadow-md">
      <div class="absolute inset-0 bg-black bg-opacity-25 rounded-lg"></div> 
      <h1 class="absolute top-10 left-10 text-white text-4xl font-bold z-10">Kodie Bakery</h1>

      <!-- Review Section with Transparent Background -->
      <div class="absolute bottom-4 left-4 p-3 rounded-lg cursor-pointer bg-transparent" id="reviewSection">
        <div class="flex items-center">
          <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
          <span class="font-semibold text-white ml-2">4/5 stars</span>
        </div>
        <p class="text-black-500 text-xs">Click to see reviews</p>
      </div>
    </div>

    <h1 class="text-center text-4xl font-semibold mt-10 italic">Pastries</h1>
    <p class="text-gray-600 mb-4 mt-4 text-center">Indulge in our delicious Filipino pastries.</p>
    <!-- Cakes Section -->
    <div class="flex items-center justify-center my-12">
      <div class="w-1/5 border-t border-gray-300"></div>
      <div class="mx-4 text-gray-500 text-sm tracking-wider uppercase">Cakes</div>
      <div class="w-1/5 border-t border-gray-300"></div>
    </div>

        <h3 class="text-xl font-semibold mt-8 text-center">Cakes</h3>
        <p class="text-gray-600 mb-4 text-center">Indulge in a delightful selection of soft, moist, and flavorful cakes.</p>
        <div class="my-10 text-center">
      <span class="inline-block text-gray-400 text-xl tracking-widest">&#10022;&#10022;&#10022;</span>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
      @foreach([
        ['name' => 'Leche Flan Cake', 'img' => 'leche-flan-cake.png', 'desc' => 'Smooth caramel custard on soft chiffon cake.', 'price' => '₱180.00'],
        ['name' => 'Mango Bravo', 'img' => 'mango-bravo.png', 'desc' => 'Layers of mango, meringue, and cream filling.', 'price' => '₱200.00'],
        ['name' => 'Ube Leche Flan Cake', 'img' => 'ube-leche-flan.png', 'desc' => 'Traditional leche flan with ube flavor.', 'price' => '₱220.00'],
        ['name' => 'Buko Pandan Cake', 'img' => 'buko-pandan-cake.png', 'desc' => 'Coconut and pandan-flavored cake with creamy frosting.', 'price' => '₱170.00'],
        ['name' => 'Yema Cake', 'img' => 'yema-cake.png', 'desc' => 'Fluffy cake topped with rich yema custard.', 'price' => '₱160.00'],
        ['name' => 'Taro Cake', 'img' => 'taro-cake.png', 'desc' => 'Taro-flavored cake with creamy frosting.', 'price' => '₱180.00'],
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

    <!-- Breads Section -->
    <div class="flex items-center justify-center my-12">
      <div class="w-1/5 border-t border-gray-300"></div>
      <div class="mx-4 text-gray-500 text-sm tracking-wider uppercase">Breads</div>
      <div class="w-1/5 border-t border-gray-300"></div>
    </div>

        <h3 class="text-xl font-semibold mt-10 text-center">Breads</h3>
        <p class="text-gray-600 mb-4 text-center">Classic Filipino breads, from soft and fluffy rolls to sweet and savory treats.</p>
        <div class="my-10 text-center">
      <span class="inline-block text-gray-400 text-xl tracking-widest">&#10022;&#10022;&#10022;</span>
      </div>


    <div class="grid md:grid-cols-3 gap-6">
      @foreach([
        ['name' => 'Pandesal', 'img' => 'pandesal.png', 'desc' => 'Soft, round Filipino bread rolls, perfect with coffee or as a snack.', 'price' => '₱10.00'],
        ['name' => 'Hopia', 'img' => 'hopia.png', 'desc' => 'A flaky pastry filled with sweet lotus paste.', 'price' => '₱50.00'],
        ['name' => 'Putok', 'img' => 'putok.png', 'desc' => 'A soft, round bread with a sweet, sugary topping.', 'price' => '₱25.00'],
        ['name' => 'Panderegla', 'img' => 'regla.webp', 'desc' => 'Sweet and soft bread with a slight crisp crust.', 'price' => '₱30.00'],
        ['name' => 'Pandecoco', 'img' => 'pandecoco.png', 'desc' => 'Coconut-filled bread roll with a hint of sweetness.', 'price' => '₱35.00'],
        ['name' => 'Kababayan', 'img' => 'kababayan.webp', 'desc' => 'A cupcake-shaped Filipino bread that is slightly sweet and buttery.', 'price' => '₱5.00'],
      ] as $pastry)
        <div class="searchable-item bg-transparent hover:bg-gray-200 p-5 shadow-lg rounded-lg text-center transition-transform transform hover:scale-105 duration-300">
          <a href="#" class="openModal" data-name="{{ $pastry['name'] }}" data-img="{{ asset('storage/' . $pastry['img']) }}" data-desc="{{ $pastry['desc'] }}" data-price="{{ $pastry['price'] }}">
            <img src="{{ asset('storage/' . $pastry['img']) }}" alt="{{ $pastry['name'] }}" class="w-40 mx-auto transition-transform transform hover:scale-110 duration-300">
          </a>
          <h4 class="font-semibold mt-2">{{ $pastry['name'] }}</h4> <!-- Added mt-2 to add space above the text -->
          <p class="text-gray-500">{{ $pastry['desc'] }}</p>
          <p class="text-gray-800 font-bold">{{ $pastry['price'] }}</p>
        </div>
      @endforeach
    </div>

        <!-- Pies and Tarts Section -->
        <div class="flex items-center justify-center my-12">
        <div class="w-1/5 border-t border-gray-300"></div>
        <div class="mx-4 text-gray-500 text-sm tracking-wider uppercase">Pies and Tarts</div>
        <div class="w-1/5 border-t border-gray-300"></div>
      </div>

          <h3 class="text-xl font-semibold mt-10 text-center">Pies and Tarts</h3>
          <p class="text-gray-600 mb-4 text-center">Delicious Filipino pies and tarts with rich fillings.</p>
          <div class="my-10 text-center">
        <span class="inline-block text-gray-400 text-xl tracking-widest">&#10022;&#10022;&#10022;</span>
      </div>

    <div class="grid md:grid-cols-3 gap-6">
      @foreach([
        ['name' => 'Buko Pie', 'img' => 'buko-pie.png', 'desc' => 'Coconut pie with a creamy filling in a flaky crust.', 'price' => '₱150.00'],
        ['name' => 'Mango Pie', 'img' => 'mango-pie.png', 'desc' => 'Sweet and tangy mango pie with a buttery crust.', 'price' => '₱160.00'],
        ['name' => 'Sampaloc Tart', 'img' => 'sampaloc-tart.png', 'desc' => 'Tart with tamarind filling, sweet and sour flavor.', 'price' => '₱120.00'],
        ['name' => 'Custard Tart', 'img' => 'custard-tart.png', 'desc' => 'Smooth custard filling with a crunchy crust.', 'price' => '₱140.00'],
        ['name' => 'Banana Tart', 'img' => 'banana-tart.png', 'desc' => 'Tart with a sweet banana filling and hint of cinnamon.', 'price' => '₱130.00'],
        ['name' => 'Langka Pie', 'img' => 'langka-pie.png', 'desc' => 'Jackfruit-filled pie with a soft, buttery crust.', 'price' => '₱150.00'],
      ] as $pie)
        <div class="searchable-item bg-transparent hover:bg-gray-200 p-5 shadow-lg rounded-lg text-center transition-transform transform hover:scale-105 duration-300">
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

<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
        <button id="closeReviewModal" class="absolute top-2 right-2 text-gray-500 hover:text-red-500">✕</button>

        <h2 class="text-xl font-semibold text-center">Customer Reviews</h2>

        <!-- Reviews Content -->
        <div class="mt-4">
            <div class="flex items-center">
                <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                <p class="text-gray-700 text-sm ml-2">“Great pastries! I love the Pandecoco, it's so soft!” – Sarah</p>
            </div>
            <div class="flex items-center mt-4">
                <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9734;&#9734;</span>
                <p class="text-gray-700 text-sm ml-2">“The Hopia is the best! The sweetness is just right.” – John</p>
            </div>
            <div class="flex items-center mt-4">
                <span class="text-yellow-400">&#9733;&#9733;&#9733;&#9734;&#9734;</span>
                <p class="text-gray-700 text-sm ml-2">“I tried the Regla, and it was absolutely delightful!” – Emma</p>
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
