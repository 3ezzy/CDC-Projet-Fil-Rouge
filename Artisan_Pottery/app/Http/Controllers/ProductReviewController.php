<?php
namespace App\Http\Controllers;

use App\Models\ProductReview;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{

    // Store a new review
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $product = Product::findOrFail($productId);

        ProductReview::create([
            'product_id' => $product->id,
            'user_id' => auth::id(), // Assuming the user is authenticated
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Review added successfully!');
    }

    // Display reviews for a product
   
}