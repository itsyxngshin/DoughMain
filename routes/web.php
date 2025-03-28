<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DoughMainComp;
use App\Http\Livewire\Counter;
use App\Http\Livewire\Posts;
use App\Http\Controllers\DashboardController;
use App\Livewire\Auth\Login;

/*Kindly indicate the definition of the controllers and livewires before middleware */ 

Route::get('/login', function (){
    return view('livewire.auth.login');
})->name('login');

Route::get('/register', function () {
    return view('livewire.auth.registration');
})->name('register');

Route::get('/confirm', function () {
    return view('livewire.auth.tfa');
})->name('tfa');


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


Route::prefix('admin')->group(function () {
    /*Route::get('/dashboard', function () {
        return view('admin/dashboard'); // This renders the Blade template
    });*/

    /*This is the middlewware for the authentication of the user roles in the system*/  
});

Route::prefix('seller')->group(function () {
    /*This is the middlewware for the authentication of the user roles in the system*/  
    /*Insert the route for the seller view in the system*/ 

});