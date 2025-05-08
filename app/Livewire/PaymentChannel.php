<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CartItem; // Ensure this is the correct namespace for CartItem
use Illuminate\Support\Facades\Auth;
use App\Models\Payment; // Ensure this is the correct namespace for Payment
use App\Models\Order; // Ensure this is the correct namespace for Order
use Livewire\WithFileUploads; // Import the WithFileUploads trait
use App\Models\ModeOfPayment; // Ensure this is the correct namespace for ModeOfPayment
use Illuminate\Support\Facades\DB; // Import the DB facade
use App\Models\OrderItem; // Ensure this is the correct namespace for OrderItem

class PaymentChannel extends Component
{      
    public $cartItems = [];
    public $orderTotal = 0;
    public $paymentMethods = [];
    public $selectedPaymentMethod;
    public $reference;
    public $screenshot;
    
    use WithFileUploads;

    // ...

    protected $rules = [
        'selectedPaymentMethod' => 'required|exists:mode_of_payments,id',
        'reference' => 'required|string|max:255',
        'screenshot' => 'required|image|max:2048', // Max 2MB
    ];

    // In your Livewire component
    public function submitPayment()
    {
        
        $this->validate([
            
            'mode_of_payment_id' => 'required|exists:mode_of_payments,id',
            'reference' => 'required|string',
            'screenshot' => 'required|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $screenshotPath = $this->screenshot->store('payments', 'public');

            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $this->calculateCartTotal(),
                'status' => 'Pending',
            ]);

            foreach ($this->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'shop_id' => $item['product']['shop_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['product']['product_price'],
                    'sub_total' => $item['sub_total'],
                ]);
            }

            Payment::create([
                'user_id' => Auth::id(),
                'order_id' => $order->id,
                'mode_of_payment_id' => $this->mode_of_payment_id,
                'status' => 'completed',
                'reference_number' => $this->reference,
                'screenshot_path' => $screenshotPath,
                'paid_at' => now(),
            ]);

            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            // Emit event to browser
            $this->dispatchBrowserEvent('payment-success');

        } 
        catch (\Exception $e) {
            DB::rollBack();
            $this->addError('general', 'Something went wrong. Please try again.');
        }
    }

    public function mount()
    {
        // Retrieve selected item IDs from the session
        $selectedIds = session('selected_cart_items', []);

        // Load cart items (with product info)
        $this->cartItems = CartItem::with('product.shop')
            ->whereIn('id', $selectedIds)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->get()
            ->toArray();

        // Redirect if no items are selected
        if (empty($this->cartItems)) {
            return redirect()->route('user.cart')->with('error', 'No items selected for checkout.');
        }
        // Calculate order total
        $this->orderTotal = collect($this->cartItems)->sum(function($item) {
            return $item['product']['product_price'] * $item['quantity'];
        });
        // Load payment methods
        // Assuming you have a ModeOfPayment model
        $this->paymentMethods = ModeOfPayment::all();
    }
    public function render()
    {
        return view('livewire.payment-channel', [
            'cartItems' => $this->cartItems,
            'orderTotal' => $this->orderTotal
        ])->layout('components.layouts.navbar');
    }
}
