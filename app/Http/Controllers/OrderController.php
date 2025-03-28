<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CartService;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderPlacedMail;

class OrderController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartItems = $this->cartService->getCart();
        $cartTotal = $this->cartService->getTotalPrice();

        return view('checkout', compact('cartItems', 'cartTotal'));
    }

    public function placeOrder(Request $request)
    {
    try {
        if (!Auth::guard('customer')->check()) {  // Use the correct guard if needed
            return redirect()->route('login')->with('error', 'Please login to place an order.');
        }
        $user = Auth::guard('customer')->user();
        
        $cartItems = $this->cartService->getCart();
        // dd($cartItems);
        $cartTotal = $this->cartService->getTotalPrice();

        if (empty($cartItems)) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Debugging: Check cart items structure
        \Log::info('Cart Items:', $cartItems);

        $fullAddress = "{$request->address1}, {$request->address2}, {$request->city}, {$request->state}, {$request->postal_code}";

   
        // Create Order
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $cartTotal,
            'status' => 'pending',
            'address' => $fullAddress,
            'payment_method' => $request->payment_method,
        ]);

        // dd($order);

        \Log::info('Cart Items Before Order:', $cartItems);

        // Store order items in order_items table
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'], 
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'product_price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'], // Ensure subtotal is calculated
            ]);
        }

    

        \Log::info("Order Items:", ['items' => $order->orderItems]);

        
        // Check if order items were created
        if ($order->orderItems->isEmpty()) {
            \Log::error("Order items not saved!");
        }


        // send mail asychronously
        Mail::to($user->email)->queue(new OrderPlacedMail($order));

        // Clear cart after order is placed
        $this->cartService->clearCart();



        return redirect()->route('order.success', ['id' => $order->id])->with('success', 'Order placed successfully!');


    } catch (\Exception $e) {
        \Log::error('Order Placement Error: ' . $e->getMessage());
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}


    public function orderPlaced($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
      
        
        return view('order-success', compact('order'));
    }


}
