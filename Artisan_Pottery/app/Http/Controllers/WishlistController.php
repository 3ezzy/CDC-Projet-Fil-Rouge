<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Toggle product in wishlist
     */
    public function toggle($id)
    {
        $product = Product::findOrFail($id);
        $wishlist = session()->get('wishlist', []);

        // If product exists in wishlist, remove it
        if (array_key_exists($id, $wishlist)) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
            return response()->json([
                'success' => true,
                'message' => 'Product removed from wishlist',
                'in_wishlist' => false,
                'wishlist_count' => count($wishlist)
            ]);
        }

        // If product doesn't exist in wishlist, add it
        $wishlist[$id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image_path
        ];
        
        session()->put('wishlist', $wishlist);
        
        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist',
            'in_wishlist' => true,
            'wishlist_count' => count($wishlist)
        ]);
    }

    /**
     * Show wishlist page
     */
    public function show()
    {
        $wishlist = session()->get('wishlist', []);
        $productIds = array_keys($wishlist);
        
        $products = [];
        if (!empty($productIds)) {
            $products = Product::whereIn('id', $productIds)->get();
        }
        
        return view('store.wishlist', compact('products', 'wishlist'));
    }

    /**
     * Remove from wishlist
     */
    public function remove($id)
    {
        $wishlist = session()->get('wishlist', []);
        
        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }
        
        return redirect()->back()->with('success', 'Product removed from wishlist');
    }

    /**
     * Clear wishlist
     */
    public function clear()
    {
        session()->forget('wishlist');
        return redirect()->back()->with('success', 'Wishlist cleared');
    }
} 