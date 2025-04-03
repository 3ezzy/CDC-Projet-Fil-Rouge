<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        
        // Calculate the discounted price
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
                'price' => $product->price,
                'discount' => $product->discount,
                'total_price' => $price,
                'total' => $price,
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
}