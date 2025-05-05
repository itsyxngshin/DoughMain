<div x-data="{ open: false }" x-init="open = false">
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
        class="fixed inset-0 w-full bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
            <!-- Close Button -->
            <button @click="open = false" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                ✕
            </button>

            <h2 class="text-lg font-bold text-[#51331b] mb-4">Rate Your Order</h2>

            @if ($hasReview)
                <div class="text-green-600 mb-4">You have already submitted a review.</div>
            @endif

            <!-- Livewire Form -->
            <form wire:submit.prevent="submitReview">
                <!-- Star Rating -->
                <div x-data="{ rating: @entangle('rating') }" class="flex space-x-1 mb-4">
                    @for ($i = 1; $i <= 5; $i++)
                        <span 
                            @click="if (!{{ $hasReview ? 'true' : 'false' }}) rating = {{ $i }}; $wire.set('rating', rating)"
                            class="cursor-pointer text-2xl"
                            :class="{ 'text-yellow-400': rating >= {{ $i }}, 'text-gray-300': rating < {{ $i }} }">
                            ★
                        </span>
                    @endfor
                </div>
                @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <!-- Review Text -->
                <div class="mb-4">
                    <textarea 
                        wire:model.defer="review_text"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring"
                        rows="4"
                        placeholder="Write your feedback..."
                        @if($hasReview) disabled @endif
                    ></textarea>
                    @error('review_text') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                        @if($hasReview) disabled @endif
                        class="px-4 py-2 bg-[#51331b] text-white rounded hover:bg-[#3e2714] disabled:opacity-50">
                        Submit Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
