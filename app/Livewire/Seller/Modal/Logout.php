<?php

namespace App\Livewire\Seller\Modal;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // or route to your login page
    }

    public function render()
    {
        return view('livewire.seller.modal.logout');
    }
}
