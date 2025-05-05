<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DoughMainComp;
use Inertia\Inertia; // Import the Inertia facade
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
use App\Http\Controllers\CheckoutController;



// USER
use App\Livewire\User\Homepage;
use App\Livewire\User\ProductListingForShops;
use App\Livewire\User\ProductByCategory;
use App\Http\Controllers\CartController;
// Ensure the Cart class exists in the specified namespace
use App\Livewire\CartView;
use App\Livewire\PaymentChannel;
use App\Livewire\User\Checkout;
use App\Livewire\User\Orders;






// SELLER
use App\Livewire\Seller\ProductManagement;
//use App\Livewire\Seller\AddProduct;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Credential; // Ensure this is the correct namespace for the Credential model
use Illuminate\Support\Facades\Hash;
use App\Livewire\Seller\Chat;
use App\Livewire\Seller\Dashboard;
use App\Livewire\Seller\OrderManagement;
use App\Livewire\Seller\UpdateProduct;
use App\Http\Controllers\AddProductController;
use App\Http\Controllers\UpdateProductController;





// ADMIN
use App\Livewire\Admin\AdminDashboard;
//use App\Livewire\Admin\AdminProductManagement;
use App\Livewire\Admin\UsersManagement;
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
    Route::post('/shopRegister', [AuthController::class, 'shopRegister'])->name('shopRegister');
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

//AUTHENTICATED USER
Route::middleware(['auth', 'role:user'])->group(function () {
    //HOMEPAGE
    Route::get('/home', Homepage::class)->name('homepage');
    //CATEGORY PAGE
    Route::get('/Category/{id}', ProductByCategory::class)->name('category');

    //SHOP PRODUCT LISTINGS
    Route::get('/shops/{id}/products', ProductListingForShops::class)->name('shop.products');
    //CHECKOUT
    Route::post('/add-to-cart', [CartController::class, 'addToCart']);

    //PAYMENT CHANNEL
    

    //BASIC LOG-OUT
    Route::post('/logout', [AuthController::class, 'logout'])->name('userlogout');
    Route::prefix('user')->group(function () {
        Route::get('/payment', [PaymentChannel::class, ])->name('user.payments');
        Route::get('/payment/submit', [PaymentChannel::class, ])->name('payment. submit');
        Route::get('/myorders', Orders::class)->name('my.orders');
        //RENDER CART PAGE
       Route::get('/cart', [CartView::class, 'render'])->name('user.cart');
       Route::delete('/cart/{id}', [CartView::class, 'removeItem'])->name('cart.remove');
       Route::delete('/cart/remove/selected', [CartView::class, 'removeSelected'])->name('cart.remove.selected');
       //SEND TO CHECKOUT PAGE
       Route::get('/checkout', Checkout::class)->name('user.checkout');
       //RENDER PROFILE PAGE
       Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
       Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
       Route::post('/profile/update', [ProfileController::class, 'edit'])->name('profile.update');
    
        // Product Management Page for Admin (Livewire)
       // Route::get('/products', AdminProductManagement::class)->name('admin.products');
       
    });
});


// AUTHENTICATED SELLER
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::prefix('seller')->group(function() {
        // DASHBOARD
        Route::get('/dashboard', Dashboard::class)
        ->name('sellerdashboard');
        // PRODUCTS MANAGEMENT
        Route::get('/productsmanagement', ProductManagement::class)
        ->name('productmanagement');   
            //ADD PRODUCT PAGE FETCHING
            Route::get('/add-product/{shop_id}', [AddProductController::class, 'create'])->name('addproduct');
            // ADD PRODUCT PAGE POSTING
            Route::post('/add-product', [AddProductController::class, 'store'])->name('products.store');
            //UPDATE PRODUCT PAGE FETCHING
            Route::get('/products/{id}/edit', [UpdateProductController::class, 'edit'])->name('updateproduct');
            //UPDATE PRODUCT PAGE POSTING
            Route::put('/products/{id}', [UpdateProductController::class, 'update'])->name('products.update');
        // ORDER MANAGEMENT
        Route::get('seller/orders', OrderManagement::class)->name('ordermanagement');
        // CHAT FOR SELLERS
        Route::get('/chat', function () {
            return view('livewire.seller.chat'); 
        })->name('sellerchat');

        // LOGOUT FOR SELLER
        Route::post('/logout', [AuthController::class, 'logout'])->name('sellerlogout');
    });
});

//AUTHENTICATED ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    // ADMIN
    Route::prefix('admin')->group(function () {
        // ADMIN DASHBOARD
        Route::get('/dashboard', AdminDashboard::class)
        ->name('admin.dashboard');

        // BAKERY MANAGEMENT
        Route::get('/bakerymanagement', AdminBakeryManagement::class)
            ->name('admin.bakery');

        // CHAT FOR ADMIN
        Route::get('/chat', function () {
            return view('livewire.admin.admin-chat');
        })->name('admin.chat');

        // USER MANAGEMENT
        Route::get('/users', UsersManagement::class)
            ->name('admin.users');

        // LOGOUT FOR ADMIN
        Route::post('/logout', [AuthController::class, 'logout'])->name('adminlogout');
    });

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

//Route::get('/home', Homepage::class)->name('homepage');  FOR DELETION


Route::get('/products', function () {
    return view('products'); 
});

// Profile Routes
Route::get('/userprofile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


/* ADMIN
Route::prefix('admin')->group(function () {


    //Add bakery
    Route::get('bakerymanagement/add-bakery', function () {
        return view('livewire.admin.add-bakery');
    })->name('admin.addbakery');

    //Update Bakery
    Route::get('bakerymanagement/updatebakery', function () {
        return view('livewire.admin.update-bakery');
    })->name('admin.updatebakery');

    
});
*/
