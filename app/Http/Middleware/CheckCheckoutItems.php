<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCheckoutItems
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    if (!session()->has('selected_cart_items') || empty(session('selected_cart_items'))) {
        return redirect()->route('user.cart')->with('error', 'Please select items to checkout');
    }

    return $next($request);
}
}
