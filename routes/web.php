<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DoughMainComp;
use App\Http\Livewire\Counter;
use App\Http\Livewire\Posts;
use App\Http\Controllers\DashboardController;
use App\Livewire\Auth\Login;

// SELLER
use App\Livewire\Seller\ProductManagement;
use App\Livewire\Seller\AddProduct;
use App\Http\Controllers\ProductController;
use App\Livewire\Seller\Chat;
use App\Livewire\Seller\Dashboard;
use App\Livewire\Seller\OrderManagement;
use App\Livewire\Seller\TransactionsManagement;
use App\Livewire\Seller\UpdateProduct;

// ADMIN
use App\Livewire\Admin\AdminDashboard;
//use App\Livewire\Admin\AdminProductManagement;
use App\Livewire\Admin\UpdateBakery;
use App\Livewire\Admin\AddBakery;
use App\Livewire\Admin\AdminBakeryManagement;
use App\Livewire\Admin\AdminChat;



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
    //product management
    Route::get('/products', function () {
        return view('livewire.seller.product-management'); 
    })->name('productmanagement');

    //seller dashboard
    Route::get('/dashboard', function () {
        return view('livewire.seller.dashboard'); 
    })->name('sellerdashboard');

    //order management
    Route::get('/orders', function () {
        return view('livewire.seller.order-management'); 
    })->name('ordermanagement');

    //transactions management
    Route::get('/transactions', function () {
        return view('livewire.seller.transactions-management'); 
    })->name('transactionmanagement');

    //seller chat
    Route::get('/chat', function () {
        return view('livewire.seller.chat'); 
    })->name('sellerchat');

    //add products page
    Route::get('/products/add', function () {
        return view('livewire.seller.add-product'); 
    })->name('addproduct');

    //update products page
    Route::get('/products/update', function () {
        return view('livewire.seller.update-product'); 
    })->name('updateproduct');

    //adding product Post
    //Route::post('products/add', [AddProduct::class, 'store'])->name('addproduct');
});







//ADMIN

Route::prefix('admin')->group(function () {

    //Admin dashboard
    Route::get('/dashboard', function () {
        return view('livewire.admin.admin-dashboard');
    })->name('admin.dashboard');

    //bakery management
    Route::get('/bakerymanagement', function () {
        return view('livewire.admin.admin-bakery-management');
    })->name('admin.bakery');

    //Admin chat
    Route::get('/chat', function () {
        return view('livewire.admin.admin-chat');
    })->name('admin.chat');

    //Users Management
    Route::get('/Users', function () {
        return view('livewire.admin.users-management');
    })->name('admin.users');

    //Add bakery
    Route::get('bakerymanagement/add-bakery', function () {
        return view('livewire.admin.add-bakery');
    })->name('admin.addbakery');

    //Update Bakery
    Route::get('bakerymanagement/updatebakery', function () {
        return view('livewire.admin.update-bakery');
    })->name('admin.updatebakery');

    
});