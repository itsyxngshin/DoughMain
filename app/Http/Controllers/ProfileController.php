<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('userprofile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user()->load('location');
        return view('userprofile', compact('user'));
    }

    public function update(Request $request)
{
    
   
    // Debugging request data
    // Continue with the rest of the code...


    $request->validate([
        'first_name'       => 'required|string|max:255',
        'last_name'        => 'required|string|max:255',
        'email'            => 'required|email|unique:users,email,' . Auth::id(),
        'phone'            => 'nullable|string|max:15',
        'street'          => 'nullable|string|max:255',
        'barangay'         => 'nullable|string|max:255',
        'city'             => 'nullable|string|max:255',
        'province'         => 'nullable|string|max:255',
        'region'           => 'nullable|string|max:255',
        'landmark'         => 'nullable|string',
        'latitude'         => 'nullable|numeric',
        'longitude'        => 'nullable|numeric',
        'current_password' => 'nullable|required_with:new_password',
        'new_password'     => 'nullable|string|min:8|confirmed',
    ]);

    $user = Auth::user()->load('location');


    // Update user basic info
    $user->update([
        'first_name'   => $request->first_name,
        'last_name'    => $request->last_name,
        'email'        => $request->email,
        'phone_number' => $request->phone,
         
    ]);

    // Password update
    if ($request->filled('new_password')) {
        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
        } else {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
    }
    //dd($request->all());
    // Update or create location
    $locationData = [
        'street'   => $request->street,
        'barangay'  => $request->barangay,
        'city'      => $request->city,
        'province'  => $request->province,
        'region'    => $request->region,
        'landmark'  => $request->landmark,
        'latitude'  => $request->latitude ?? 0,
        'longitude' => $request->longitude ?? 0,
    ];

    $user->location()->updateOrCreate(
        ['user_id' => $user->id],
        $locationData
    );

    return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
}

}
