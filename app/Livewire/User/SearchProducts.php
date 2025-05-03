<?php
namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\Log;

class SearchProducts extends Component
{  // The search term
    public $query;
    public $products;
    public $shops;

    public function mount()
    {
        $this->query = '';
        $this->products = [];
        $this->shops = [];
    }
    public function updatedQuery()
{
    $this->products = Product::with(['category', 'shop'])
        ->where('product_name', 'like', '%' . $this->query . '%')
        ->get();

    $this->shops = Shop::where('shop_name', 'like', '%' . $this->query . '%')->get();

}



    public function render()
    {
        return view('livewire.user.search-products', [
            'products' => $this->products,
        ]);
        
    }
    

}
