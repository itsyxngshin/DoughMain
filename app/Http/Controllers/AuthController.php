<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

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
        $user->role_id = 0;
        $user->status_id = 0;
        $user->save();

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
            return redirect('/home')->with('success', 'Login successful!');
        }
        return back()->with('error', 'Invalid email or password');
    }
    
    public function blue(Request $request)
    {
        // Validate the login data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Log login attempt data for debugging
        Log::debug('Login attempt', [
            'email' => $request->email,
            'remember' => $request->remember,
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            // Redirect to the intended URL or dashboard
            return redirect()->intended('/dashboard');
        }

        // Return with an error message if authentication fails
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}