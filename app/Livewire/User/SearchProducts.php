<?php
namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class SearchProducts extends Component
{  
    public $query = '';
    public $products = [];
    public $shops = [];
    public $categories = [];

    public function updatedQuery()
    {
        if (strlen($this->query) >= 2) {
            $this->shops = Shop::where('shop_name', 'like', '%' . $this->query . '%')->get();

            $this->products = Product::with(['shop', 'category'])
                ->where('product_name', 'like', '%' . $this->query . '%')
                ->orWhere('product_description', 'like', '%' . $this->query . '%')
                ->get();

            $this->categories = Category::where('category_name', 'like', '%' . $this->query . '%')->get();
        } else {
            $this->shops = [];
            $this->products = [];
            $this->categories = [];
        }
    }



    public function render()
    {
        return view('livewire.user.search-products', [
            'products' => $this->products,
        ]);
        
    }
    

}
