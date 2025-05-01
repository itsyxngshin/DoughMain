<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'cart_id' => 'required|exists:carts,id',  // Ensure the cart exists
            'product_id' => 'required|exists:products,id',  // Ensure the product exists
            'quantity' => 'required|integer|min:1',  // Quantity must be at least 1
            'sub_total' => 'required|numeric',  // Ensure sub_total is a valid number
        ]);

        // Insert into the cart_items table
        CartItem::create([
            'cart_id' => $request->cart_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'sub_total' => $request->sub_total,
        ]);

        // Return a response indicating success
        return response()->json(['success' => true]);
    }
}
