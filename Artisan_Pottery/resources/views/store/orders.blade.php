@extends('layouts.client.app')

@section('title', 'My Orders')

@section('content')
    <!-- Orders Section -->
    <section class="pt-32 pb-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-['Playfair_Display'] font-bold text-gray-800 mb-3">My Orders</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">View and track all your orders in one place</p>
            </div>

            @if (auth()->user()->orders->count() > 0)
                <div class="overflow-hidden bg-white rounded-2xl shadow-lg">
                    <!-- Orders Table (Desktop) -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Order Number</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Date</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Total</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Status</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth()->user()->orders as $order)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">{{ $order->order_number }}</td>
                                        <td class="px-6 py-4">{{ $order->created_at->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4">${{ number_format($order->total_amount, 2) }}</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium
                                                @if ($order->status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($order->status == 'processing')
                                                    bg-blue-100 text-blue-800
                                                @elseif($order->status == 'shipped')
                                                    bg-indigo-100 text-indigo-800
                                                @elseif($order->status == 'delivered')
                                                    bg-green-100 text-green-800
                                                @elseif($order->status == 'cancelled')
                                                    bg-red-100 text-red-800 @endif
                                            ">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium
                                                @if ($order->payment_status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($order->payment_status == 'paid')
                                                    bg-green-100 text-green-800
                                                @elseif($order->payment_status == 'failed')
                                                    bg-red-100 text-red-800 @endif
                                            ">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Orders List (Mobile) -->
                    <div class="md:hidden">
                        @foreach (auth()->user()->orders as $order)
                            <div class="p-4 border-b border-gray-200">
                                <div class="flex justify-between items-center mb-2">
                                    <p class="font-medium">{{ $order->order_number }}</p>
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium
                                        @if ($order->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status == 'processing')
                                            bg-blue-100 text-blue-800
                                        @elseif($order->status == 'shipped')
                                            bg-indigo-100 text-indigo-800
                                        @elseif($order->status == 'delivered')
                                            bg-green-100 text-green-800
                                        @elseif($order->status == 'cancelled')
                                            bg-red-100 text-red-800 @endif
                                    ">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-600 space-y-1">
                                    <p>Date: {{ $order->created_at->format('Y-m-d') }}</p>
                                    <p>Total: ${{ number_format($order->total_amount, 2) }}</p>
                                    <p>Payment:
                                        <span
                                            class="px-2 py-0.5 rounded-full text-xs font-medium
                                            @if ($order->payment_status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($order->payment_status == 'paid')
                                                bg-green-100 text-green-800
                                            @elseif($order->payment_status == 'failed')
                                                bg-red-100 text-red-800 @endif
                                        ">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </p>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <i class="fas fa-shopping-bag text-3xl text-gray-400"></i>
                    </div>
                    <h2 class="text-2xl font-['Playfair_Display'] font-bold text-gray-800 mb-2">No Orders Yet</h2>
                    <p class="text-gray-600 mb-6">You haven't placed any orders yet.</p>
                    <a href="{{ route('shop') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-full text-base font-medium text-white bg-amber-600 hover:bg-amber-700 transition-colors">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
