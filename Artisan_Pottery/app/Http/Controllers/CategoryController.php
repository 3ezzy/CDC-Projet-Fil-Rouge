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

        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured' => 'nullable|boolean'
        ], [
            'name.required' => 'The category name field is required.',
            'name.unique' => 'This category name is already taken.',
            'name.max' => 'The category name must not exceed 255 characters.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image must not be larger than 2MB.'
        ]);
        try {
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('categories', 'public');
            }

            // Create category
            Category::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'image_path' => $imagePath,
                'created_by' => Auth::id() ?? 1,
                'updated_by' => auth::id() ?? 1, // Add this line
            ]);

            return redirect()
                ->route('categories.index')
                ->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create category. Please try again.');
        }
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
