<?php

namespace App\Livewire;

use Livewire\Component;

class CheckoutModal extends Component
{
    // Mock data for items and payment method
    public $items = [
        ['name' => 'Item 1', 'price' => 200.00],
        ['name' => 'Item 2', 'price' => 150.00],
        ['name' => 'Item 3', 'price' => 250.00],
    ];

    public $paymentMethod = 'cash_on_delivery'; // Default payment method

    // Calculate total amount
    public function getTotalAmount()
    {
        return array_reduce($this->items, function ($sum, $item) {
            return $sum + $item['price'];
        }, 0);
    }

    // Get payment method text
    public function getPaymentMethodText()
    {
        switch ($this->paymentMethod) {
            case 'cash_on_pickup':
                return 'Cash on Pickup';
            case 'cash_on_delivery':
                return 'Cash on Delivery';
            case 'e_wallet':
                return 'E-Wallet';
            default:
                return 'No payment method selected';
        }
    }

    // Action when going back to the cart
    public function goBackToCart()
    {
        session()->flash('message', 'Going back to cart...');
    }

    // Action when confirming the order
    public function confirmOrder()
    {
        session()->flash('message', 'Order confirmed!');
    }

    public function render()
    {
        return view('livewire.checkout-modal');
    }
}
