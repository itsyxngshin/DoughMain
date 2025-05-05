<?php

namespace App\Livewire\User\Modal;

use Livewire\Component;
use App\Models\Review;
use App\Models\Order;
use App\Models\Shop;

class ClickToSeeReviews extends Component
{
    public $shopId;
    public $reviews = [];
    public $averageRating = 0;

    public function mount($shopId)
    {
        \Log::info('ClickToSeeReviews mount received shopId', ['shopId' => $shopId]);
    
        $this->shopId = $shopId;
    
        $shop = \App\Models\Shop::with(['reviews.user'])->find($this->shopId);
    
        if (!$shop) {
            \Log::error("Shop not found with ID: " . $this->shopId);
            abort(404, 'Shop not found.');
        }
    
        \Log::info('Shop and reviews loaded', [
            'shop_id' => $shop->id,
            'review_count' => $shop->reviews->count(),
        ]);
    
        $this->reviews = $shop->reviews;
        $this->averageRating = round($this->reviews->avg('rating'), 1);
    }
    


    public function render()
    {
        return view('livewire.user.modal.click-to-see-reviews');
    }
}

