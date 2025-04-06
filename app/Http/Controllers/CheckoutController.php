<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // You can pass cart data here later if needed
        return view('checkout');
    }
}
