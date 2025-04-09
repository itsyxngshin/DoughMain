<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credential;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CredentialAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check if the credentials exist in the credentials table
        $credential = Credential::where('email', $request->email)->first();

        if ($credential && Hash::check($request->password, $credential->password)) {
            // If credentials are correct, log in the user
            Auth::login($credential->user); // Log in the related User model (not Credential)

            // Regenerate session to avoid session fixation attacks
            $request->session()->regenerate();

            return redirect()->intended(match ($credential->user->role->role_name) {
                'admin' => route('livewire.admin.admin-dashboard'),
                'seller' => route('livewire.seller.dashboard'),
                'user' => route('homepage'),
    
            });
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }
}
