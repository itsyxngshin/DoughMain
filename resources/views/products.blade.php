@extends('layouts.navbar')

@section('content')
<section class="bg-gray-100 py-10">
  <div class="container mx-auto px-4">
    <div class="relative">
      <img src="{{ asset('storage/image4.jpg') }}" alt="Bakery Display" class="w-full h-80 object-cover rounded-lg shadow-md">
      <h1 class="absolute top-10 left-10 text-white text-4xl font-bold">BJ's Bakery</h1>
    </div>

    <h2 class="text-center text-2xl font-semibold mt-10 italic">Pastries</h2>

    <!-- Cakes Section -->
    <h3 class="text-xl font-semibold mt-8">Cakes</h3>
    <p class="text-gray-600 mb-4">Indulge in a delightful selection of soft, moist, and flavorful cakes, crafted with rich Filipino ingredients and traditional recipes.</p>
    
    <div class="grid md:grid-cols-3 gap-6">
      @foreach([
        ['name' => 'Chiffon Cake', 'img' => 'chiffon.png', 'desc' => 'A buttery and fluffy sponge cake.', 'price' => '₱160.00'],
        ['name' => 'Yema Cake', 'img' => 'yema.png', 'desc' => 'Chiffon cake topped with sweet yema custard.', 'price' => '₱160.00'],
        ['name' => 'Ube Cake', 'img' => 'ube2.png', 'desc' => 'Moist chiffon cake with ube halaya.', 'price' => '₱160.00']
      ] as $cake)
        <div class="bg-white p-5 shadow-lg rounded-lg text-center">
          <img src="{{ asset('storage/' . $cake['img']) }}" alt="{{ $cake['name'] }}" class="w-40 mx-auto">
          <h4 class="font-semibold">{{ $cake['name'] }}</h4>
          <p class="text-gray-500">{{ $cake['desc'] }}</p>
          <p class="text-gray-800 font-bold">{{ $cake['price'] }}</p>
        </div>
      @endforeach
    </div>

    <!-- Breads Section -->
    <h3 class="text-xl font-semibold mt-10">Breads</h3>
    <p class="text-gray-600 mb-4">Classic Filipino breads, from soft and fluffy rolls to sweet and savory treats.</p>

    <div class="grid md:grid-cols-3 gap-6">
      @foreach([
        ['name' => 'Pandesal', 'img' => 'pandesal.png', 'desc' => 'A soft, slightly sweet bread roll.', 'price' => '₱5.00'],
        ['name' => 'Ensaymada', 'img' => 'ensay1.jpg', 'desc' => 'Buttery brioche topped with cheese.', 'price' => '₱20.00'],
        ['name' => 'Monay', 'img' => 'monay.png', 'desc' => 'Dense and chewy bread with a sweet taste.', 'price' => '₱5.00']
      ] as $bread)
        <div class="bg-white p-5 shadow-lg rounded-lg text-center">
          <img src="{{ asset('storage/' . $bread['img']) }}" alt="{{ $bread['name'] }}" class="w-32 mx-auto">
          <h4 class="font-semibold">{{ $bread['name'] }}</h4>
          <p class="text-gray-500">{{ $bread['desc'] }}</p>
          <p class="text-gray-800 font-bold">{{ $bread['price'] }}</p>
        </div>
      @endforeach
    </div>

    <!-- Pies and Tarts -->
    <h3 class="text-xl font-semibold mt-10">Pies and Tarts</h3>
    <p class="text-gray-600 mb-4">Delicious Filipino pies and tarts with rich fillings.</p>

    <div class="grid md:grid-cols-3 gap-6">
      @foreach([
        ['name' => 'Buko Pie', 'img' => 'buko.png', 'desc' => 'Flaky pastry filled with young coconut.'],
        ['name' => 'Pineapple Pie', 'img' => 'pine.png', 'desc' => 'Sweet pie with caramelized pineapple.'],
        ['name' => 'Egg Pie', 'img' => 'egg.png', 'desc' => 'Creamy custard pie with a crisp crust.']
      ] as $pie)
        <div class="bg-white p-5 shadow-lg rounded-lg text-center">
          <img src="{{ asset('storage/' . $pie['img']) }}" alt="{{ $pie['name'] }}" class="w-40 mx-auto">
          <h4 class="font-semibold">{{ $pie['name'] }}</h4>
          <p class="text-gray-500">{{ $pie['desc'] }}</p>
        </div>
      @endforeach
    </div>

  </div>
</section>
@endsection
