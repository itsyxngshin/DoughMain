@extends('layouts.navbar')

@section('content')
<div class="flex font-poppins"> <!-- Applied Poppins font -->
    <!-- Sidebar -->
    <aside class="w-1/4 bg-white p-6 shadow space-y-4">
        <h2 class="font-bold text-lg mb-4 pl-2">Filters</h2>

        <div class="space-y-2 pl-8 pb-5">
            <h3 class="font-semibold">Sort by</h3>
            <label class="block leading-relaxed"><input type="radio" name="sort" checked> Relevance</label>
            <label class="block leading-relaxed"><input type="radio" name="sort"> Distance</label>
        </div>

        <div class="mt-4 space-y-2 pl-8 pb-5">
            <h3 class="font-semibold">Quick Filters</h3>
            <label class="block leading-relaxed"><input type="checkbox"> Ratings 4+</label>
            <label class="block leading-relaxed"><input type="checkbox"> Top Products</label>
        </div>

        <div class="mt-4 space-y-2 pl-8 pb-5">
            <h3 class="font-semibold">Pastries</h3>
            <label class="block leading-relaxed"><input type="checkbox"> Cake</label>
            <label class="block leading-relaxed"><input type="checkbox"> Bread</label>
            <label class="block leading-relaxed"><input type="checkbox"> Cupcake</label>
            <label class="block leading-relaxed"><input type="checkbox"> Pies and Tarts</label>
        </div>
    </aside>
    

    <!-- Main Content -->
    <main class="w-3/4 p-8 ml-8">
        <!-- Search Bar -->
    <div class="sticky top-1 py-2 z-50 ml-3 mb-5">
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
    
        <h2 class="text-2xl font-bold">Top Products</h2>
        <div class="grid grid-cols-4 gap-4 mt-4">
            @foreach (['pandesal' => 'Pandesal', 'ube' => 'Ube Pandesal', 'ensay' => 'Ensaymada', 'cass' => 'Cassava Cake'] as $img => $name)
            <div class="relative transition-transform transform hover:scale-105 duration-300">
                <a href="#">
                    <img src="{{ asset('storage/' . $img . '.jpg') }}" class="rounded-lg w-full h-auto transition-transform transform hover:scale-110 duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#51331B]/70 to-transparent rounded-lg"></div> 
                    <h3 class="absolute bottom-2 left-5 text-white font-semibold z-10">
                        {{ $name }}
                    </h3>
                </a>
            </div>
            @endforeach
        </div>

        <h2 class="text-2xl font-bold mt-8">Categories</h2>
        <div class="grid grid-cols-4 gap-4 mt-4">
            @foreach (['ensay' => 'Cakes', 'pandesal' => 'Breads', 'image1' => 'Cupcakes', 'pientarts' => 'Pies & Tarts'] as $img => $name)
            <div class="relative bg-cover bg-center rounded-lg shadow-lg flex items-end pl-2 h-32 transition-transform transform hover:scale-105 duration-300" 
                 style="background-image: url('{{ asset('storage/' . $img . '.jpg') }}');">
                <a href="#">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#51331B]/70 to-transparent rounded-lg"></div>
                    <h3 class="absolute bottom-2 left-5 text-white font-semibold z-10">
                        {{ $name }}
                    </h3>
                </a>
            </div>
            @endforeach
        </div>

        <h2 class="text-2xl font-bold mt-8">All Bakeries</h2>
<div class="grid grid-cols-3 gap-4 mt-4">
    
    <!-- BJ's Bakery -->
    <div class="relative transition-transform transform hover:scale-105 duration-300">
        <a href="products">
            <img src="{{ asset('storage/image3.jpg') }}" class="rounded-lg w-full h-auto transition-transform transform hover:scale-110 duration-300">
            <div class="absolute inset-0 bg-gradient-to-t from-[#51331B]/70 to-transparent rounded-lg"></div> 
            <h3 class="absolute bottom-2 left-5 text-white font-semibold z-10">BJ's Bakery</h3>
        </a>
    </div>

    <!-- Kodie's Bakery -->
    <div class="relative transition-transform transform hover:scale-105 duration-300">
        <a href="/bakery2">
            <img src="{{ asset('storage/image4.jpg') }}" class="rounded-lg w-full h-auto transition-transform transform hover:scale-110 duration-300">
            <div class="absolute inset-0 bg-gradient-to-t from-[#51331B]/70 to-transparent rounded-lg"></div> 
            <h3 class="absolute bottom-2 left-5 text-white font-semibold z-10">Kodie's Bakery</h3>
        </a>
    </div>

    <!-- Bakery 3 -->
    <div class="relative transition-transform transform hover:scale-105 duration-300">
        <a href="/bakery3">
            <img src="{{ asset('storage/image3.jpg') }}" class="rounded-lg w-full h-auto transition-transform transform hover:scale-110 duration-300">
            <div class="absolute inset-0 bg-gradient-to-t from-[#51331B]/70 to-transparent rounded-lg"></div> 
            <h3 class="absolute bottom-2 left-5 text-white font-semibold z-10">Bakery 3</h3>
        </a>
    </div>

</div>

    </main>
</div>

@endsection
