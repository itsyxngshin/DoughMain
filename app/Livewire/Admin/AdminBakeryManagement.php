<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Stock;
use App\Models\StockMovements;
use App\Models\Shop;
use App\Models\ShopLogo;

class AdminBakeryManagement extends Component
{
    public $shops;

    public function mount()
    {
        $this->shops = Shop::all();
    }
    public function render()
    {
        return view('livewire.admin.admin-bakery-management')
        ->layout('components.layouts.admin');
    }
}
