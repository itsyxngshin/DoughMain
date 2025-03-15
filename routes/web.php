<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DoughMainComp;
use App\Http\Livewire\Counter;
use App\Http\Livewire\Posts;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', function () {
    return view('admin/dashboard'); // This renders the Blade template
});
/*Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');*/

Route::get('/', function () {
    return view('welcome');
});
