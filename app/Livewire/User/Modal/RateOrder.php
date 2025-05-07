<?php

namespace App\Livewire\User\Modal;

use Livewire\Component;
use App\Models\Order;
use App\Models\Review;

class RateOrder extends Component
{
    public $orderId;
    public $productId;
    public $rating; // Rating no longer defaults to 0.
    public $review_text;
    public $shopId;
    public $reviews;
    public $hasReview = false;

    public function mount($orderId)
    {
        $order = Order::with('orderItems.product.shop')->findOrFail($orderId);
        $this->orderId = $orderId;
        $this->productId = $order->orderItems->first()?->product_id;
        $this->shopId = $order->orderItems->first()?->product->shop_id;

        // Fetch the reviews for this order by the authenticated user
        $this->reviews = Review::where('order_id', $this->orderId)
                                ->where('user_id', auth()->id())
                                ->get();

        if ($this->reviews->count() > 0) {
            $this->hasReview = true;
            $existingReview = $this->reviews->first();
            $this->rating = $existingReview->rating; // Set the rating to the existing review value
            $this->review_text = $existingReview->review_text;
        } else {
            $this->rating = null; // Initialize rating to null when there's no existing review
        }
    }

    public function submitReview()
    {
        
        // Prevent re-submission if the review already exists
        if ($this->hasReview) {
            session()->flash('message', 'You have already reviewed this order.');
            return;
        }

        // Validation of the rating and review text
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|min:5',
        ]);

        // Create a new review
        Review::create([
            'user_id' => auth()->id(),
            'order_id' => $this->orderId,
            'product_id' => $this->productId,
            'shop_id' => $this->shopId,
            'review_text' => $this->review_text,
            'rating' => $this->rating,
        ]);

        session()->flash('message', 'Thank you for your review!');
        $this->dispatch('closeModal');

        return redirect()->route('my.orders');
    }

    public function render()
    {
        return view('livewire.user.modal.rate-order');
    }
}
