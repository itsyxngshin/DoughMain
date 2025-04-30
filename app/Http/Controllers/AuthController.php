<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Shop;
use App\Models\Role;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */

    public function register(Request $request)
    {
        Log::info($request->all());

        $user = new User();
        $user->username = $request->input('username');
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->nationality = $request->nationality;
        $user->location_id = 0;
        $user->role_id = 1;
        $user->user_status_id = 1;
        $user->save();

        return view('livewire.auth.login')->with('success', 'Register successfully');
    }

    public function shopRegister(Request $request)
    {
        Log::info($request->all());

        $user = new User();
        $user->username = $request->input('username');
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->nationality = $request->nationality;
        $user->location_id = 0;
        $user->role_id = 2;
        $user->user_status_id = 1;
        $user->save();

         // Create the Shop linked to the User
        $shop = new Shop();
        $shop->manage_id = $user->id;
        $shop->shop_name = $request->shop_name;
        $shop->save();

        return view('livewire.auth.login')->with('success', 'Register successfully');
    }

    public function registerView()
    {
        return view('livewire.auth.register')->with('layout', 'components.layouts.app');
    }
    public function loginView()
    {
        return view('livewire.auth.login')->with('layout', 'components.layouts.app');
    }

    /**
     * Handle the login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

     public function login(Request $request)
{
    $credentials = [
        'email' => $request->email,
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials)) {
        $user = User::where('id', Auth::id())->with('role')->first(); // Eager load the role

        if (!$user->role) {
            Auth::logout();
            return redirect('/login')->with('error', 'Role not assigned.');
        }

        $redirect = match($user->role->role_name) {
            'admin' => route('admin.dashboard'),
            'user' => route('homepage'),
            'seller' => route('seller.dashboard'),
            default => route('homepage'),
        };

        return redirect($redirect)->with('success', 'Login successful!');
    }

    return back()->with('error', 'Invalid email or password.');
}
    
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'Logged out successfully.');
}
}