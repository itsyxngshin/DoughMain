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
        <h2 class="text-2xl font-bold">Top Products</h2>
        <div class="grid grid-cols-4 gap-4 mt-4">
            @foreach (['pandesal' => 'Pandesal', 'ube' => 'Ube Pandesal', 'ensay' => 'Ensaymada', 'cass' => 'Cassava Cake'] as $img => $name)
            <div class="relative">
                <img src="{{ asset('storage/' . $img . '.jpg') }}" class="rounded-lg w-full h-auto">
                <div class="absolute inset-0 bg-gradient-to-t from-[#51331B]/70 to-transparent rounded-lg"></div> 
                <h3 class="absolute bottom-2 left-5 text-white font-semibold z-10">
                    {{ $name }}
                </h3>
            </div>
            @endforeach
        </div>

        <h2 class="text-2xl font-bold mt-8">Categories</h2>
        <div class="grid grid-cols-4 gap-4 mt-4">
            @foreach (['cake' => 'Cakes', 'pandesal' => 'Breads', 'cupcakes' => 'Cupcakes', 'pies' => 'Pies & Tarts'] as $img => $name)
            <div class="relative bg-cover bg-center rounded-lg shadow-lg flex items-end pl-2 h-32" style="background-image: url('{{ asset('storage/' . $img . '.jpg') }}');">
                <div class="absolute inset-0 bg-gradient-to-t from-[#51331B]/70 to-transparent rounded-lg"></div>
                <h3 class="absolute bottom-2 left-5 text-white font-semibold z-10">
                    {{ $name }}
                </h3>
            </div>
            @endforeach
        </div>

        <h2 class="text-2xl font-bold mt-8">All Bakeries</h2>
        <div class="grid grid-cols-3 gap-4 mt-4">
            @foreach (['image1' => "BJ's Bakery", 'image2' => "Kodie's Bakery", 'image3' => 'Bakery'] as $img => $name)
            <div class="relative">
                <img src="{{ asset('storage/' . $img . '.jpg') }}" class="rounded-lg w-full h-auto">
                <div class="absolute inset-0 bg-gradient-to-t from-[#51331B]/70 to-transparent rounded-lg"></div> 
                <h3 class="absolute bottom-2 left-5 text-white font-semibold z-10">
                    {{ $name }}
                </h3>
            </div>
            @endforeach
        </div>
    </main>
</div>
@endsection
