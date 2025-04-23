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
                            <span class="font-medium">{{ $order->order_number ?? '#ORD-' . date('Ymd-His') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date:</span>
                            <span class="font-medium">{{ $order->created_at->format('Y-m-d H:i:s') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Customer:</span>
                            <span class="font-medium">{{ $order->shipping_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="font-medium">{{ ucfirst($order->status) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Payment Status:</span>
                            <span class="font-medium">{{ ucfirst($order->payment_status) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    @php
                                        $product = App\Models\Product::find($item->product_id);
                                        $imagePath = $product ? $product->image_path : null;
                                    @endphp
                                    
                                    @if($imagePath)
                                        <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $item->product_name }}" class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                    
                                    <div>
                                        <h3 class="font-medium">{{ $item->product_name }}</h3>
                                        <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <span class="font-medium">${{ number_format($item->subtotal, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Total Summary -->
                <div class="space-y-2 mb-8">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal:</span>
                        <span>${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping:</span>
                        <span>$0.00</span>
                    </div>
                    <div class="flex justify-between text-lg font-semibold">
                        <span>Total:</span>
                        <span>${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold mb-4">Shipping Information</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="font-medium text-gray-600 mb-2">Shipping Address</h3>
                            <p class="text-sm">
                                {{ $order->shipping_name }}<br>
                                {{ $order->shipping_address }}<br>
                                {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zipcode }}<br>
                                {{ $order->shipping_country }}
                            </p>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-600 mb-2">Contact Information</h3>
                            <p class="text-sm">
                                Email: {{ $order->shipping_email }}<br>
                                @if($order->shipping_phone)
                                    Phone: {{ $order->shipping_phone }}
                                @endif
                            </p>
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