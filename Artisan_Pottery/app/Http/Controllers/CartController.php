<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CartController extends Controller
{
    public function add(Product $product)
    {
        // Check if product exists and is in stock
        if ($product->stock <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, this product is out of stock.'
            ], 400);
        }
    
        $cart = session()->get('cart', []);
    
        // Use the dynamically calculated total price
        $price = $product->total_price;
    
        if (isset($cart[$product->id])) {
            // Check if adding more would exceed stock
            if ($cart[$product->id]['quantity'] >= $product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, we don\'t have enough stock.'
                ], 400);
            }
    
            $cart[$product->id]['quantity']++;
            $cart[$product->id]['total'] = $cart[$product->id]['quantity'] * $price;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $price, // discounted price here
                'discount' => $product->discount,
                'total_price' => $price, //  discounted price here
                'total' => $price, // discounted price here
                'image_path' => $product->image_path
            ];
        }
    
        session()->put('cart', $cart);
    
        // Calculate cart totals
        $cartTotal = 0;
        $itemsCount = 0;
        foreach ($cart as $item) {
            $cartTotal += $item['total'];
            $itemsCount += $item['quantity'];
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cart_total' => number_format($cartTotal, 2),
            'cart_items_count' => $itemsCount
        ]);
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
        
        // Retrieve the session to get details if needed
        $session = Session::retrieve($sessionId);
        
        // Clear the cart
        session()->forget('cart');
        
        // You would typically create an order in your database here
        // For now, we'll just show the confirmation page
        
        return view('store.order-confirmation');
    }
    
    public function cancel()
    {
        return redirect()->route('cart.show')->with('error', 'Payment was cancelled.');
    }
}