<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DoughMainComp;
use App\Http\Livewire\Counter;
use App\Http\Livewire\Posts;
use App\Http\Controllers\DashboardController;
use App\Livewire\Auth\Login;
use App\Http\Controllers\ProfileController;

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
use App\Livewire\Admin\UsersManagement;
use App\Livewire\Admin\UpdateBakery;
use App\Livewire\Admin\AddBakery;
use App\Livewire\Admin\AdminBakeryManagement;
use App\Livewire\Admin\AdminChat;



Route::get('/login', function () {
    return view('livewire.auth.login');
})->name('login');

Route::get('/register', function () {
    return view('livewire.auth.register');
})->name('register');

Route::get('/forgot', function () {
    return view('livewire.auth.two-factor');
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

// Profile Routes
Route::get('/userprofile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Sellers
Route::prefix('seller')->group(function() {
    Route::get('/products', ProductManagement::class)
    ->name('productmanagement');
    
    //seller dashboard
    Route::get('/dashboard', function () {
        return view('livewire.seller.dashboard'); 
    })->name('sellerdashboard');

    //order management
    Route::get('/orders', OrderManagement::class)
    ->name('ordermanagement');

    //transactions management
    Route::get('/transactions', TransactionsManagement::class)
    ->name('transactionmanagement');

    //seller chat
    Route::get('/chat', function () {
        return view('livewire.seller.chat'); 
    })->name('sellerchat');

    //add products page
    Route::get('/products/add', AddProduct::class)->name('addproduct');

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
    Route::get('/bakerymanagement', AdminBakeryManagement::class)
        ->name('admin.bakery');

    //Admin chat
    Route::get('/chat', function () {
        return view('livewire.admin.admin-chat');
    })->name('admin.chat');

    //Users Management
    Route::get('/Users', UsersManagement::class)
        ->name('admin.users');

    //Add bakery
    Route::get('bakerymanagement/add-bakery', function () {
        return view('livewire.admin.add-bakery');
    })->name('admin.addbakery');

    //Update Bakery
    Route::get('bakerymanagement/updatebakery', function () {
        return view('livewire.admin.update-bakery');
    })->name('admin.updatebakery');

    
});