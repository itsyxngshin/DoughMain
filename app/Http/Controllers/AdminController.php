<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credential;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all users with their roles
        $users = Credential::with('user.role')->get();

        // Pass the users to the view
        return view('admin.dashboard', compact('users'));
    }

    public function show($id)
    {
        // Fetch a specific user by ID
        $user = Credential::with('user.role')->findOrFail($id);

        // Pass the user to the view
        return view('admin.user.show', compact('user'));
    }
}
