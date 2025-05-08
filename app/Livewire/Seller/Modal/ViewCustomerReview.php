<?php

namespace App\Livewire\Seller\Modal;

use Livewire\Component;
use App\Models\Review;
use App\Models\Order;

class ViewCustomerReview extends Component
{
    public $reviews = [];
    public $orderId;

    public function mount($orderId)
    {
        $this->orderId = $orderId;

        // Fetch reviews related to this order (you may need to adjust relationship logic here)
        $this->reviews = Review::where('order_id', $orderId)->with(['shop', 'user'])->get();
    }

    public function render()
    {
        return view('livewire.seller.modal.view-customer-review', [
            'reviews' => $this->reviews
        ]);
    }
}
