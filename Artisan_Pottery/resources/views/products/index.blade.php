@extends('layouts.admin.master')

@section('title', 'Product Management')

@section('content')
<div class="p-4 sm:p-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-playfair font-bold text-gray-800 mb-2">Product Management</h1>
            <p class="text-gray-600">Add and manage products</p>
        </div>
        <a href="{{ route('products.create') }}" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2 rounded-lg transition-colors text-center">
            <i class="fas fa-plus mr-2"></i>Add New Product
        </a>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 mb-6">
        <form action="{{ route('products.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request()->get('search') }}"
                        placeholder="Search products..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                    >
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request()->get('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <select name="stock_status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                    <option value="">Stock Status</option>
                    <option value="in-stock" {{ request()->get('stock_status') == 'in-stock' ? 'selected' : '' }}>In Stock</option>
                    <option value="low-stock" {{ request()->get('stock_status') == 'low-stock' ? 'selected' : '' }}>Low Stock</option>
                    <option value="out-of-stock" {{ request()->get('stock_status') == 'out-of-stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>
                <div class="flex justify-end sm:justify-start lg:justify-end">
                    <button type="submit" class="w-full sm:w-auto bg-amber-600 hover:bg-amber-700 text-white px-6 py-2 rounded-lg transition-colors">
                        Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Product List -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-4 sm:px-6 py-4 text-sm font-semibold text-gray-600">
                            <div class="flex items-center space-x-1">
                                <span>Product</span>
                                <i class="fas fa-sort text-gray-400"></i>
                            </div>
                        </th>
                        <th class="hidden sm:table-cell px-6 py-4 text-sm font-semibold text-gray-600">Category</th>
                        <th class="px-4 sm:px-6 py-4 text-sm font-semibold text-gray-600">
                            <div class="flex items-center space-x-1">
                                <span>Price</span>
                                <i class="fas fa-sort text-gray-400"></i>
                            </div>
                        </th>
                        <th class="hidden sm:table-cell px-6 py-4 text-sm font-semibold text-gray-600">
                            <div class="flex items-center space-x-1">
                                <span>Stock</span>
                                <i class="fas fa-sort text-gray-400"></i>
                            </div>
                        </th>
                        <th class="hidden sm:table-cell px-6 py-4 text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-4 sm:px-6 py-4 text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 sm:px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product" class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg object-cover">
                                    <div>
                                        <h3 class="font-medium text-gray-800">{{ $product->name }}</h3>
                                        <p class="text-sm text-gray-500">#{{ $product->id }}</p>
                                        <!-- Mobile-only category and stock display -->
                                        <div class="sm:hidden text-sm text-gray-500 mt-1">
                                            {{ $product->category->name }} • {{ $product->stock }} in stock
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden sm:table-cell px-6 py-4 text-gray-600">{{ $product->category->name }}</td>
                            <td class="px-4 sm:px-6 py-4 text-gray-800">${{ $product->price }}</td>
                            <td class="hidden sm:table-cell px-6 py-4 text-gray-600">{{ $product->stock }}</td>
                            <td class="hidden sm:table-cell px-6 py-4">
                                @if($product->stock > 10)
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-sm">In Stock</span>
                                @elseif($product->stock > 0)
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">Low Stock</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-sm">Out of Stock</span>
                                @endif
                            </td>
                            <td class="px-4 sm:px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('products.edit', $product->id) }}" class="text-amber-600 hover:text-amber-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row items-center justify-between px-4 sm:px-6 py-4 bg-gray-50 gap-4">
            <div class="text-gray-600 text-sm order-2 sm:order-1">
                Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries
            </div>
            <div class="flex space-x-2 order-1 sm:order-2 w-full sm:w-auto justify-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection