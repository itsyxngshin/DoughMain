<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;

class AddProduct extends Component
{

    use WithFileUploads;
    
    public $product_name, $product_description, $product_image, $category_id, $product_status, $product_price, $quantity;
    public $categories;

    public function mount()
    {
        $this->categories = Category::all(); // adjust model path if needed
    }

    public function store()
{
    dd("store method called");
    // Validate form data
    $validatedData = $this->validate([
        'product_name' => 'required|string|max:255',
        'product_description' => 'required|string|max:300',
        'product_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        'category_id' => 'required|exists:categories,id',
        'product_status' => 'required|in:available,unavailable',
        'product_price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:1',
    ]);

    dd($validatedData);

    // Handle image upload
    $imagePath = $this->product_image->store('products', 'public');

    // Create a new stock record (quantity will be stored here)
    $stock = \App\Models\Stock::create([
        'quantity' => $this->quantity,  // Store the quantity in the stocks table
    ]);

    // Create the product and associate it with the stock record
    Product::create([
        'name' => $this->product_name,
        'description' => $this->product_description,
        'image' => $imagePath,
        'category_id' => $this->category_id,
        'product_status' => $this->product_status,
        'product_price' => $this->product_price,
        'stock_id' => $stock->id,  // Associate the newly created stock_id (no quantity here)
    ]);

    // Success message
    session()->flash('message', 'Product created successfully!');

    // Optionally, reset the form after submission
    $this->reset();
}

    

    public function render()
    {
        return view('livewire.seller.add-product')->layout('layouts.seller');
    }

 
}
