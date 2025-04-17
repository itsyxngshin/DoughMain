<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DoughMainComp;
use App\Http\Livewire\Counter;
use App\Http\Livewire\Posts;
use App\Http\Controllers\AuthController;
use App\Livewire\Auth\Register; // Import the Register class
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController; // Import AdminController
use App\Http\Controllers\Auth\CredentialAuthController; // Add this import at the top
use App\Http\Controllers\Auth\AuthenticatedSessionController; // Import AuthenticatedSessionController
use App\Livewire\Auth\Login;
use App\Http\Controllers\ProfileController;

// seller
// SELLER
use App\Livewire\Seller\ProductManagement;
use App\Livewire\Seller\AddProduct;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Credential; // Ensure this is the correct namespace for the Credential model
use Illuminate\Support\Facades\Hash;
use App\Livewire\Seller\Chat;
use App\Livewire\Seller\Dashboard;
use App\Livewire\Seller\OrderManagement;
use App\Livewire\Seller\TransactionsManagement;
use App\Livewire\Seller\UpdateProduct;

//  ADMIN
use App\Livewire\Admin\AdminDashboard;
//use App\Livewire\Admin\AdminProductManagement;
use App\Livewire\Admin\UpdateBakery;
use App\Livewire\Admin\AddBakery;
use App\Livewire\Admin\AdminBakeryManagement;
use App\Livewire\Admin\AdminChat;

// Forgot Password Controller
use App\Http\Controllers\Auth\ForgotPasswordController; // <--- Added this line

Route::middleware('guest')->group(function () {
    // Show the login form
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/passRegister', [AuthController::class, 'register'])->name('passRegister');
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/passLogin', [AuthController::class, 'login'])->name('passLogin');
});

// Forgot Password Route
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email'); // <--- Added this line

/*
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});
*/
Route::middleware('auth')->get('/home', function () {
    return view('homepage');
})->name('homepage');


Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('homepage');
    })->name('homepage');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Logout route


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('livewire.seller.dashboard');
    })->name('register');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    //Route::get('/admin/dashboard', [AdminController::class, 'index']);
});

#Route::get('/login', function () {
#   return view('livewire.auth.login'); // This loads the Blade view where you include Livewire component
#})->name('login');

# Route::post('/login', [CredentialAuthController::class, 'login']); // Fallback for any manual POST handling

Route::get('/register', function () {
    return view('livewire.auth.register');
})->name('register');

Route::get('/forgot', function () {
    return view('livewire.auth.two-factor');
})->name('forgot');

/*
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