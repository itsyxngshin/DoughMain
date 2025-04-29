<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Stock;
use App\Models\Shop;
use App\Models\StockMovement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AddProductController extends Controller
{
    public function create($shopId)
    {
       // Fetch the shop based on the shop_id from the URL
    $shop = Shop::find($shopId);

    // Fetch all categories
    $categories = Category::all();

    // Check if shop exists, if not, you can handle it accordingly
    if (!$shop) {
        return redirect()->route('productmanagement')->with('error', 'Shop not found.');
    }

    // Pass the shop and categories to the view
    return view('livewire.seller.add-product', compact('categories', 'shop'));
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string|max:500',
            'category_id' => 'required|integer',
            'product_price' => 'required|numeric',
            'product_status' => 'required|string|in:available,unavailable',
            'initial_stock' => 'required|integer|min:1',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('products', 'public');
        }

        $shop_id = 2; // Replace with 
       // Auth::user()->shop_id; //when ready

        $product = Product::create([
            'category_id' => $request->category_id,
            'shop_id' => $shop_id,
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_image' => $imagePath,
            'product_price' => $request->product_price,
            'product_status' => $request->product_status,
            'stock_id' => null,
        ]);

        $movement = StockMovement::create([
            'product_id' => $product->id,
            'quantity' => $request->initial_stock,
            'movement_type' => 'in',
            'change_date' => now(),
            'remarks' => 'Initial stock for product creation',
        ]);

        $stock = Stock::create([
            'product_id' => $product->id,
            'stock_movements_id' => $movement->id,
            'quantity' => $request->initial_stock,
            'last_updated' => now(),
        ]);

        $product->update(['stock_id' => $stock->id]);

        return redirect()->route('productmanagement')->with('success', 'Product successfully added.');


    } catch (\Exception $e) {
        \Log::error('Store failed: ' . $e->getMessage());
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}

    
    
}
