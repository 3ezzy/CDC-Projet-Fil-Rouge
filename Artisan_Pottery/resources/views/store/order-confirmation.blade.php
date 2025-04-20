@extends('layouts.client.app')

@section('title', 'Order Confirmation')

@section('content')
    <!-- Order Confirmation Section -->
    <section class="pt-32 pb-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <!-- Success Icon -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <i class="fas fa-check text-3xl text-green-500"></i>
                    </div>
                    <h1 class="text-3xl font-['Playfair_Display'] font-bold text-gray-800 mb-2">Order Confirmed!</h1>
                    <p class="text-gray-600">Thank you for your purchase</p>
                </div>

                <!-- Order Details -->
                <div class="border-t border-b border-gray-200 py-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">Order Details</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Order Number:</span>
                            <span class="font-medium">{{ $orderId ?? '#ORD-' . date('Ymd-His') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date:</span>
                            <span class="font-medium">{{ date('Y-m-d H:i:s') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Customer:</span>
                            <span class="font-medium">{{ auth()->user()->name ?? 'Guest' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-4">
                                <img src="path/to/product-image.jpg" alt="Product" class="w-16 h-16 object-cover rounded-lg">
                                <div>
                                    <h3 class="font-medium">Elegant Ceramic Vase</h3>
                                    <p class="text-sm text-gray-500">Quantity: 1</p>
                                </div>
                            </div>
                            <span class="font-medium">$89.99</span>
                        </div>
                        <!-- Add more products as needed -->
                    </div>
                </div>

                <!-- Total Summary -->
                <div class="space-y-2 mb-8">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal:</span>
                        <span>$89.99</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping:</span>
                        <span>$5.00</span>
                    </div>
                    <div class="flex justify-between text-lg font-semibold">
                        <span>Total:</span>
                        <span>$94.99</span>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold mb-4">Shipping Information</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="font-medium text-gray-600 mb-2">Shipping Address</h3>
                            <p class="text-sm">
                                John Doe<br>
                                123 Main Street<br>
                                Apt 4B<br>
                                New York, NY 10001<br>
                                United States
                            </p>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-600 mb-2">Shipping Method</h3>
                            <p class="text-sm">Standard Shipping (3-5 business days)</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('shop') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-full text-base font-medium text-white bg-amber-600 hover:bg-amber-700 transition-colors">
                        Continue Shopping
                    </a>
                    <button class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-full text-base font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        <i class="fas fa-download mr-2"></i>
                        Download Receipt
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Need Help Section -->
    <section class="pb-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-xl font-semibold mb-4">Need Help?</h2>
            <p class="text-gray-600 mb-4">If you have any questions about your order, please contact our customer service</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-6 py-3 border border-amber-600 rounded-full text-base font-medium text-amber-600 hover:bg-amber-50 transition-colors">
                Contact Support
            </a>
        </div>
    </section>
@endsection 