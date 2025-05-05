<div x-data="{ open: false }" x-init="open = false">
@php
    $fullStars = floor($averageRating);
    $halfStar = ($averageRating - $fullStars) >= 0.5;
    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
@endphp

<!-- View Review Button -->
<button @click="open = true"
    class="text-[10px] rounded hover:scale-110 hover:text-white absolute  transition-transform transform bottom-2 left-8">
    <div class="p-3 rounded-lg cursor-pointer bg-transparent" id="reviewSection">
        <div class="flex items-center">
            @for ($i = 0; $i < $fullStars; $i++)
                <span class="text-yellow-400">&#9733;</span> {{-- Full star --}}
            @endfor
            @if ($halfStar)
                <span class="text-yellow-400">&#189;</span> {{-- Half star --}}
            @endif
            @for ($i = 0; $i < $emptyStars; $i++)
                <span class="text-gray-300">&#9733;</span> {{-- Empty star --}}
            @endfor

            <span class="font-semibold text-[#51331b] ml-2">{{ $averageRating }}/5</span>
        </div>
        <p class="text-black text-xs">Click to see reviews</p>
    </div>
</button>



    <!-- Modal -->
    <div x-show="open" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[32rem] max-h-[90vh] overflow-y-auto">
            <!-- Close Button -->
            <div class="relative w-full">
                <button @click="open = false"
                    class="absolute right-1 top-1 bg-transparent text-gray-500 hover:text-black p-1 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 2048 2048">
                        <path fill="currentColor"
                            d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z" />
                    </svg>
                </button>
            </div>

            <!-- ORDER REVIEWS -->
            <div class="mt-6 space-y-6">
                @if($reviews && $reviews->count())
                    @foreach($reviews as $review)
                        <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                            <p class="text-sm italic text-gray-500">{{ $review->shop->shop_name ?? 'Secret Shop' }}</p>
                            <div class="flex items-center mt-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="text-yellow-400 text-lg">
                                        {{ $i <= $review->rating ? '★' : '☆' }}
                                    </span>
                                @endfor
                            </div>
                            <p class="text-sm italic text-gray-700 mt-2">"{{ $review->review_text }}"</p>
                            <h4 class="font-semibold mt-4 text-[#51331B]">
                                - {{ $review->user->username ?? 'Anonymous' }}
                            </h4>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-gray-500">No reviews yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
