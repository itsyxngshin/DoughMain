<?php

namespace App\Livewire\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'password' => Hash::make($this->password),
             $this->role_id => 0,
             $this->status_id => 0,
        ]);

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
