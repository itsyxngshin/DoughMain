@extends('components.layouts.navbar')

@section('content')
<div class="flex flex-col items-center w-full px-4 md:px-8 pt-12">

    

    <!-- Main Content -->
    <main class="w-full max-w-screen-xl p-8 overflow-y-auto" style="max-height: calc(100vh - 3rem);">

            @livewire('user.search-products')
            @livewire('user.modal.view-product-from-search')
        
        

        <!-- Slideshow Section -->
        <section class="mb-12">
            <div class="relative w-full max-w-full h-64 sm:h-80 md:h-96 rounded-lg overflow-hidden shadow-lg">
                <div id="slideshow" class="relative h-full">
                    <!-- Slides -->
                    <div class="absolute inset-0 opacity-100 transition-opacity duration-700 ease-in-out" data-slide="0" style="background-image: url('/storage/bakery1.jpg'); background-size: cover; background-position: center;"></div>
                    <div class="absolute inset-0 opacity-0 transition-opacity duration-700 ease-in-out" data-slide="1" style="background-image: url('/storage/bakery3.jpg'); background-size: cover; background-position: center;"></div>
                    <div class="absolute inset-0 opacity-0 transition-opacity duration-700 ease-in-out" data-slide="2" style="background-image: url('/storage/bakery4.jpg'); background-size: cover; background-position: center;"></div>

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-[#51331B]/50 flex flex-col justify-center items-center text-white px-4">
                        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-2 drop-shadow-lg">Featured Products</h2>
                        <p class="text-lg sm:text-xl md:text-2xl drop-shadow-md max-w-2xl text-center px-4">Discover our exclusive collection of delicious pastries and baked goods.</p>
                    </div>

                    <!-- Navigation Arrows -->
                    <button id="prevSlide" class="absolute left-4 sm:left-6 top-1/2 transform -translate-y-1/2 bg-[#51331B]/70 hover:bg-[#51331B]/90 text-white rounded-full w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center focus:outline-none" aria-label="Previous Slide">
                        &#10094;
                    </button>
                    <button id="nextSlide" class="absolute right-4 sm:right-6 top-1/2 transform -translate-y-1/2 bg-[#51331B]/70 hover:bg-[#51331B]/90 text-white rounded-full w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center focus:outline-none" aria-label="Next Slide">
                        &#10095;
                    </button>
                    
                    <!-- Dots -->
                    <div class="absolute bottom-4 w-full flex justify-center space-x-3">
                        <button data-dot="0" class="w-3 h-3 rounded-full bg-white opacity-70 hover:opacity-100 focus:outline-none"></button>
                        <button data-dot="1" class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 focus:outline-none"></button>
                        <button data-dot="2" class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 focus:outline-none"></button>
                    </div>
                </div>
            </div>
        </section>

        <style>
            /* Responsive Adjustments */
            @media screen and (max-width: 768px) {
                .h-64 {
                    height: 50vh;  /* Adjust height for mobile */
                }
                .h-80 {
                    height: 60vh;  /* Adjust height for tablets and small screens */
                }
                .h-96 {
                    height: 70vh;  /* Adjust height for larger tablets and desktops */
                }

                .text-3xl {
                    font-size: 1.75rem;  /* Scale down text size */
                }
                .text-4xl {
                    font-size: 2.25rem;  /* Scale down text size */
                }
                .text-5xl {
                    font-size: 2.5rem;  /* Scale down text size */
                }

                .sm\:text-xl {
                    font-size: 1rem;  /* Scale down text size */
                }

                .sm\:text-2xl {
                    font-size: 1.25rem;  /* Scale down text size */
                }

                .px-4 {
                    padding-left: 1rem;
                    padding-right: 1rem;
                }

                .w-8 {
                    width: 2rem;  /* Adjust button size for mobile */
                }
                .h-8 {
                    height: 2rem;  /* Adjust button size for mobile */
                }

                .sm\:w-10 {
                    width: 2.5rem;  /* Adjust button size for mobile */
                }

                .sm\:h-10 {
                    height: 2.5rem;  /* Adjust button size for mobile */
                }

                .left-4 {
                    left: 1rem;
                }

                .right-4 {
                    right: 1rem;
                }

                .sm\:left-6 {
                    left: 1.5rem;
                }

                .sm\:right-6 {
                    right: 1.5rem;
                }

                .space-x-3 {
                    gap: 0.75rem;  /* Adjust spacing between dots */
                }
            }

            /* Additional Small Screen Adjustments */
            @media screen and (max-width: 480px) {
                .text-3xl {
                    font-size: 1.5rem;
                }
                .text-4xl {
                    font-size: 2rem;
                }
                .text-5xl {
                    font-size: 2.25rem;
                }

                .sm\:text-xl {
                    font-size: 0.875rem;
                }

                .sm\:text-2xl {
                    font-size: 1rem;
                }

                .h-64 {
                    height: 40vh;  /* Further adjust height for smaller screens */
                }

                .px-4 {
                    padding-left: 0.75rem;
                    padding-right: 0.75rem;
                }

                .w-8 {
                    width: 1.75rem;
                }

                .h-8 {
                    height: 1.75rem;
                }

                .sm\:w-10 {
                    width: 2rem;
                }

                .sm\:h-10 {
                    height: 2rem;
                }
            }
        </style>

        <div class="space-y-8">
            @if (count($selectedCategories) > 0)
                <h2 class="text-2xl font-bold text-[#51331B] text-center">Filtered Products</h2>
                <div class="flex overflow-x-auto space-x-6 pb-4 justify-center">
                    @foreach ($products as $product)
                        <div class="w-64 mb-6 flex-none">
                            @livewire('user.modal.view-product-from-homepage', ['productId' => $product->id], key($product->id))
                        </div>
                    @endforeach
                </div>
            @else
            
                            <!-- Products Section -->
            <h2 class="text-2xl font-bold text-[#51331B] text-center">Products</h2>
            <div class="flex overflow-x-auto space-x-6 pb-4 justify-center">
                @foreach ($products->take(10) as $product)
                    <div class="w-64 mb-6 items-center flex-none">
                        @livewire('user.modal.view-product-from-homepage', ['productId' => $product->id], key($product->id))
                    </div>
                @endforeach
            </div>


                <!-- Categories Section -->
                <h2 class="text-2xl font-bold text-[#51331B] text-center">Categories</h2>
                <div class="flex space-x-6 pb-4 justify-center">
                    @foreach ($categories as $category)
                        <div class="w-56 mb-6 flex-none">
                            <div class="relative bg-cover bg-center rounded-lg shadow-lg flex items-end pl-2 h-32 transition-transform transform hover:scale-105 duration-300"
                                style="background-image: url('{{ asset('storage/category_photo/' . $category->category_photo) }}');">
                                <a href="{{ route('category', ['id' => $category->id]) }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#51331B]/70 to-transparent rounded-lg"></div>
                                    <h3 class="absolute bottom-2 left-5 text-white font-semibold z-10">
                                        {{ $category->category_name }}
                                    </h3>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Bakeries Section -->
                <h2 class="text-2xl font-bold text-[#51331B] text-center">All Bakeries</h2>
                <div class="flex overflow-x-auto space-x-6 pb-4 justify-center">
                    @foreach ($bakeries as $bakery)
                        @if ($bakery->shopLogo)
                            <div class="w-64 mb-6 flex-none relative transition-transform transform hover:scale-105 duration-300">
                                <a href="{{ route('shop.products', ['id' => $bakery->id]) }}">
                                    <img src="{{ asset('storage/' . $bakery->shopLogo->logo_path) }}" class="rounded-lg w-full h-56 object-cover transition-transform transform hover:scale-110 duration-300">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#51331B]/70 to-transparent rounded-lg"></div> 
                                    <h3 class="absolute bottom-2 left-5 text-white font-semibold z-10">
                                        {{ $bakery->shop_name }}
                                    </h3>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Testimonials Section -->
                <section class="mt-12 bg-[#f9f9f9] py-8">
                    <h2 class="text-2xl font-bold text-[#51331B] text-center">What Our Customers Are Saying</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8 pb-4 px-4">
                        @forelse ($testimonials as $review)
                            <div class="w-full mb-6 p-6 border rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 bg-white">
                                <p class="text-sm italic ">{{ $review->shop->shop_name ?? 'Secret Shop'}}</p>
                                <div class="flex items-center mt-3">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="text-yellow-400">
                                            {{ $i <= $review->rating ? '★' : '☆' }}
                                        </span>
                                    @endfor
                                </div>
                                <p class="text-sm italic text-gray-600">"{{ $review->review_text }}"</p>
                                <h4 class="font-semibold mt-4 text-[#51331B]">
                                    -{{ $review->user->username ?? 'Anonymous' }}
                                </h4>
                            </div>
                        @empty
                            <p class="text-center col-span-full text-gray-500">No reviews yet.</p>
                        @endforelse
                    </div>
                </section>
            @endif
        </div>
    </main>

    <style>
        /* Hide Scrollbars */
        ::-webkit-scrollbar {
            display: none;
        }

        body {
            -ms-overflow-style: none;  /* Internet Explorer 10+ */
            scrollbar-width: none;  /* Firefox */
        }

        /* Responsive Adjustments */
        @media screen and (max-width: 768px) {
            .flex {
                flex-direction: column;
            }
            .space-x-6 {
                margin-left: 0;
                margin-right: 0;
                gap: 1rem;
            }
            .w-64 {
                width: 100%;
            }
            .h-56 {
                height: auto;
            }
            .h-32 {
                height: auto;
            }
            .text-3xl {
                font-size: 1.5rem;
            }
            .text-lg {
                font-size: 1rem;
            }
            .text-xl {
                font-size: 1.125rem;
            }
        }

        @media screen and (max-width: 480px) {
            .text-3xl {
                font-size: 1.25rem;
            }

            .text-lg {
                font-size: 0.875rem;
            }

            .space-x-6 {
                gap: 0.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('#slideshow [data-slide]');
            const dots = document.querySelectorAll('#slideshow [data-dot]');
            const prevBtn = document.getElementById('prevSlide');
            const nextBtn = document.getElementById('nextSlide');
            let current = 0;
            let slideInterval = null;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.style.opacity = i === index ? '1' : '0';
                    if(i === index){
                        slide.classList.add('opacity-100');
                        slide.classList.remove('opacity-0');
                    } else {
                        slide.classList.add('opacity-0');
                        slide.classList.remove('opacity-100');
                    }
                });
                dots.forEach((dot, i) => {
                    dot.classList.toggle('opacity-100', i === index);
                    dot.classList.toggle('opacity-50', i !== index);
                });
            }

            function nextSlide() {
                current = (current + 1) % slides.length;
                showSlide(current);
            }

            function prevSlide() {
                current = (current - 1 + slides.length) % slides.length;
                showSlide(current);
            }

            prevBtn.addEventListener('click', prevSlide);
            nextBtn.addEventListener('click', nextSlide);

            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => {
                    current = i;
                    showSlide(current);
                });
            });

            slideInterval = setInterval(nextSlide, 5000);
            showSlide(current);
        });
    </script>

</div>
@endsection
