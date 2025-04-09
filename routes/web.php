<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DoughMainComp;
use App\Http\Livewire\Counter;
use App\Http\Livewire\Posts;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController; // Import AdminController
use App\Http\Controllers\Auth\CredentialAuthController; // Add this import at the top
use App\Livewire\Auth\Login;

//seller
use App\Livewire\Seller\ProductManagement;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Credential; // Ensure this is the correct namespace for the Credential model
use Illuminate\Support\Facades\Hash;

//admin
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\AdminProductManagement;
use App\Livewire\Seller\Dashboard;


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('livewire.seller.dashboard');
    })->name('register');

    //Route::get('/admin/dashboard', [AdminController::class, 'index']);
});

Route::get('/login', Login::class)->name('login'); // Points to Livewire component
Route::post('/login', [CredentialAuthController::class, 'login']); // Fallback for any manual POST handling

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