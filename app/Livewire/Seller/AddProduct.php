<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Stock;
use App\Models\StockMovement; // Make sure to import StockMovement model
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AddProduct extends Component
{
    public $category_id;
    public $product_name;
    public $product_description;
    public $product_image;
    public $product_price;
    public $product_status;
    public $initial_stock;

    public $categories;

    

    protected $rules = [
        'product_name' => 'required|string|max:255',
        'product_description' => 'required|string|max:500',
        'category_id' => 'required|integer',
        'product_price' => 'required|numeric',
        'product_status' => 'required|integer',
        'initial_stock' => 'required|integer|min:1', 
    ];

    
    public function mount()
    {
        
        // Fetch all categories
        $this->categories = Category::all();

    }
    
    public function submit()
    {
        // Validate the data
        $this->validate();

        
        // Get the shop_id from the authenticated user
        $shop_id = Auth::user()->shop_id; // Assuming the 'shop_id' field exists on the User model

        // Create the product record
        //$product = Product::create
        Log::info('Livewire AddProduct Submit:',[
            'category_id' => $this->category_id,
            'shop_id' => $shop_id,  // Use the dynamically retrieved shop_id
            'product_name' => $this->product_name,
            'product_description' => $this->product_description,
            'product_image' => $imagePath,
            'product_price' => $this->product_price,
            'product_status' => $this->product_status,
            'stock_id' => null, // Will update after stock is created
        ]);
        $imagePath = null;

                // Check if product image is provided and store it
                if ($this->product_image) {
                    try {
                        $imagePath = $this->product_image->store('products', 'public');
                    } catch (\Exception $e) {
                        session()->flash('error', 'Image upload failed.');
                        return;
                    }
                }

        // Create stock movement for initial stock
        $movement = StockMovement::create([
            'product_id' => $product->id,
            'quantity' => $this->initial_stock,
            'movement_type' => 'in',
            'change_date' => now(),
            'remarks' => 'Initial stock for product creation',
        ]);

        // Create stock record
        $stock = Stock::create([
            'product_id' => $product->id,
            'stock_movements_id' => $movement->id,
            'quantity' => $this->initial_stock,
            'last_updated' => now(),
        ]);

        // Update product with the stock ID
        $product->update([
            'stock_id' => $stock->id,
        ]);

        session()->flash('success', 'Product successfully added.');

        // Reset the form fields
        $this->reset([
            'category_id', 'product_name', 'product_description', 'product_image',
            'product_price', 'product_status', 'initial_stock',
        ]);
    }

    public function render()
    {
        return view('livewire.seller.add-product')->layout('components.layouts.seller');
    }
}
