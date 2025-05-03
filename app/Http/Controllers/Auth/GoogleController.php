<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Separate first and last name
            $names = explode(' ', $googleUser->getName(), 2);

            // Find or create the user
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'first_name' => $names[0],
                    'last_name' => $names[1] ?? '',
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]
            );

            // Assign default role if missing
            if (!$user->role_id) {
                $defaultRoleId = 1; // Assuming 1 is the default role ID
                $role = Role::find($defaultRoleId);
                if (!$role) {
                    return redirect('/login')->withErrors('Default role not found.');
                }
                $user->role_id = $defaultRoleId;
                $user->save();
            }

            // Log out existing user if it's a different user
            if (Auth::check() && Auth::id() !== $user->id) {
                Auth::logout();
            }

            // Log in and regenerate session
            Auth::login($user);
            request()->session()->regenerate();

            // Redirect based on role
            $roleName = optional($user->role)->role_name;
            $redirect = match ($roleName) {
                'admin' => route('admin.dashboard'),
                'seller' => route('seller.dashboard'),
                'user' => route('homepage'),
                default => route('homepage'),
            };

            return redirect($redirect)->with('success', 'Login successful!');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Google login failed: ' . $e->getMessage());
        }
    }
}
