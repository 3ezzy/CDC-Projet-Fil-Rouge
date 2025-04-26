<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); 
        return view('store.index', compact('categories'));
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
