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
                            <button id="wishlist-button" type="button" onclick="toggleWishlist({{ $product->id }})" 
                                class="flex items-center text-gray-600 hover:text-amber-600 transition-colors">
                                <i class="fa{{ in_array($product->id, array_keys(session('wishlist', []))) ? 's' : 'r' }} fa-heart mr-2 {{ in_array($product->id, array_keys(session('wishlist', []))) ? 'text-red-500' : '' }}"></i>
                                <span>{{ in_array($product->id, array_keys(session('wishlist', []))) ? 'Remove from' : 'Add to' }} Wishlist</span>
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


    <!-- Reviews Section -->
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Reviews</h2>

            <!-- Review Form -->
            @auth
                <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="mb-6">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                        <div class="flex flex-row-reverse items-center justify-end">
                            <input type="radio" id="rating-5" name="rating" value="5" class="hidden peer">
                            <label for="rating-5"
                                class="cursor-pointer px-1 text-gray-300 peer-checked:text-amber-500 hover:text-amber-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            </label>

                            <input type="radio" id="rating-4" name="rating" value="4" class="hidden peer">
                            <label for="rating-4"
                                class="cursor-pointer px-1 text-gray-300 peer-checked:text-amber-500 hover:text-amber-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            </label>

                            <input type="radio" id="rating-3" name="rating" value="3" class="hidden peer">
                            <label for="rating-3"
                                class="cursor-pointer px-1 text-gray-300 peer-checked:text-amber-500 hover:text-amber-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            </label>

                            <input type="radio" id="rating-2" name="rating" value="2" class="hidden peer">
                            <label for="rating-2"
                                class="cursor-pointer px-1 text-gray-300 peer-checked:text-amber-500 hover:text-amber-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            </label>

                            <input type="radio" id="rating-1" name="rating" value="1" class="hidden peer">
                            <label for="rating-1"
                                class="cursor-pointer px-1 text-gray-300 peer-checked:text-amber-500 hover:text-amber-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                        <textarea name="comment" id="comment" rows="4" class="block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    <button type="submit" class="bg-amber-600 text-white px-4 py-2 rounded-lg">Submit Review</button>
                </form>
            @else
                <p class="text-sm text-gray-600">Please <a href="{{ route('login') }}" class="text-amber-600">login</a> to
                    leave a review.</p>
            @endauth

            <!-- Display Reviews -->
            <div class="space-y-4">
                @forelse ($product->reviews as $review)
                    <div class="p-4 bg-white shadow rounded-lg">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-800">{{ $review->user->first_name }}
                                {{ $review->user->last_name }}</h3>
                            <div class="flex">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p class="text-gray-600 mt-2">{{ $review->comment }}</p>
                        <small class="text-gray-400">{{ $review->created_at->format('F j, Y') }}</small>
                    </div>
                @empty
                    <p class="text-gray-500">No reviews yet. Be the first to leave one!</p>
                @endforelse
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            function updateQuantity(delta) {
                const input = document.getElementById('quantity');
                const currentValue = parseInt(input.value);
                const maxValue = parseInt(input.max);
                
                let newValue = currentValue + delta;
                if (newValue < 1) newValue = 1;
                if (newValue > maxValue) newValue = maxValue;
                
                input.value = newValue;
            }

            function toggleWishlist(productId) {
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
                    // Update wishlist button appearance
                    const button = document.getElementById('wishlist-button');
                    const icon = button.querySelector('i');
                    const text = button.querySelector('span');
                    
                    if (data.in_wishlist) {
                        icon.classList.remove('far');
                        icon.classList.add('fas', 'text-red-500');
                        text.textContent = 'Remove from Wishlist';
                    } else {
                        icon.classList.remove('fas', 'text-red-500');
                        icon.classList.add('far');
                        text.textContent = 'Add to Wishlist';
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

            // Review star rating functionality
            document.addEventListener('DOMContentLoaded', function() {
                const stars = document.querySelectorAll('[id^="rating-"]');
                const labels = document.querySelectorAll('[for^="rating-"]');

                // Function to update stars based on selection
                function updateStars(selectedRating) {
                    labels.forEach(label => {
                        const ratingValue = parseInt(label.getAttribute('for').split('-')[1]);

                        if (ratingValue <= selectedRating) {
                            label.classList.remove('text-gray-300');
                            label.classList.add('text-amber-500');
                        } else {
                            label.classList.remove('text-amber-500');
                            label.classList.add('text-gray-300');
                        }
                    });
                }
                
                // Handle click events
                stars.forEach(star => {
                    star.addEventListener('change', function() {
                        updateStars(parseInt(this.value));
                    });
                });
                
                // Handle hover effects
                labels.forEach(label => {
                    label.addEventListener('mouseenter', function() {
                        const ratingValue = parseInt(this.getAttribute('for').split('-')[1]);

                        labels.forEach(lbl => {
                            const lblValue = parseInt(lbl.getAttribute('for').split('-')[1]);

                            if (lblValue <= ratingValue) {
                                lbl.classList.remove('text-gray-300');
                                lbl.classList.add('text-amber-500');
                            } else {
                                lbl.classList.remove('text-amber-500');
                                lbl.classList.add('text-gray-300');
                            }
                        });
                    });

                    // When mouse leaves, revert to the actual selection
                    label.addEventListener('mouseleave', function() {
                        const selectedStar = document.querySelector('[name="rating"]:checked');
                        if (selectedStar) {
                            updateStars(parseInt(selectedStar.value));
                        } else {
                            labels.forEach(lbl => {
                                lbl.classList.remove('text-amber-500');
                                lbl.classList.add('text-gray-300');
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
