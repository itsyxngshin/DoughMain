<?php
namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class SearchProducts extends Component
{  // The search term
    public $query;
    public $products;

    public function mount()
    {
        $this->query = '';
        $this->products = [];
    }
    public function updatedQuery()
{
    $this->products = Product::with(['category', 'shop'])
        ->where(function($q) {
            $q->where('product_name', 'like', '%' . $this->query . '%')
              ->orWhereHas('category', function ($q) {
                  $q->where('category_name', 'like', '%' . $this->query . '%');
              })
              ->orWhereHas('shop', function ($q) {
                  $q->where('shop_name', 'like', '%' . $this->query . '%');
              });
        })
        ->get();
}



    public function render()
    {
        return view('livewire.user.search-products', [
            'products' => $this->products,
        ]);
        
    }
    

}
