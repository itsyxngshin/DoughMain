<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart'); // Make sure your Blade file is named 'cart.blade.php'
    }
}
