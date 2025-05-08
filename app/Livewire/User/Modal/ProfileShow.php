<?php

namespace App\Livewire\User\Modal;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileShow extends Component
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

    
    public function mount()
    {
        $user = Auth::user();

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone = $user->phone_number;
        $this->landmark = $user->location->landmark;
        $this->barangay = $user->location->barangay;
        $this->city = $user->location->city;
        $this->province = $user->location->province;
    }

    public function save()
    {
        $user = Auth::user();

        // Validate basic info
        $this->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Optional password change
        if ($this->current_password || $this->new_password) {
            $this->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8', // or use rules as needed
            ]);

            if (!Hash::check($this->current_password, $user->password)) {
                $this->addError('current_password', 'Current password is incorrect.');
                $this->dispatch('invalid-password');
                return;
            }

            $user->password = bcrypt($this->new_password);
        }

        // Update other fields
        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $user->location->update([
            'landmark' => $this->landmark,
            'barangay' => $this->barangay,
            'city' => $this->city,
            'province' => $this->province,
        ]);

        // Changes are already persisted using the update method above, no need to call save

        $this->dispatch('profile-update-success');
    }
    public function render()
    {
        return view('livewire.user.modal.profile-show');
    }
}
