@extends('layouts.client.app')

@section('content')
    <section class="pt-32 pb-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="font-playfair text-4xl md:text-5xl font-bold text-gray-800 mb-4">Your Shopping Cart</h1>
                <nav class="flex justify-center">
                    <ol class="flex items-center space-x-2 text-sm text-gray-500">
                        <li><a href="index.html" class="hover:text-amber-600 transition-colors">Home</a></li>
                        <li><span class="mx-2">/</span></li>
                        <li class="text-amber-600 font-medium">Shopping Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Shopping Cart Section -->
    <section class="bg-[#f8f5f2] py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items (2 columns on large screens) -->
                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Shopping Cart</h2>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <!-- Table Header - Visible only on medium screens and up -->
                        <div class="hidden md:grid grid-cols-12 gap-4 p-6 border-b border-gray-200 bg-gray-50">
                            <div class="col-span-6">
                                <span class="font-medium text-gray-700">Product</span>
                            </div>
                            <div class="col-span-2 text-center">
                                <span class="font-medium text-gray-700">Price</span>
                            </div>
                            <div class="col-span-2 text-center">
                                <span class="font-medium text-gray-700">Quantity</span>
                            </div>
                            <div class="col-span-2 text-right">
                                <span class="font-medium text-gray-700">Subtotal</span>
                            </div>
                        </div>

                        @if (count($cart) > 0)
                            <!-- Cart Items Container -->
                            <div class="divide-y divide-gray-200">
                                @foreach ($cart as $id => $item)
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 p-6">
                                        <!-- Product Info -->
                                        <div class="col-span-1 md:col-span-6">
                                            <div class="flex flex-col md:flex-row items-center">
                                                <div
                                                    class="w-24 h-24 bg-[#f8f5f2] rounded-lg overflow-hidden mb-4 md:mb-0 md:mr-4 flex-shrink-0">
                                                    @if (isset($item['image_path']) && $item['image_path'])
                                                        <img src="{{ asset('storage/' . $item['image_path']) }}"
                                                            alt="{{ $item['name'] }}" class="w-full h-full object-cover"
                                                            loading="lazy">
                                                    @else
                                                        <div
                                                            class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                                                            <i class="fas fa-image text-gray-400 text-2xl"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="text-center md:text-left">
                                                    <h3 class="font-medium text-gray-800 mb-1">{{ $item['name'] }}</h3>
                                                    <button onclick="removeItem({{ $id }})"
                                                        class="text-amber-600 hover:text-amber-700 hover:underline text-sm mt-2 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 rounded">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Price -->
                                        <div
                                            class="col-span-1 md:col-span-2 md:text-center flex justify-between items-center md:block">
                                            <span class="text-gray-500 md:hidden">Price</span>
                                            <span
                                                class="font-medium text-gray-800">${{ number_format($item['price'], 2) }}</span>
                                        </div>

                                        <!-- Quantity Selector -->
                                        <div
                                            class="col-span-1 md:col-span-2 md:text-center flex justify-between items-center md:block">
                                            <span class="text-gray-500 md:hidden">Quantity</span>
                                            <div class="flex items-center justify-center">
                                                <div
                                                    class="inline-flex items-center border border-gray-300 rounded-lg bg-white">
                                                    <button onclick="updateQuantity({{ $id }}, 'decrease')"
                                                        class="px-3 py-1 text-gray-500 hover:text-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
                                                        aria-label="Decrease quantity">
                                                        -
                                                    </button>
                                                    <input type="number" value="{{ $item['quantity'] }}" min="1"
                                                        aria-label="Product quantity"
                                                        class="w-12 text-center border-0 focus:ring-0 focus:outline-none text-gray-800"
                                                        onchange="updateQuantity({{ $id }}, 'set', this.value)">
                                                    <button onclick="updateQuantity({{ $id }}, 'increase')"
                                                        class="px-3 py-1 text-gray-500 hover:text-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
                                                        aria-label="Increase quantity">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Subtotal -->
                                        <div
                                            class="col-span-1 md:col-span-2 md:text-right flex justify-between items-center md:block">
                                            <span class="text-gray-500 md:hidden">Subtotal</span>
                                            <span
                                                class="font-medium text-gray-800">${{ number_format($item['total'], 2) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Cart Summary -->
                            <div class="p-6 bg-gray-50 mt-4">
                                <div class="max-w-md mx-auto">
                                    <div class="space-y-4">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Subtotal</span>
                                            <span class="font-medium text-gray-800">${{ number_format((float)$total, 2) }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Shipping</span>
                                            <span class="text-gray-600">Calculated at checkout</span>
                                        </div>
                                        <div class="border-t border-gray-200 pt-4">
                                            <div class="flex justify-between">
                                                <span class="text-lg font-semibold text-gray-900">Total</span>
                                                <span
                                                    class="text-lg font-semibold text-gray-900">${{ number_format((float)$total, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-between">
                                        <a href="{{ route('shop') }}"
                                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors duration-200">
                                            <i class="fas fa-arrow-left mr-2"></i>
                                            Continue Shopping
                                        </a>
                                        <a href="{{ route('checkout') }}"
                                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors duration-200">
                                            Proceed to Checkout
                                            <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Empty Cart State -->
                            <div class="text-center py-16">
                                <div class="mb-6">
                                    <i class="fas fa-shopping-cart text-gray-400 text-5xl"></i>
                                </div>
                                <h2 class="text-2xl font-medium text-gray-600 mb-6">Your cart is empty</h2>
                                <p class="text-gray-500 mb-8">Looks like you haven't added anything to your cart yet.</p>
                                <a href="{{ route('shop') }}"
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors duration-200">
                                    <i class="fas fa-shopping-bag mr-2"></i>
                                    Start Shopping
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function updateQuantity(productId, action) {
        fetch(`/cart/update/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                action: action
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Failed to update quantity', 'error');
        });
    }

    function removeItem(productId) {
        if (confirm('Are you sure you want to remove this item?')) {
            fetch(`/cart/remove/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to remove item', 'error');
            });
        }
    }

    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white z-50`;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
</script>
@endpush
