@extends('layouts.client.app')

@section('title', 'Modern Ceramic Art')

@section('content')

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 md:min-h-screen flex flex-col justify-center overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="text-center md:text-left">
                    <h4 class="uppercase tracking-widest text-amber-600 mb-4">Handcrafted with Love</h4>
                    <h1 class="font-playfair text-4xl md:text-6xl font-bold text-gray-800 mb-6">Modern <span
                            class="text-amber-600">Pottery</span> for Your Home</h1>
                    <p class="text-gray-600 mb-8 max-w-lg mx-auto md:mx-0">
                        Discover our collection of handcrafted ceramic art pieces designed to bring beauty and
                        functionality to your everyday life.
                    </p>
                    <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                        <a href="product.html"
                            class="px-8 py-3 bg-amber-600 hover:bg-amber-700 text-white rounded-full transition-colors shadow-lg hover:shadow-xl">
                            Shop Collection
                        </a>
                        <a href="about.html"
                            class="px-8 py-3 bg-transparent border border-amber-600 text-amber-600 hover:bg-amber-50 rounded-full transition-colors">
                            Our Story
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-square rounded-full bg-amber-200/30 absolute -top-10 -right-10 w-64 h-64"></div>
                    <img src="https://images.unsplash.com/photo-1610701596061-2ecf227e85b2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1400&q=80"
                        alt="Handcrafted pottery vase" class="relative z-10 rounded-2xl shadow-2xl hover-scale" />
                    <div class="absolute -bottom-6 -left-6 bg-amber-600 rounded-lg p-4 shadow-lg z-20 hover-scale">
                        <div class="flex items-center space-x-2 text-white">
                            <div class="text-4xl font-playfair font-bold">30%</div>
                            <div class="text-sm">
                                <div>Spring</div>
                                <div class="font-bold">Collection</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-shape-divider">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="fill-white"></path>
            </svg>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-playfair text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Categories</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Explore our carefully curated collection of handcrafted pottery.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($categories as $category)
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl hover-scale mb-4">
                            <img src="{{ Storage::url($category->image_path) }}" alt="{{ $category->name }}"
                                class="w-full h-80 object-cover" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                                <div class="p-6">
                                    <h3 class="font-playfair text-xl font-bold text-white mb-2">{{ $category->name }}</h3>
                                    <p
                                        class="text-white/80 text-sm mb-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                        {{ $category->description }}</p>
                                    <a href="{{ route('shop') }}" class="inline-flex items-center text-white">
                                        <span class="mr-2">Explore Collection</span>
                                        <i class="fas fa-arrow-right transition-transform group-hover:translate-x-1"></i>
                                    </a>
                                </div>


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Best Sellers Section -->
    <section class="bg-[#f8f5f2] py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <div>
                    <h4 class="uppercase tracking-widest text-amber-600 mb-2">Shop Our Collection</h4>
                    <h2 class="font-playfair text-3xl md:text-4xl font-bold text-gray-800">Best Sellers</h2>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('shop') }}"
                        class="inline-flex items-center text-amber-600 hover:text-amber-700 font-medium">
                        <span>View All Products</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

         <!-- Best Sellers Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    @foreach ($bestSellers as $product)
        <a href="{{ route('store.products.show', $product) }}" class="bg-white rounded-2xl shadow-lg overflow-hidden group hover-scale block">
            <!-- Product Image Section -->
            <div class="relative">
                @if ($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                    </div>
                @endif

                @if ($product->discount > 0)
                    <div class="absolute top-4 left-4">
                        <span class="bg-red-500 text-white text-xs px-3 py-1.5 rounded-full">-{{ $product->discount }}%</span>
                    </div>
                @else
                    <div class="absolute top-4 left-4">
                        <span class="bg-amber-600 text-white text-xs px-3 py-1.5 rounded-full">Best Seller</span>
                    </div>
                @endif

                <!-- Wishlist Button -->
                <button type="button"
                    class="absolute top-4 right-4 bg-white/80 p-2 rounded-full shadow-md hover:bg-gray-100 transition-colors"
                    onclick="event.preventDefault(); toggleWishlist({{ $product->id }}, this)">
                    <i class="fas fa-heart {{ in_array($product->id, array_keys(session('wishlist', []))) ? 'text-red-500' : 'text-gray-600' }}"></i>
                </button>
            </div>

            <!-- Product Info Section -->
            <div class="p-6">
                <h3 class="font-playfair text-xl font-bold text-gray-800 mb-2">{{ $product->name }}</h3>

                <!-- Rating Stars -->
                <div class="flex items-center mb-2">
                    @php
                        $averageRating = $product->reviews->avg('rating') ?? 0; // Calculate the average rating
                    @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $averageRating ? 'text-amber-400' : 'text-gray-300' }}"></i>
                    @endfor
                    <span class="text-gray-500 text-sm ml-2">({{ $product->reviews->count() }} reviews)</span>
                </div>

                <!-- Price and Cart Section -->
                <div class="flex justify-between items-center">
                    <div>
                        @if ($product->discount > 0)
                            <span class="text-gray-400 line-through text-sm">{{ $product->formatted_price }}</span>
                            <span class="text-amber-600 font-bold ml-2">{{ $product->formatted_total_price }}</span>
                        @else
                            <span class="text-amber-600 font-bold">{{ $product->formatted_price }}</span>
                        @endif
                    </div>
                    <form id="add-to-cart-form-{{ $product->id }}" action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white p-2 rounded-full transition-colors">
                            <i class="fas fa-shopping-bag"></i>
                        </button>
                    </form>
                </div>
            </div>
        </a>
    @endforeach
</div>
        </div>
    </section>


    <!-- Brand Story Section -->
    <section class="relative py-20 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <div class="aspect-square rounded-full bg-amber-100 absolute -bottom-10 -left-10 w-64 h-64"></div>
                    <img src="https://images.unsplash.com/photo-1623064803927-d820399b4e7f?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Potter at work" class="relative z-10 rounded-2xl shadow-2xl hover-scale" />
                </div>
                <div>
                    <h4 class="uppercase tracking-widest text-amber-600 mb-4">Our Story</h4>
                    <h2 class="font-playfair text-3xl md:text-4xl font-bold text-gray-800 mb-6">Handcrafted with Passion
                        and Purpose</h2>
                    <p class="text-gray-600 mb-6">
                        At Artisan Pottery, we believe in the power of handcrafted items to bring warmth and character
                        to everyday living.
                        Each piece is thoughtfully designed and carefully created by our skilled artisans.
                    </p>
                    <p class="text-gray-600 mb-8">
                        Our commitment to sustainable practices means we source local materials and use traditional
                        techniques
                        that have been passed down through generations, resulting in pottery that's not only beautiful
                        but also
                        environmentally responsible.
                    </p>
                    <a href="{{ route('about') }}"
                        class="inline-flex items-center text-amber-600 hover:text-amber-700 font-medium">
                        <span>Learn More About Our Process</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="bg-[#f8f5f2] py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h4 class="uppercase tracking-widest text-amber-600 mb-2">Testimonials</h4>
                <h2 class="font-playfair text-3xl md:text-4xl font-bold text-gray-800 mb-4">What Our Customers Say</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Hear from our satisfied customers about their experience with
                    our handcrafted pottery.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover-scale">
                    <div class="flex text-amber-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 mb-6">
                        "I received the ceramic vase set as a gift, and I was blown away by the quality and
                        craftsmanship. The colors are even more vibrant in person!"
                    </p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Customer photo"
                            class="w-12 h-12 rounded-full mr-4" />
                        <div>
                            <h4 class="font-bold text-gray-800">Emma Thompson</h4>
                            <p class="text-gray-500 text-sm">New York, USA</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover-scale">
                    <div class="flex text-amber-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 mb-6">
                        "I've purchased several pieces from Artisan over the years, and each one continues to bring joy
                        to my home. The attention to detail is remarkable."
                    </p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Customer photo"
                            class="w-12 h-12 rounded-full mr-4" />
                        <div>
                            <h4 class="font-bold text-gray-800">Michael Rodriguez</h4>
                            <p class="text-gray-500 text-sm">Portland, USA</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover-scale">
                    <div class="flex text-amber-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="text-gray-600 mb-6">
                        "The tea set I ordered exceeded my expectations. Each piece feels unique and special, and the
                        shipping was prompt and well-packaged."
                    </p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/26.jpg" alt="Customer photo"
                            class="w-12 h-12 rounded-full mr-4" />
                        <div>
                            <h4 class="font-bold text-gray-800">Sarah Johnson</h4>
                            <p class="text-gray-500 text-sm">London, UK</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@push('scripts')
<script>
  function addToCart(productId) {
                        // Prevent navigation to product detail when clicking add to cart
                        event.preventDefault();

                        // Your existing addToCart logic here
                        fetch(`/cart/add/${productId}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json',
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Handle success
                                // You might want to show a notification or update cart count
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    }

                    function toggleWishlist(productId, button) {
                        // Prevent navigation to product detail when clicking wishlist
                        event.preventDefault();

                        fetch(`/wishlist/toggle/${productId}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Update heart icon
                                const heartIcon = button.querySelector('i');
                                if (data.in_wishlist) {
                                    heartIcon.classList.remove('text-gray-600');
                                    heartIcon.classList.add('text-red-500');
                                } else {
                                    heartIcon.classList.remove('text-red-500');
                                    heartIcon.classList.add('text-gray-600');
                                }

                                // Update wishlist counter in navigation
                                updateWishlistCounter(data.wishlist_count);

                                // Show notification
                                showNotification(data.message, 'success');
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showNotification('An error occurred', 'error');
                            });
                    }

                    function updateWishlistCounter(count) {
                        // Get the wishlist counter element in the navigation
                        const navWishlistCounters = document.querySelectorAll('.fa-heart + span');

                        navWishlistCounters.forEach(counter => {
                            if (count > 0) {
                                counter.textContent = count;
                                counter.classList.remove('hidden');
                            } else {
                                counter.classList.add('hidden');
                            }
                        });
                    }

                    function showNotification(message, type) {
                        // Check if there's an existing notification system
                        // If not, create a simple one
                        const notification = document.createElement('div');
                        notification.classList.add(
                            'fixed', 'top-4', 'right-4', 'px-4', 'py-2', 'rounded-lg', 'shadow-lg',
                            'z-50', 'transition-opacity', 'duration-500'
                        );

                        if (type === 'success') {
                            notification.classList.add('bg-green-100', 'text-green-800');
                        } else {
                            notification.classList.add('bg-red-100', 'text-red-800');
                        }

                        notification.textContent = message;
                        document.body.appendChild(notification);

                        // Remove notification after 3 seconds
                        setTimeout(() => {
                            notification.classList.add('opacity-0');
                            setTimeout(() => {
                                document.body.removeChild(notification);
                            }, 500);
                        }, 3000);
                    }
</script>
    
@endpush
@endsection
