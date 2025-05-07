<?php

namespace App\Livewire\User\Modal;

use Livewire\Component;
use App\Models\ModeOfPayment;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Cart;
use App\Models\CartItem;
use Livewire\WithDispatchesBrowserEvents; 
// Removed WithDispatchesBrowserEvents as it does not exist

class OrderProcess extends Component
{   
    public $cartItems = [];
    public $orderTotal = 0;
    public $paymentMethods = [];
    public $selectedPaymentMethod;
    public $reference;
    public $screenshot;
    public $deliveryAddress;
    
    use WithFileUploads;
    // ...


    // In your Livewire component
    public function submitPayment()
    {
        $this->validate([
            'selectedPaymentMethod' => 'required',
            'reference' => 'required|string|max:255',
            'screenshot' => 'nullable|image|max:2048',
        ]);

        // Validate the screenshot
        DB::beginTransaction();

        try {
            $screenshotPath = $this->screenshot 
            ? $this->screenshot->store('screenshots', 'public') 
            : null;

            $order = Order::create([
                'user_id' => Auth::id(),
                'shop_id' => $this->cartItems[0]->product->shop->id, // Access the shop ID of the first cart item
                'total_amount' => $this->orderTotal,
                'delivery_address' => $this->deliveryAddress,
                'date_arrangement' => now()->toDateString(), // For date (Y-m-d format)
                'time_arrangement' => now()->toTimeString(), // For time (H:i:s format)
                'status' => 'Pending',
            ]);

            foreach ($this->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id, 
                    'quantity' => $item->quantity,
                    'price' => $item->product->product_price,
                    'sub_total' => $item->product->product_price * $item->quantity,
                ]);
            }

            Payment::create([
                'user_id' => Auth::id(),
                'order_id' => $order->id,
                'payment_method_id' => $this->selectedPaymentMethod,
                'status' => 'completed',
                'reference_number' => $this->reference,
                'screenshot_path' => $screenshotPath,
                'paid_at' => now(),
            ]);

            $cart = Cart::where('user_id', Auth::id())->first();
            $cart?->cart_items()->delete(); // Deletes all items
            $cart?->delete(); // Deletes the cart itself
            Cart::create(['user_id' => Auth::id()]); // Optional: regenerate a fresh one

            DB::commit();

            // Emit event to browser
            $this->dispatch('payment-success');

        } 
        catch (\Exception $e) {
            DB::rollBack();
            dd('Order processing failed', ['error' => $e->getMessage()]);
            $this->addError('general', 'Something went wrong. Please try again.');
        }
    }

    public function mount()
    {
        $user = Auth::user();
        $this->deliveryAddress = $user->location->city . ', ' . $user->location->province;
        // Retrieve selected item IDs from the session
        $selectedIds = session('selected_cart_items', []);

        // Load cart items (with product info)
        $this->cartItems = CartItem::with('product.shop')
            ->whereIn('id', $selectedIds)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->get();

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
        return view('livewire.user.modal.order-process');
    }
}
