<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Credential;
use Illuminate\Support\Facades\Hash;


class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        // Check if the credentials exist in the credentials table
        $credential = Credential::where('email', $this->email)->first();

        if ($credential && Hash::check($this->password, $credential->password)) {
            Auth::login($credential->user, $this->remember); // Log in the related User model

            // Redirect after successful login
            return redirect()->intended('/admin/dashboard');
        }

        // If invalid credentials, show error
        session()->flash('error', 'Invalid email or password');
    }

    public function render(){

        return view('livewire.auth.login')->with('layout', 'components.layouts.app'); // Specify layout here;
    }
}