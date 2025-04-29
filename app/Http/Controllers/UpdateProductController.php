<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\StockMovement;
use Illuminate\Support\Facades\Storage;

class UpdateProductController extends Controller
{
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Find the product by ID or fail if not found
        $categories = Category::all(); // Or however you fetch your categories
        return view('livewire.seller.update-product', compact('product', 'categories')); // Pass the product and categories to the view
    }

    public function update(Request $request, $id)
    {
        
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'product_name' => 'required|string|max:255',
                'product_description' => 'nullable|string|max:300',
                'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'product_price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'product_status' => 'required|in:available,unavailable',
                'add_stock' => 'nullable|numeric|min:1', // Add stock validation
            ]);

            // Find the existing product
            $product = Product::findOrFail($id);

            // Handle image upload
            if ($request->hasFile('product_image')) {
                // Delete old image if exists
                if ($product->product_image) {
                    Storage::delete('public/' . $product->product_image);
                }

                // Store the new image
                $path = $request->file('product_image')->store('products', 'public');
                $product->product_image = $path;
            }

            // Update product information
            $product->product_name = $validated['product_name'];
            $product->product_description = $validated['product_description'] ?? $product->product_description;
            $product->product_price = $validated['product_price'];
            $product->category_id = $validated['category_id'];
            $product->product_status = $validated['product_status'];

            // Update the product in the database
            $product->save();

            // Handle stock movement (add stock)
            if ($request->has('add_stock') && $validated['add_stock'] > 0) {
                // Record the stock addition (stock in)
                StockMovement::create([
                    'product_id' => $product->id,
                    'movement_type' => 'in',  // 'in' for adding stock
                    'quantity' => $validated['add_stock'],
                    'user_id' => auth()->id(), // Assuming authenticated user
                ]);

                // Update the product's stock level
                $product->initial_stock += $validated['add_stock'];
                $product->save();
            }

            // Redirect back with a success message
            return redirect()->route('productmanagement')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            // Log the exception with details
            \Log::error('Update Failed', [
                'error_message' => $e->getMessage(),
                'exception' => $e
            ]);

            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
