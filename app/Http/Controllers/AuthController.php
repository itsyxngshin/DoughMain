<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Shop;
use App\Models\Role;
use App\Models\Cart; // Add this line to import the Cart model

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

        $validatedData = $request->validate([
            'username' => 'required|string|unique:users',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'nationality' => 'required|string',
        ]);

        

        DB::transaction(function () use ($validatedData) {
            // Create user
            $user = User::create([
                'username' => $validatedData['username'],
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'phone_number' => $validatedData['phone_number'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'nationality' => $validatedData['nationality'],
                'location_id' => 0, // Consider making this nullable or setting a default location
                'role_id' => 1, // Consider using constants or enums for role IDs
                'user_status_id' => 1, // Consider using constants or enums for status IDs
                
            ]);
    
            // Create cart for the user
            Cart::create([
                'user_id' => $user->id,
                // Add any other default cart attributes if needed
            ]);
    
            Log::info('New user registered with cart', ['user_id' => $user->id]);
        });

        return view('livewire.auth.login')->with('success', 'Register successfully');
    }

    public function shopRegister(Request $request)
{
    Log::info($request->all());

    // Validate inputs (optional but recommended)
    $validated = $request->validate([
        'username' => 'required|unique:users',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'phone_number' => 'required',
        'nationality' => 'required',
        'shop_name' => 'required|string|max:255',
        'description' => 'nullable|string'
    ]);

    // Create the User
    DB::transaction(function () use ($validated) {
        // Create user
        $user = User::create([
            'username' => $validated['username'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'nationality' => $validated['nationality'],
            'location_id' => 0, // Consider default location
            'role_id' => 2, // Typically 2 for shop owners
            'user_status_id' => 1, // Active status
        ]);

        // Create shop
        $shop = Shop::create([
            'manage_id' => $user->id,
            'shop_name' => $validated['shop_name'],
            'shop_address_id' => $user->location_id,
            // Add other default shop fields as needed
        ]);

        

        // Create cart for the user
        Cart::create([
            'user_id' => $user->id,
        ]);

        Log::info('New shop owner registered', [
            'user_id' => $user->id,
            'shop_id' => $shop->id
        ]);
    });
    

    return view('livewire.auth.login')->with('success', 'Registered successfully as a shop');
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
            $user = User::where('id', Auth::id())->with('role')->first(); // Eager-load 'role'
        
            if (!$user->role) {
                return back()->with('error', 'No role assigned to user.');
            }
        
            $redirect = match($user->role->role_name) {
                'admin' => route('admin.dashboard'),
                'user' => route('homepage'),
                'seller' => route('sellerdashboard'),
                default => route('homepage'),
            };
        
            return redirect($redirect)->with('success', 'Login successful!');
        }

        return back()->with('error', 'Invalid credentials. Please try again.');
    }
    
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'Logged out successfully.');
}
}