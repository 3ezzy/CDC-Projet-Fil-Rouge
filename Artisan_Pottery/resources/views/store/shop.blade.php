@extends('layouts.client.app')

@section('title', 'Modern Ceramic Art')

@section('content')
    <!-- Page Header -->
    <section class="pt-32 pb-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="font-playfair text-4xl md:text-5xl font-bold text-gray-800 mb-4">Our Collection</h1>
                <nav class="flex justify-center">
                    <ol class="flex items-center space-x-2 text-sm text-gray-500">
                        <li><a href="index.html" class="hover:text-amber-600 transition-colors">Home</a></li>
                        <li><span class="mx-2">/</span></li>
                        <li class="text-amber-600 font-medium">Shop</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Shop Section -->
    <section class="bg-[#f8f5f2] py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter and Sort Controls -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
                <div class="flex items-center">
                    <button id="filter-button"
                        class="flex items-center bg-white px-4 py-2 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                        <i class="fas fa-filter text-gray-600 mr-2"></i>
                        <span>Filter</span>
                    </button>
                    <div class="hidden md:flex items-center ml-6 space-x-3">
                        <span class="text-gray-500">Categories:</span>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('shop') }}"
                                class="bg-{{ request()->category ? 'white hover:bg-amber-50 text-gray-700' : 'amber-600 text-white' }} px-3 py-1 rounded-full text-sm transition-colors">
                                All
                            </a>
                            @foreach ($categories as $category)
                                <a href="{{ route('shop', ['category' => $category->id]) }}"
                                    class="bg-{{ request()->category == $category->id ? 'amber-600 text-white' : 'white hover:bg-amber-50 text-gray-700' }} px-3 py-1 rounded-full text-sm transition-colors">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex items-center w-full md:w-auto">
                    <div class="relative inline-block w-full md:w-auto">
                        <select name="sort" onchange="window.location.href=this.value"
                            class="appearance-none bg-white px-4 py-2 pr-8 rounded-lg shadow-sm hover:bg-gray-50 transition-colors w-full">
                            <option value="{{ route('shop', ['sort' => 'newest']) }}"
                                {{ request()->sort == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="{{ route('shop', ['sort' => 'price_low_high']) }}"
                                {{ request()->sort == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="{{ route('shop', ['sort' => 'price_high_low']) }}"
                                {{ request()->sort == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="{{ route('shop', ['sort' => 'best_rated']) }}"
                                {{ request()->sort == 'best_rated' ? 'selected' : '' }}>Best Rated</option>
                            <option value="{{ route('shop', ['sort' => 'best_selling']) }}"
                                {{ request()->sort == 'best_selling' ? 'selected' : '' }}>Best Selling</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Panel -->
            <div id="filter-panel" class="hidden bg-white p-6 rounded-2xl shadow-lg mb-8">
                <form action="{{ route('shop') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Category Filter -->
                        <div>
                            <h3 class="font-medium text-gray-800 mb-3">Categories</h3>
                            <div class="space-y-2">
                                @foreach ($categories as $category)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                            {{ in_array($category->id, request()->categories ?? []) ? 'checked' : '' }}
                                            class="rounded text-amber-600 focus:ring-amber-500">
                                        <span class="ml-2 text-gray-600">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price & Stock Filters -->
                        <div>
                            <h3 class="font-medium text-gray-800 mb-3">Price Range</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <div class="bg-white border border-gray-300 rounded-md px-3 py-1">
                                        <span class="text-gray-500 text-sm">$</span>
                                        <input type="number" name="min_price" value="{{ request()->min_price }}"
                                            min="0" class="w-16 focus:outline-none">
                                    </div>
                                    <span class="text-gray-500 mx-2">-</span>
                                    <div class="bg-white border border-gray-300 rounded-md px-3 py-1">
                                        <span class="text-gray-500 text-sm">$</span>
                                        <input type="number" name="max_price" value="{{ request()->max_price }}"
                                            min="0" class="w-16 focus:outline-none">
                                    </div>
                                </div>

                                <label class="flex items-center mt-4">
                                    <input type="checkbox" name="in_stock" value="1"
                                        {{ request()->in_stock ? 'checked' : '' }}
                                        class="rounded text-amber-600 focus:ring-amber-500">
                                    <span class="ml-2 text-gray-600">In Stock Only</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="checkbox" name="has_discount" value="1"
                                        {{ request()->has_discount ? 'checked' : '' }}
                                        class="rounded text-amber-600 focus:ring-amber-500">
                                    <span class="ml-2 text-gray-600">On Sale</span>
                                </label>
                            </div>
                        </div>

                        <!-- Rating Filter -->
                        <div>
                            <h3 class="font-medium text-gray-800 mb-3">Minimum Rating</h3>
                            <div class="space-y-2">
                                @foreach (range(5, 1) as $rating)
                                    <label class="flex items-center">
                                        <input type="radio" name="min_review" value="{{ $rating }}"
                                            {{ request()->min_review == $rating ? 'checked' : '' }}
                                            class="rounded-full text-amber-600 focus:ring-amber-500">
                                        <span class="ml-2 text-gray-600">
                                            @for ($i = 1; $i <= $rating; $i++)
                                                <i class="fas fa-star text-amber-400"></i>
                                            @endfor
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                        <a href="{{ route('shop') }}"
                            class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50">
                            Reset
                        </a>
                        <button type="submit" class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-scale">
                        <div class="relative">
                            @if ($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                    class="w-full h-64 object-cover">
                            @else
                                <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                </div>
                            @endif

                            @if ($product->discount > 0)
                                <div class="absolute top-4 left-4 bg-red-500 text-white px-2 py-1 rounded-full text-sm">
                                    -{{ $product->discount }}%
                                </div>
                            @endif

                            <button class="absolute top-4 right-4 bg-white/80 p-2 rounded-full">
                                <i class="fas fa-heart text-gray-600"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <h3 class="font-medium text-gray-800 mb-2">{{ $product->name }}</h3>
                            <div class="flex items-center mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                        class="fas fa-star {{ $i <= ($product->review ?? 3) ? 'text-amber-400' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex flex-col">
                                    @if ($product->discount)
                                        <div class="flex flex-col">
                                            <span
                                                class="text-gray-500 line-through text-sm">{{ $product->formatted_price }}</span>
                                            <span
                                                class="text-amber-600 font-semibold">{{ $product->formatted_total_price }}</span>
                                            <span class="text-green-500 text-xs">
                                                Save {{ $product->formatted_discount_amount }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-amber-600 font-semibold">{{ $product->formatted_price }}</span>
                                    @endif
                                </div>
                                <!-- Add to Cart Button -->
                                @if ($product->stock > 0)
                                    <button
                                        class="bg-amber-600 text-white px-3 py-1 rounded-full text-sm hover:bg-amber-700"
                                        onclick="addToCart({{ $product->id }})">
                                        Add to Cart
                                    </button>
                                @else
                                    <button
                                        class="bg-gray-400 text-white px-3 py-1 rounded-full text-sm cursor-not-allowed">
                                        Out of Stock
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </section>

    <script>
        // Toggle filter panel
        document.getElementById('filter-button').addEventListener('click', function() {
            document.getElementById('filter-panel').classList.toggle('hidden');
        });

        // Add to cart function
        function addToCart(productId) {
            fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin'
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(json => Promise.reject(json));
                    }
                    return response.json();
                })
                .then(data => {
                    // Show success notification
                    showNotification(data.message, 'success');

                    // Update cart counter
                    const cartCounter = document.getElementById('cart-counter');
                    if (cartCounter) {
                        cartCounter.textContent = data.cart_items_count;
                        cartCounter.classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification(error.message || 'Failed to add product to cart', 'error');
                });
        }

        // Helper function to show notifications
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        } text-white z-50`;
            notification.textContent = message;
            document.body.appendChild(notification);

            // Add fade-in effect
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.3s ease-in-out';
            setTimeout(() => {
                notification.style.opacity = '1';
            }, 10);

            // Remove notification after 3 seconds with fade-out effect
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }
    </script>

@endsection
