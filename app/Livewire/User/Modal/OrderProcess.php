<?php

namespace App\Livewire\User\Modal;

use Livewire\Component;
use App\Models\ModeOfPayment;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\StockMovement;
use App\Models\ShopPaymentDetail;
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
    public $shopPaymentDetail;
    
    use WithFileUploads;

    public function updatedSelectedPaymentMethod($value)
    {
        // Check if a valid payment method is selected
        if ($value) {
            // Assuming $shopId is derived from your cart items or logic
            $shopId = optional($this->cartItems->first())->product->shop_id; // Replace with actual logic
    
            // Fetch the shop payment details based on the selected method
            $this->shopPaymentDetail = ShopPaymentDetail::where('shop_id', $shopId)
                ->where('mode_of_payment_id', $value)
                ->first();
        } else {
            // If no payment method is selected, clear the payment details
            $this->shopPaymentDetail = null;
        }
    }

    
    public function submitPayment()
{
    $this->validate([
        'selectedPaymentMethod' => 'required',
        'reference' => $this->selectedPaymentMethod == 3 || $this->selectedPaymentMethod == 4 ? 'nullable|string|max:255' : 'required|string|max:255',  // Make reference optional for payment methods 3 and 4
        'screenshot' => $this->isScreenshotRequired() ? 'nullable|image|max:2048' : 'nullable',
    ]);
    
    DB::beginTransaction();
    
    try {
        // Handle screenshot based on payment method
        $screenshotPath = $this->isScreenshotRequired()
            ? ($this->screenshot ? $this->screenshot->store('screenshots', 'public') : null)
            : 'screenshots/screenshotnotneeded.jpg';

        $this->createOrdersPerShop($screenshotPath);

        $cart = Cart::where('user_id', Auth::id())->first();
        $cart?->cart_items()->delete();
        $cart?->delete();
        Cart::create(['user_id' => Auth::id()]);

        DB::commit();

        $this->dispatch('payment-success');
    } catch (\Exception $e) {
        DB::rollBack();
        $this->addError('general', 'Something went wrong. Please try again.');
        $this->dispatch('payment-failed');
    }
}

    
    // Check if screenshot is required based on the payment method
    // Check if screenshot is required based on the payment method ID
private function isScreenshotRequired()
{
    // Payment method IDs for 'Cash on Delivery' and 'Cash on Pickup'
    $noScreenshotRequiredMethods = [3, 4]; // Payment method IDs 3 and 4

    return !in_array($this->selectedPaymentMethod, $noScreenshotRequiredMethods);
}

    
    // Create orders for each shop
    // and save payment details

    private function createOrdersPerShop($screenshotPath)
    {
    $itemsGroupedByShop = collect($this->cartItems)->groupBy(fn($item) => $item->product->shop->id);
    foreach ($itemsGroupedByShop as $shopId => $items) {
        $totalAmount = $items->sum(fn($item) => $item->product->product_price * $item->quantity);
        $transactionNumber = 'DMN' . now()->format('YmdHis') . '' . strtoupper(Str::random(4));
        $order = Order::create([
            'user_id' => Auth::id(),
            'shop_id' => $shopId,
            'total_amount' => $totalAmount,
            'transaction_id' => $transactionNumber,
            'delivery_address' => $this->deliveryAddress,
            'date_arrangement' => now()->toDateString(),
            'time_arrangement' => now()->toTimeString(),
            'status' => 'Pending',
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->product_price,
                'sub_total' => $item->product->product_price * $item->quantity,
            ]);
            // Create Stock Movement (OUT)
            StockMovement::create([
                'product_id' => $item->product_id,
                'movement_type' => 'OUT',
                'quantity' => $item->quantity,
                'description' => 'Order placed by user ID ' . Auth::id(),
            ]);
        }

        Payment::create([
            'user_id' => Auth::id(),
            'order_id' => $order->id,
            'payment_method_id' => $this->selectedPaymentMethod,
            'status' => 'completed',
            'provider_transc_id' => $this->reference,
            'screenshot_path' => $screenshotPath,
            'paid_at' => now(),
        ]);
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

        if ($this->selectedPaymentMethod) {
            $this->updatedSelectedPaymentMethod($this->selectedPaymentMethod);
        }
    }
    public function render()
    {
        return view('livewire.user.modal.order-process');
    }
}
