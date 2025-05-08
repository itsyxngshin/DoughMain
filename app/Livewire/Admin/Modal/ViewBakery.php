<?php

namespace App\Livewire\Admin\Modal;

use Livewire\Component;
use App\Models\Shop;
use App\Models\Stock;
use App\Models\StockMovements;
use App\Models\Products;


class ViewBakery extends Component
{
    public $shop;

    public function mount($shopId)
    {
        $this->shop = Shop::with(['products.stockMovements'])->findOrFail($shopId);
    }
    public function render()
    {
        return view('livewire.admin.modal.view-bakery');
    }
}
