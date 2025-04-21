<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\Payment;
use App\Models\Shop;
use App\Models\Order;


class TransactionsManagement extends Component
{
   
    public $payments;

    public function mount(){
        $this->payments = Payment::with(['user','order','mode_of_payment', 'shop'])->get();
    }

    public function render()
    {
        return view('livewire.seller.transactions-management')->layout('layouts.seller');
    }
}
