<div x-data="{ open: false, rating: @entangle('rating') }" x-init="open = false">
    <!-- Rate Order Button -->
    <button @click="open = true"
        class="px-4 py-2 text-sm bg-[#51331b] text-white rounded border border-[#51331b] hover:text-[#51331b] hover:bg-transparent">
        Rate Order
    </button>

    <!-- Modal -->
    <div 
        x-show="open"
        x-cloak
        @closeModal.window="open = false"
        class="fixed inset-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
            <!-- Close Button -->
            <button @click="open = false" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                ✕
            </button>

            <h2 class="text-lg font-bold text-[#51331b] mb-4">Rate Your Order</h2>

            <!-- Livewire Form -->
            <form wire:submit.prevent="submitReview">
                <!-- Show Review Form if No Review Exists -->
                <template x-if="!@entangle('hasReview')">
                    <div>
                        <!-- Star Rating -->
                        <div class="flex space-x-1 mb-4">
                            @for ($i = 1; $i <= 5; $i++)
                                <span 
                                    x-on:click="rating = {{ $i }}; $wire.set('rating', {{ $i }})"
                                    class="cursor-pointer text-2xl"
                                    :class="{ 'text-yellow-400': rating >= {{ $i }}, 'text-gray-300': rating < {{ $i }} }">
                                    ★
                                </span>
                            @endfor
                        </div>

                        <!-- Review Text -->
                        <div class="mb-4">
                            <textarea 
                                wire:model.defer="review_text"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring"
                                rows="4"
                                placeholder="Write your feedback..."></textarea>
                            @error('review_text') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-[#51331b] text-white rounded hover:bg-[#3e2714]">
                                Submit Review
                            </button>
                        </div>
                    </div>
                </template>

                <!-- Locked Review Form if Already Reviewed -->
                <template x-if="@entangle('hasReview')">
                    <div class="text-center">
                        <p class="text-sm text-gray-500">You have already reviewed this order.</p>
                        <button 
                            type="button" 
                            class="px-4 py-2 bg-gray-300 text-gray-600 rounded cursor-not-allowed mt-4"
                            disabled>
                            Review Submitted
                        </button>
                    </div>
                    <!-- Display the Submitted Review -->
                    @foreach($reviews as $review)
                        <div class="p-6 text-left bg-white mt-4">
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
                </template>
            </form>
        </div>
    </div>
</div>
