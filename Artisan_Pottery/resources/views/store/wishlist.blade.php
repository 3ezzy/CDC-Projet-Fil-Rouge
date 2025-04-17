@extends('layouts.client.app')

@section('title', 'Wishlist')

@section('content')
<section class="py-16 px-4 sm:px-6 lg:px-8 bg-[#f8f5f2]">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-playfair font-bold text-gray-800 mb-4">My Wishlist</h1>
            <p class="text-gray-600">Items you've saved for later.</p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(count($products) > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-lg font-medium">{{ count($products) }} {{ Str::plural('item', count($products)) }}</span>
                    <form action="{{ route('wishlist.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            Clear Wishlist
                        </button>
                    </form>
                </div>
                
                <div class="divide-y divide-gray-200">
                    @foreach($products as $product)
                        <div class="flex items-center py-6 first:pt-0 last:pb-0">
                            <div class="w-24 h-24 flex-shrink-0 overflow-hidden rounded-md">
                                @if($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="ml-6 flex-1">
                                <div class="flex justify-between">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-800">
                                            <a href="{{ route('store.products.show', $product) }}" class="hover:text-amber-600">
                                                {{ $product->name }}
                                            </a>
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ Str::limit($product->description, 100) }}
                                        </p>
                                    </div>
                                    <p class="text-lg font-medium text-amber-600">
                                        @if($product->discount > 0)
                                            <span class="text-gray-400 line-through text-sm mr-2">${{ $product->price }}</span>
                                            ${{ number_format($product->price * (1 - $product->discount / 100), 2) }}
                                        @else
                                            ${{ $product->price }}
                                        @endif
                                    </p>
                                </div>
                                
                                <div class="mt-4 flex justify-between">
                                    <div class="flex items-center space-x-4">
                                        <form action="{{ route('cart.add', $product) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-amber-600 hover:text-amber-700 flex items-center">
                                                <i class="fas fa-shopping-cart mr-2"></i>
                                                Add to Cart
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('wishlist.remove', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-gray-500 hover:text-gray-700">
                                                <i class="fas fa-trash mr-2"></i>
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <div class="text-sm text-gray-500">
                                        @if($product->stock > 0)
                                            <span class="text-green-600">In Stock</span>
                                        @else
                                            <span class="text-red-600">Out of Stock</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="text-center">
                <a href="{{ route('shop') }}" class="inline-flex items-center text-amber-600 hover:text-amber-700">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Continue Shopping
                </a>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <div class="text-amber-600 mb-4">
                    <i class="far fa-heart text-5xl"></i>
                </div>
                <h2 class="text-2xl font-medium text-gray-800 mb-4">Your wishlist is empty</h2>
                <p class="text-gray-600 mb-6">Save items you love to your wishlist and find them here later.</p>
                <a href="{{ route('shop') }}" class="inline-block bg-amber-600 text-white px-6 py-3 rounded-lg hover:bg-amber-700 transition-colors">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</section>
@endsection 