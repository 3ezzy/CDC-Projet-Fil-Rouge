@extends('layouts.admin.master')

@section('title', 'Order Details')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div class="mb-4 md:mb-0">
            <div class="flex items-center">
                <a href="{{ route('orders.index') }}" class="text-amber-600 mr-2">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-playfair font-bold text-gray-800">Order {{ $order->order_number }}</h1>
            </div>
            <p class="text-gray-600 mt-1">Created on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
        </div>
        <div class="flex items-center space-x-4">
            <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-print mr-2"></i>Print Invoice
            </button>
            <form action="{{ route('orders.update-status', $order) }}" method="POST" class="flex items-center">
                @csrf
                @method('PATCH')
                <select name="status" class="mr-2 border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors">
                    Update Status
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Order Items</h2>
                </div>
                <div class="p-6">
                    <div class="divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            <div class="py-4 {{ $loop->first ? 'pt-0' : '' }} {{ $loop->last ? 'pb-0' : '' }}">
                                <div class="flex items-center">
                                    @if($item->product && $item->product->image_path)
                                        <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product_name }}" class="w-16 h-16 object-cover rounded-md">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center">
                                            <i class="fas fa-box text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div class="ml-4 flex-1">
                                        <div class="flex justify-between">
                                            <div>
                                                <h3 class="text-sm font-medium text-gray-900">{{ $item->product_name }}</h3>
                                                <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-sm font-medium text-gray-900">${{ number_format($item->price, 2) }}</p>
                                                <p class="text-sm text-gray-500">${{ number_format($item->subtotal, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between text-sm">
                        <span class="font-medium text-gray-600">Subtotal:</span>
                        <span class="font-medium">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm mt-2">
                        <span class="font-medium text-gray-600">Shipping:</span>
                        <span class="font-medium">$0.00</span>
                    </div>
                    <div class="flex justify-between text-base font-bold mt-4 pt-4 border-t border-gray-200">
                        <span>Total:</span>
                        <span>${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Payment Information</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Payment Method</p>
                            <p class="font-medium">{{ ucfirst($order->payment_method) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Payment Status</p>
                            <p class="font-medium">{{ ucfirst($order->payment_status) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Payment ID</p>
                            <p class="font-medium">{{ $order->payment_id ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Transaction ID</p>
                            <p class="font-medium">{{ $order->transaction_id ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Customer Information -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Customer</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        @if($order->user && $order->user->profile_image)
                            <img src="{{ asset('storage/' . $order->user->profile_image) }}" class="h-12 w-12 rounded-full">
                        @else
                            <div class="h-12 w-12 rounded-full bg-amber-100 flex items-center justify-center">
                                <span class="text-amber-800 text-lg">{{ substr($order->shipping_name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="ml-3">
                            <h3 class="text-base font-medium text-gray-900">{{ $order->shipping_name }}</h3>
                            <p class="text-sm text-gray-600">{{ $order->user ? 'Registered Customer' : 'Guest' }}</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Email</p>
                            <p class="font-medium">{{ $order->shipping_email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Phone</p>
                            <p class="font-medium">{{ $order->shipping_phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Shipping Address</h2>
                </div>
                <div class="p-6">
                    <address class="not-italic">
                        <p class="font-medium">{{ $order->shipping_name }}</p>
                        <p class="mt-1 text-gray-600">{{ $order->shipping_address }}</p>
                        <p class="text-gray-600">
                            {{ $order->shipping_city }}, 
                            @if($order->shipping_state)
                                {{ $order->shipping_state }}, 
                            @endif
                            {{ $order->shipping_zipcode }}
                        </p>
                        <p class="text-gray-600">{{ $order->shipping_country }}</p>
                    </address>
                </div>
            </div>

            <!-- Order Notes -->
            @if($order->notes)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Notes</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700">{{ $order->notes }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 