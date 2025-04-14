<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class Login extends Component
{
    public $email;
    public $password;
    public $remember;
    

    public function login()
    {
        Log::debug('Login attempt data', [
            'email' => $this->email,
            'password' => $this->password,
            'remember' => $this->remember,
        ]);

        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        $this->addError('email', 'Invalid credentials.');
    }
    public function render()
    {
        return view('livewire.auth.login')->with('layout', 'components.layouts.app'); ;
    }
}