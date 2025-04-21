<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\User;
use App\Modelss\Stock;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'stock', 'stockMovements'])->get();
        return view('livewire.seller.product-management', compact('products'));
    }

}
