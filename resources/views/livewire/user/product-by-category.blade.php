@extends('components.layouts.navbar')

@section('content')
<div class="w-full px-5 sm:px-4 md:px-2">
    <style>
        @media screen and (max-width: 768px) {
            .h-80 { height: 60vh; }
            .text-4xl { font-size: 2.25rem; }
            .px-5 { padding-left: 1rem; padding-right: 1rem; }
            .text-center { text-align: center; }
            .text-xl { font-size: 1.125rem; }
            .overflow-x-auto { overflow-x: auto; }
            .w-64 { width: 100%; }
        }

        @media screen and (max-width: 480px) {
            .text-4xl { font-size: 2rem; }
            .h-80 { height: 50vh; }
            .text-xl { font-size: 1rem; }
        }

        ::-webkit-scrollbar { display: none; }

        .overflow-x-auto {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <div class="w-full mx-auto overflow-y-auto py-10 px-4">
        <!-- Search Bar -->
        <div class="flex justify-center mt-10">
            @livewire('user.search-products')
            @livewire('user.modal.view-product-from-search')
        </div>

        <!-- Cakes Section -->
        <h1 class="text-center text-4xl sm:text-3xl md:text-2xl font-semibold mt-5 italic">{{ $category->category_name }}</h1>
        <p class="text-gray-600 mb-4 text-center text-lg sm:text-md">{{ $category->description }}</p>
        <hr class="my-8 border-t-2 border-gray-300">

        @foreach($bakeries as $bakery)
            @php
                $hasProducts = $bakery->products()->where('category_id', $category->id)->exists();
            @endphp

            @if($hasProducts)
                <h4 class="text-lg sm:text-md font-semibold text-center mt-6">{{ $bakery->shop_name }}</h4>
                @livewire('user.modal.view-produc-from-category', [
                    'shopId' => $bakery->id,
                    'categoryId' => $category->id
                ], key($bakery->id . '-' . $category->id))
            @endif
        @endforeach
    </div>
</div>
@endsection