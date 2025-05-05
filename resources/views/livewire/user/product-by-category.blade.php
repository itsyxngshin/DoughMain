@extends('components.layouts.navbar')

@section('content')
<div class="w-full px-5">
    <div class="w-full mx-auto overflow-y-auto py-10 px-4">
        <!-- Search Bar -->
        <div class="flex justify-center mt-10">
           
        @livewire('user.search-products')
            @livewire('user.modal.view-product-from-search')
           
        </div>


        <!-- Cakes Section -->
        <h1 class="text-center text-4xl font-semibold mt-5 italic">{{$category->category_name}}</h1>
        <p class="text-gray-600 mb-4 text-center">{{$category->description}}</p>
        <hr class="my-8 border-t-2 border-gray-300">

        @foreach($bakeries as $bakery)
            @php
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
        <!-- ... (keep your review modal here) -->

    </div>
</div>
@endsection
