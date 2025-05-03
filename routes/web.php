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
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CheckoutController;

// seller
use App\Livewire\Seller\ProductManagement;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Credential; // Ensure this is the correct namespace for the Credential model
use Illuminate\Support\Facades\Hash;

// admin
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\AdminProductManagement;
use App\Livewire\Seller\Dashboard;

// Forgot Password Controller
use App\Http\Controllers\Auth\ForgotPasswordController; // <--- Added this line
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


Route::middleware('guest')->group(function () {
    // Show the login form
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('user/register', [AuthController::class, 'register'])->name('passData');
    Route::post('shop/Register', [AuthController::class, 'shopRegister'])->name('shopRegister');
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/passLogin', [AuthController::class, 'login'])->name('passLogin');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email'); // <--- Added this line
});

// Forgot Password Route


/*
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});
*/
Route::middleware('auth')->get('/home', function () {
    return view('homepage');
})->name('homepage');

Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');

//AUTHENTICATED USER
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/home', function () {
        return view('homepage');
    })->name('homepage');
    Route::prefix('user')->group(function () {
       Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
       Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
       Route::post('/profile/update', [ProfileController::class, 'edit'])->name('profile.update');
    
        // Product Management Page for Admin (Livewire)
        Route::get('/products', AdminProductManagement::class)->name('admin.products');
    });
});

//SELLER AUTHENTICATED USER
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::prefix('seller')->group(function() {
        Route::get('/products', function () {
            return view('livewire.seller.product-management'); 
        })->name('productmanagement');
        Route::get('/dashboard', function () {
            return view('livewire.seller.dashboard'); 
        })->name('sellerdashboard');
    });
});

//AUTHENTICATED ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    // ADMIN
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        // Product Management Page for Admin (Livewire)
        Route::get('/products', AdminProductManagement::class)->name('admin.products');
    });
    //Route::get('/admin/dashboard', [AdminController::class, 'index']);
});

Route::middleware(['web'])->group(function () {
    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/auth/callback/google', [GoogleController::class, 'handleGoogleCallback']);
});

// SELLERS 


// Logout route



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


