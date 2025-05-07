@extends('components.layouts.navbar')

@section('content')
<div class="flex flex-col items-center w-full px-4 md:px-8 pt-10">

<style>
    @media screen and (max-width: 768px) {
        .h-80 {
            height: 60vh;
        }

        .text-4xl {
            font-size: 2.25rem;
        }

        .px-5 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .text-center {
            text-align: center;
        }

        .text-xl {
            font-size: 1.125rem;
        }

        .overflow-x-auto {
            overflow-x: auto;
        }

        .w-64 {
            width: 100%;
        }
    }

    @media screen and (max-width: 480px) {
        .text-4xl {
            font-size: 2rem;
        }

        .h-80 {
            height: 50vh;
        }

        .text-xl {
            font-size: 1rem;
        }
    }

    ::-webkit-scrollbar {
        display: none;
    }

    .overflow-x-auto {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<div class="w-full max-w-screen-xl overflow-y-auto">
    @if($bakery->shopLogo)
        <img src="{{ asset('storage/shop_logos/' . $bakery->shopLogo->logo_path) }}" alt="Bakery Display"
            class="w-full h-80 sm:h-96 object-cover rounded-lg shadow-md">
    @endif

    <h1 class="text-center text-4xl sm:text-5xl font-semibold mt-10 italic">{{ $bakery->shop_name }}</h1>
    <p class="text-gray-600 mb-4 mt-4 text-center text-lg sm:text-xl">{{ $bakery->shop_description }}</p>

    <div class="w-full">
        @foreach($categories as $category)
            @php
                $hasProducts = $bakery->products()
                    ->where('category_id', $category->id)
                    ->exists();
            @endphp

            @if($hasProducts)
                @livewire('user.modal.view-shop-product', ['shopId' => $bakery->id, 'categoryId' => $category->id], key($bakery->id . '-' . $category->id))
                <div class="my-10 text-center">
                    <span class="inline-block text-gray-400 text-xl tracking-widest">&#10022;&#10022;&#10022;</span>
                </div>
            @endif
        @endforeach
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

    
});
</script>
@endsection
