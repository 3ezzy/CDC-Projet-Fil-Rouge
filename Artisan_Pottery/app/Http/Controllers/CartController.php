<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CartController extends Controller
{
    public function add(Product $product)
{
    // Check if the product exists and is in stock
    if ($product->stock <= 0) {
        return redirect()->route('shop')->with('error', 'Sorry, this product is out of stock.');
    }

    // Retrieve the cart from the session or initialize it
    $cart = session()->get('cart', []);

    // Use the dynamically calculated total price (including discount, if any)
    $price = $product->discount > 0
        ? $product->price * (1 - $product->discount / 100)
        : $product->price;

    // Check if the product is already in the cart
    if (isset($cart[$product->id])) {
        // Check if adding more would exceed stock
        if ($cart[$product->id]['quantity'] >= $product->stock) {
            return redirect()->route('shop')->with('error', 'Sorry, we don\'t have enough stock.');
        }

        // Increase the quantity and update the total for the product
        $cart[$product->id]['quantity']++;
        $cart[$product->id]['total'] = $cart[$product->id]['quantity'] * $price;
    } else {
        // Add the product to the cart
        $cart[$product->id] = [
            'name' => $product->name,
            'quantity' => 1,
            'price' => number_format($price, 2), // Final price with discount applied
            'discount' => $product->discount,
            'total' => number_format($price, 2), // Initial total (price * 1)
            'image_path' => $product->image_path
        ];
    }

    // Save the updated cart back to the session
    session()->put('cart', $cart);

    // Redirect to the shop route with a success message
    return redirect()->route('shop')->with('success', 'Product added to cart successfully!');
}
    public function update(Request $request, $productId)
{
    $cart = session()->get('cart', []);
    if (!isset($cart[$productId])) {
        return response()->json(['success' => false, 'message' => 'Product not found in cart'], 400);
    }

    $product = Product::find($productId);
    if (!$product) {
        return response()->json(['success' => false, 'message' => 'Product not found'], 400);
    }

    $quantity = $cart[$productId]['quantity'];

    switch ($request->action) {
        case 'increase':
            if ($quantity < $product->stock) {
                $cart[$productId]['quantity']++;
            } else {
                return response()->json(['success' => false, 'message' => 'Cannot increase quantity, not enough stock'], 400);
            }
            break;
        case 'decrease':
            if ($quantity > 1) {
                $cart[$productId]['quantity']--;
            } else {
                return response()->json(['success' => false, 'message' => 'Quantity cannot be less than 1'], 400);
            }
            break;
        case 'set':
            $newQuantity = (int) $request->quantity;
            if ($newQuantity <= 0 || $newQuantity > $product->stock) {
                return response()->json(['success' => false, 'message' => 'Invalid quantity'], 400);
            }
            $cart[$productId]['quantity'] = $newQuantity;
            break;
        default:
            return response()->json(['success' => false, 'message' => 'Invalid action'], 400);
    }

    $cart[$productId]['total'] = $cart[$productId]['quantity'] * $cart[$productId]['price'];
    session()->put('cart', $cart);

    return response()->json(['success' => true, 'message' => 'Quantity updated']);
}

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);

            session()->put('cart', $cart);

            // Calculate cart 
            $cartTotal = 0;
            $itemsCount = 0;
            foreach ($cart as $item) {
                $cartTotal += $item['total'];
                $itemsCount += $item['quantity'];
            }

            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart successfully!',
                'cart_total' => number_format($cartTotal, 2),
                'cart_items_count' => $itemsCount
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Item not found in cart.'
        ], 404);
    }

    public function show()
    {
        $cart = session()->get('cart', []);
        $total = $this->calculateCartTotal($cart);
        
        return view('store.cart', compact('cart', 'total'));
    }

    private function calculateCartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['total'];
        }
        return number_format($total, 2);
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty');
        }
        
        // Set your Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        
        $lineItems = [];
        
        foreach ($cart as $id => $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item['name'],
                        'images' => [
                            isset($item['image_path']) ? asset('storage/' . $item['image_path']) : asset('images/placeholder.jpg')
                        ],
                    ],
                    'unit_amount' => round($item['price'] * 100), // Convert to cents
                ],
                'quantity' => $item['quantity'],
            ];
        }
        
        // Create a checkout session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);
        
        return redirect($session->url);
    }
    
    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        
        if (!$sessionId) {
            return redirect()->route('home');
        }
        
        // Set your Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        
        // Retrieve the session to get details
        $session = Session::retrieve($sessionId);
        
        // Get cart data before clearing it
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Cart was already processed or is empty.');
        }
        
        // Calculate the total order amount
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }
        
        // Create the order
        $order = new Order();
        
        // Only set user_id if the user is authenticated
        if (Auth::check()) {
            $order->user_id = Auth::id();
        }
        
        $order->order_number = Order::generateOrderNumber();
        $order->total_amount = $totalAmount;
        $order->status = 'processing';
        $order->payment_status = 'paid';
        $order->payment_method = 'stripe';
        $order->payment_id = $session->payment_intent;
        $order->transaction_id = $sessionId;
        
        // Use customer details from session if available or default values
        $order->shipping_name = $session->customer_details->name ?? 'Guest Customer';
        $order->shipping_email = $session->customer_details->email ?? 'guest@example.com';
        $order->shipping_phone = $session->customer_details->phone ?? '';
        
        // If there's shipping address in the session
        if (isset($session->shipping)) {
            $order->shipping_address = $session->shipping->address->line1 ?? '';
            $order->shipping_city = $session->shipping->address->city ?? '';
            $order->shipping_state = $session->shipping->address->state ?? '';
            $order->shipping_zipcode = $session->shipping->address->postal_code ?? '';
            $order->shipping_country = $session->shipping->address->country ?? '';
        } else {
            // Default values if shipping info isn't available
            $order->shipping_address = 'N/A';
            $order->shipping_city = 'N/A';
            $order->shipping_state = '';
            $order->shipping_zipcode = 'N/A';
            $order->shipping_country = 'N/A';
        }
        
        $order->save();
        
        // Create order items
        foreach ($cart as $id => $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $id;
            $orderItem->product_name = $item['name'];
            $orderItem->price = $item['price'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->subtotal = $item['price'] * $item['quantity'];
            $orderItem->save();
            
            // Update product stock
            $product = Product::find($id);
            if ($product) {
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }
        
        // Clear the cart
        session()->forget('cart');
        
        return view('store.order-confirmation', compact('order'));
    }
    
    public function cancel()
    {
        return redirect()->route('cart.show')->with('error', 'Payment was cancelled.');
    }
}