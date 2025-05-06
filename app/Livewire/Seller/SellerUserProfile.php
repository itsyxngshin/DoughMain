<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Shop;
use App\Models\User;
use App\Models\Location;


class SellerUserProfile extends Component
{
    public $shop;
    public $user;
    public $location;

    public $shop_name, $shop_description, $first_name, $last_name, $email, $phone_number;
    public $region, $province, $city, $barangay, $street;
    public $shop_logo;

    public function mount()
{
    $this->shop = Shop::with(['user', 'location', 'shopLogo'])->where('manage_id', auth()->id())->firstOrFail();
    $this->location = $this->shop->location ?? new Location(); // fallback if null


}


    public function render()
    {
        return view('livewire.seller.seller-user-profile')->layout('components.layouts.seller');
    }
}
