<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DoughMainComp;
use App\Http\Livewire\Counter;
use App\Http\Livewire\Posts;
use App\Http\Controllers\DashboardController;
use App\Livewire\Auth\Login;

//seller
use App\Livewire\Seller\ProductManagement;
use App\Http\Controllers\ProductController;

//admin
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\AdminProductManagement;
use App\Livewire\Seller\Dashboard;



Route::get('/login', function () {
    return view('livewire.auth.login');
})->name('login');

Route::get('/register', function () {
    return view('user_register');
})->name('register');

Route::get('/forgot', function () {
    return view('password.request');
})->name('forgot');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/dashboard', function () {
    return view('admin/dashboard'); // This renders the Blade template
});
/*Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/homepage', function () {
    return view('homepage'); 
});

Route::get('/products', function () {
    return view('products'); 
});


//SELLERS 
Route::prefix('seller')->group(function() {
    Route::get('/products', function () {
        return view('livewire.seller.product-management'); 
    })->name('productmanagement');

    Route::get('/dashboard', function () {
        return view('livewire.seller.dashboard'); 
    })->name('sellerdashboard');
});







//ADMIN

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Product Management Page for Admin (Livewire)
    Route::get('/products', AdminProductManagement::class)->name('admin.products');
});