<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle the image upload if an image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category_images', 'public');
            $validatedData['image_path'] = $imagePath; // Changed from 'image' to 'image_path'
            unset($validatedData['image']); // Remove the original image field
        }
    
        // Add the created_by field with the authenticated user's ID
        $validatedData['created_by'] = Auth::id() ?? 1;
    
        // Create a new category using the validated data
        Category::create($validatedData);
    
        // Redirect to the categories index page with a success message
        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }

    /**
     * Display the specified category
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category
     */
    public function edit(Category $category)
    {

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category
     */
    public function update(Request $request, Category $category)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($category->image_path) {
                    Storage::disk('public')->delete($category->image_path);
                }

                $image = $request->file('image');
                $imagePath = $image->store('categories', 'public');
                $validated['image_path'] = $imagePath;
            }

            // Update category
            $category->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'image_path' => $validated['image_path'] ?? $category->image_path,
                'updated_by' => Auth::id()
            ]);

            return redirect()
                ->route('categories.index')
                ->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            // Delete newly uploaded image if update fails
            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update category. Please try again.');
        }
    }

    /**
     * Remove the specified category
     */
    public function destroy(Category $category)
    {
        try {
            // Delete image if exists
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }

            // Soft delete the category
            $category->delete();

            return redirect()
                ->route('categories.index')
                ->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to delete category. Please try again.');
        }
    }

    /**
     * Handle AJAX request to check if category name exists
     */
}
