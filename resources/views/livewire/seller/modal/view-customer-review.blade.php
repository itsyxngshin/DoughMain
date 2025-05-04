<div x-data="{ open: false }" x-init="open = false">
    <!-- View Review Button -->
    <button @click="open = true" class="text-[10px] border p-1 border-[#51331b] rounded hover:bg-[#51331b] hover:text-white">
        View Review
    </button>

    <!-- Modal -->
    <div x-show="open" x-cloak wire:ignore.self class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <div class="relative w-full">
                <button @click="open = false" class="absolute right-1 bg-transparent text-gray p-1 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 2048 2048">
                        <path fill="currentColor" d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z"/>
                    </svg>
                </button>
            </div>

            <!-- ORDER REVIEWS -->
            <div class="grid items-left mt-2">
                @if($reviews && $reviews->count())
                    @foreach($reviews as $review)
                        <div class="p-6 text-left bg-white">
                            <p class="text-sm italic">{{ $review->shop->shop_name ?? 'Secret Shop' }}</p>
                            <div class="flex items-center mt-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="text-yellow-400 text-lg">
                                        {{ $i <= $review->rating ? '★' : '☆' }}
                                    </span>
                                @endfor
                            </div>
                            <p class="text-sm italic text-gray-600 mt-2">"{{ $review->review_text }}"</p>
                            <h4 class="font-semibold mt-4 text-[#51331B]">
                                -{{ $review->user->username ?? 'Anonymous' }}
                            </h4>
                        </div>
                    @endforeach
                @else
                    <p class="text-center col-span-full text-gray-500">No reviews yet.</p>
                @endif
            </div>

           
        </div>
    </div>
</div>
