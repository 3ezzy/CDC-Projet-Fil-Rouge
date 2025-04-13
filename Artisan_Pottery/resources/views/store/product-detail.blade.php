@extends('layouts.client.app')

@section('content')
    <!-- Breadcrumb Navigation -->
    <div class="bg-white pt-32 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex">
                <ol class="flex items-center space-x-2 text-sm text-gray-500">
                    <li><a href="{{ route('home') }}" class="hover:text-amber-600 transition-colors">Home</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('shop') }}" class="hover:text-amber-600 transition-colors">Shop</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('shop', ['category' => $product->category->id]) }}"
                            class="hover:text-amber-600 transition-colors">{{ $product->category->name }}</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-amber-600 font-medium">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Product Detail Section -->
    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Product Images -->
                <div class="space-y-4">
                    <div class="bg-[#f8f5f2] rounded-2xl overflow-hidden shadow-lg">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                            class="w-full h-auto object-cover" id="main-image">
                    </div>
                </div>

                <!-- Product Info -->
                <div>
                    <div class="flex items-center mb-3">
                        <span class="bg-amber-100 text-amber-800 text-xs px-3 py-1 rounded-full">
                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>

                    </div>
                    <h1 class="font-playfair text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>

                    <!-- Rating -->
                    @if ($product->review)
                        <div class="flex items-center mb-4">
                            <div class="flex text-amber-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $product->review)
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $product->review)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-gray-500 text-sm ml-2">({{ $product->reviews_count ?? 0 }} reviews)</span>
                        </div>
                    @endif

                    <!-- Price -->
                    <div class="mb-6">
                        <div class="flex items-center">
                            @if ($product->discount)
                                <span
                                    class="text-gray-400 line-through text-lg">${{ number_format($product->price, 2) }}</span>
                                <span
                                    class="text-amber-600 font-bold text-3xl ml-3">${{ number_format($product->price * (1 - $product->discount / 100), 2) }}</span>
                                <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded ml-3">Save
                                    {{ $product->discount }}%</span>
                            @else
                                <span
                                    class="text-amber-600 font-bold text-3xl">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        <p class="text-green-600 text-sm mt-1">Free shipping for orders over $100</p>
                    </div>

                    <div class="border-t border-gray-200 py-6">
                        <p class="text-gray-600 mb-4">{{ $product->description }}</p>

                        @if ($product->features)
                            <ul class="space-y-2 text-gray-600 mb-6">
                                @foreach (json_decode($product->features) as $feature)
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-amber-600 mt-1 mr-2"></i>
                                        <span>{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <!-- Purchase Options -->
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <!-- Quantity Selector -->
                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-700 mb-3">Quantity</h3>
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button type="button"
                                            class="px-4 py-2 text-gray-600 hover:text-amber-600 transition-colors"
                                            onclick="updateQuantity(-1)">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1"
                                            max="{{ $product->stock }}"
                                            class="w-12 text-center border-x border-gray-300 py-2 focus:outline-none">
                                        <button type="button"
                                            class="px-4 py-2 text-gray-600 hover:text-amber-600 transition-colors"
                                            onclick="updateQuantity(1)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <span class="text-sm text-gray-500">{{ $product->stock }} pieces available</span>
                                </div>
                            </div>

                            <!-- Purchase Buttons -->
                            <div class="flex space-x-4">
                                <button type="submit"
                                    class="flex-1 bg-amber-600 text-white px-6 py-3 rounded-lg hover:bg-amber-700 transition-colors">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Add to Cart
                                </button>
                                <button type="submit" name="buy_now" value="1"
                                    class="flex-1 bg-amber-100 text-amber-800 px-6 py-3 rounded-lg hover:bg-amber-200 transition-colors">
                                    Buy Now
                                </button>
                            </div>
                        </form>

                        <!-- Additional Options -->
                        <div class="flex items-center justify-between mt-6">
                            <button class="flex items-center text-gray-600 hover:text-amber-600 transition-colors">
                                <i class="far fa-heart mr-2"></i>
                                Add to Wishlist
                            </button>
                            <button class="flex items-center text-gray-600 hover:text-amber-600 transition-colors">
                                <i class="fas fa-share-alt mr-2"></i>
                                Share
                            </button>
                        </div>
                    </div>

                    <!-- Time and Availability -->
                    <div class="mt-6 p-4 bg-amber-50 rounded-lg">
                        <p class="text-sm text-amber-800">
                            <i class="fas fa-truck mr-2"></i>
                            Order now for delivery within 3-5 business days
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            function updateQuantity(change) {
                const input = document.getElementById('quantity');
                const currentValue = parseInt(input.value) || 1;
                const newValue = Math.max(1, Math.min(currentValue + change, {{ $product->stock }}));
                input.value = newValue;
            }
        </script>
    @endpush
@endsection
