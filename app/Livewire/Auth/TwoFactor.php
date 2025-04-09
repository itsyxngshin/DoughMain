<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class TwoFactor extends Component
{
    public function render()
    {
        return view('livewire.auth.two-factor');
    }

    public $digits = ['', '', '', '', '', ''];
    public $error;

    public function verify()
    {
        $code = implode('', $this->digits);
        $user = Auth::user();

        if ($user->tfa_code === $code) {
            session()->flash('success', 'TFA Verified Successfully!');
            return redirect()->route('dashboard');
        }

        $this->error = 'Invalid TFA code.';
    }

}
