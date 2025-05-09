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
                    <a href="{{ route('about') }}"
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
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
            preserveAspectRatio="none">
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
            <p class="text-gray-600 max-w-2xl mx-auto">Explore our carefully curated collection of handcrafted
                pottery, designed with both beauty and functionality in mind.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ([
                ['name' => 'Vases', 'image' => 'https://images.unsplash.com/photo-1597696929736-6d13bed8e6a8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'description' => 'Beautiful vessels for your flowers and decorative accents.'],
                ['name' => 'Dinnerware', 'image' => 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8Y2VyYW1pYyUyMGRpbm5lcndhcmV8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60', 'description' => 'Elegant plates, bowls, and serving pieces for your table.'],
                ['name' => 'Drinkware', 'image' => 'https://plus.unsplash.com/premium_photo-1666974578443-8dd11ef53c38?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'description' => 'Handcrafted mugs, cups, and glasses for your favorite beverages.']
            ] as $category)
            <div class="group">
                <div class="relative overflow-hidden rounded-2xl hover-scale mb-4">
                    <img src="{{ $category['image'] }}" alt="{{ $category['name'] }}" class="w-full h-80 object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                        <div class="p-6">
                            <h3 class="font-playfair text-xl font-bold text-white mb-2">{{ $category['name'] }}</h3>
                            <p class="text-white/80 text-sm mb-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                {{ $category['description'] }}</p>
                            <a href="product.html?category={{ strtolower($category['name']) }}" class="inline-flex items-center text-white">
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
                <a href="product.html" class="inline-flex items-center text-amber-600 hover:text-amber-700 font-medium">
                    <span>View All Products</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
            $products = [
                [
                    'name' => 'Ripple Vase',
                    'image' => 'https://plus.unsplash.com/premium_photo-1682949695712-2dcfebf5ad79?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'rating' => 4.5,
                    'reviews' => 24,
                    'price' => 69.00,
                    'original_price' => 89.00,
                    'badge' => 'Best Seller'
                ],
                [
                    'name' => 'Artisan Mug Set',
                    'image' => 'https://images.unsplash.com/photo-1605883705077-8d3d3cebe78c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTZ8fGNlcmFtaWMlMjBtdWd8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60',
                    'rating' => 5,
                    'reviews' => 36,
                    'price' => 45.00,
                    'badge' => 'Best Seller'
                ],
                [
                    'name' => 'Ceramic Bowl Set',
                    'image' => 'https://plus.unsplash.com/premium_photo-1666974555400-88f1b945a344?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'rating' => 4,
                    'reviews' => 18,
                    'price' => 59.00
                ],
                [
                    'name' => 'Dinner Plate Set',
                    'image' => 'https://images.unsplash.com/photo-1633856859910-ab62d9cf10c4?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'rating' => 3.5,
                    'reviews' => 12,
                    'price' => 65.00,
                    'original_price' => 79.00,
                    'badge' => 'Sale'
                ]
            ];
            @endphp

            @foreach ($products as $index => $product)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover-scale">
                <div class="relative">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-64 object-cover" />
                    @if(isset($product['badge']))
                    <div class="absolute top-4 left-4">
                        <span class="bg-{{ $product['badge'] == 'Sale' ? 'red-500' : 'amber-600' }} text-white text-xs px-3 py-1.5 rounded-full">{{ $product['badge'] }}</span>
                    </div>
                    @endif
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-100 transition-colors"
                            onclick="event.preventDefault(); toggleWishlist({{ $index + 1 }}, this)">
                            <i class="fas fa-heart text-gray-400 hover:text-red-500"></i>
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-playfair text-xl font-bold text-gray-800 mb-2">{{ $product['name'] }}</h3>
                    <div class="flex items-center mb-4">
                        <div class="flex text-amber-400">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($product['rating']))
                                    <i class="fas fa-star"></i>
                                @elseif ($i - 0.5 <= $product['rating'])
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-gray-500 text-sm ml-2">({{ $product['reviews'] }} reviews)</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            @if(isset($product['original_price']))
                            <span class="text-gray-400 line-through text-sm">${{ number_format($product['original_price'], 2) }}</span>
                            @endif
                            <span class="text-amber-600 font-bold {{ isset($product['original_price']) ? 'ml-2' : '' }}">${{ number_format($product['price'], 2) }}</span>
                        </div>
                        <button class="bg-amber-600 hover:bg-amber-700 text-white p-2 rounded-full transition-colors">
                            <i class="fas fa-shopping-bag"></i>
                        </button>
                    </div>
                </div>
            </div>
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
                    to everyday living. Each piece is thoughtfully designed and carefully created by our skilled artisans.
                </p>
                <p class="text-gray-600 mb-8">
                    Our commitment to sustainable practices means we source local materials and use traditional
                    techniques that have been passed down through generations, resulting in pottery that's not only beautiful
                    but also environmentally responsible.
                </p>
                <a href="about.html" class="inline-flex items-center text-amber-600 hover:text-amber-700 font-medium">
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
            
            @foreach ($testimonials as $testimonial)
            <div class="bg-white p-8 rounded-2xl shadow-lg hover-scale">
                <div class="flex text-amber-400 mb-4">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($testimonial['rating']))
                            <i class="fas fa-star"></i>
                        @elseif ($i - 0.5 <= $testimonial['rating'])
                            <i class="fas fa-star-half-alt"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <p class="text-gray-600 mb-6">
                    "{{ $testimonial['comment'] }}"
                </p>
                <div class="flex items-center">
                    <img src="{{ $testimonial['image'] }}" alt="Customer photo"
                        class="w-12 h-12 rounded-full mr-4" />
                    <div>
                        <h4 class="font-bold text-gray-800">{{ $testimonial['name'] }}</h4>
                        <p class="text-gray-500 text-sm">{{ $testimonial['location'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function toggleWishlist(productId, button) {
        // Prevent event propagation
        event.preventDefault();
        event.stopPropagation();

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
                heartIcon.classList.remove('text-gray-400');
                heartIcon.classList.add('text-red-500');
            } else {
                heartIcon.classList.remove('text-red-500');
                heartIcon.classList.add('text-gray-400');
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
        // Create a simple notification
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