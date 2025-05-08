<?php



namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Product;
use App\Models\ShopLogo;

class ProductListingForShops extends Component
{
    public $shopId;
    public $categories;
    public $bakery;
    public $productsByCategory;

    public function mount($id)
    {
        $this->shopId = $id;
        $this->bakery = Shop::with('shopLogo')->find($this->shopId);

        // Fetch categories associated with this shop
        $this->categories = Category::all(); // Assuming categories are independent of shop

        // Fetch products associated with this shop and group them by category_id
        $this->productsByCategory = Product::where('shop_id', $this->shopId)  // Use $this->shopId
        ->where('product_status', 'available')
        ->with('category')  // Eager load category
        ->get();
    }

    
    public function render()
    {
        return view('livewire.user.product-listing-for-shops')->layout('components.layouts.navbar');
    }
}
