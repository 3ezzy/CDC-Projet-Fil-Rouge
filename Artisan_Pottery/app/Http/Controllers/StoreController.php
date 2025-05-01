<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        // Get best selling products or featured products (limit to 4)
        $bestSellers = Product::where('stock', '>', 0)
                            ->orderBy('stock', 'asc') // Assuming lower stock means more sales
                            ->limit(4)
                            ->get();

         $products = Product::all();
        
        return view('store.index', compact('categories', 'bestSellers', 'products'));
    }

    public function about()
    {
        return view('store.about');
    }

    public function contact()
    {
        return view('store.contact');
    }

    
}
