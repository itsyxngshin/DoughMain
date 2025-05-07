<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileForm extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $landmark;
    public $barangay;
    public $city;
    public $province;

    public $current_password;
    public $new_password;
    public function render()
    {
        return view('livewire.profile-form')->layout('components.layouts.navbar');
    }

}
