@extends('layouts.admin.master')

@section('title', 'Seller Dashboard')

@section('content')

<div class="max-w-7xl mx-auto">
    <!-- Dashboard Content -->
    <div class="p-2 sm:p-6 mt-14 sm:mt-0">
        <!-- Welcome Section -->
        <div class="mb-6 sm:mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-xl sm:text-2xl font-playfair font-bold text-gray-800 mb-2">Welcome back,
                        {{ Auth::user()->first_name }}!</h1>
                    <p class="text-sm sm:text-base text-gray-600">Here's what's happening with your store
                        today.</p>
                </div>
                
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
            <!-- Total Sales -->
            <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 hover-scale">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-amber-100 p-2 sm:p-3 rounded-full">
                        <i class="fas fa-dollar-sign text-amber-600"></i>
                    </div>
                    <span class="text-xs sm:text-sm text-green-500">
                        @php
                            $lastMonthSales = App\Models\Order::where('created_at', '<', now()->startOfMonth())
                                ->where('created_at', '>=', now()->subMonths(1)->startOfMonth())
                                ->sum('total_amount');
                            $currentMonthSales = App\Models\Order::where('created_at', '>=', now()->startOfMonth())->sum('total_amount');
                            $percentChange = $lastMonthSales > 0 ? round((($currentMonthSales - $lastMonthSales) / $lastMonthSales) * 100, 1) : 0;
                        @endphp
                        {{ $percentChange > 0 ? '+' . $percentChange : $percentChange }}%
                    </span>
                </div>
                <h3 class="text-gray-600 text-xs sm:text-sm mb-1">Total Sales</h3>
                <p class="text-xl sm:text-2xl font-bold text-gray-800">${{ number_format(App\Models\Order::sum('total_amount'), 2) }}</p>
            </div>

            <!-- Total Orders -->
            <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 hover-scale">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-100 p-2 sm:p-3 rounded-full">
                        <i class="fas fa-shopping-bag text-blue-600"></i>
                    </div>
                    <span class="text-xs sm:text-sm text-green-500">
                        @php
                            $lastMonthOrders = App\Models\Order::where('created_at', '<', now()->startOfMonth())
                                ->where('created_at', '>=', now()->subMonths(1)->startOfMonth())
                                ->count();
                            $currentMonthOrders = App\Models\Order::where('created_at', '>=', now()->startOfMonth())->count();
                            $percentChange = $lastMonthOrders > 0 ? round((($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100, 1) : 0;
                        @endphp
                        {{ $percentChange > 0 ? '+' . $percentChange : $percentChange }}%
                    </span>
                </div>
                <h3 class="text-gray-600 text-xs sm:text-sm mb-1">Total Orders</h3>
                <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ App\Models\Order::count() }}</p>
            </div>

            <!-- Average Rating -->
            <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 hover-scale">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-yellow-100 p-2 sm:p-3 rounded-full">
                        <i class="fas fa-star text-yellow-600"></i>
                    </div>
                    <span class="text-xs sm:text-sm text-green-500">
                        @php
                            $reviews = App\Models\ProductReview::all();
                            $avgRating = $reviews->count() > 0 ? round($reviews->avg('rating'), 1) : 0;
                            $lastMonthAvg = App\Models\ProductReview::where('created_at', '<', now()->startOfMonth())
                                ->where('created_at', '>=', now()->subMonths(1)->startOfMonth())
                                ->avg('rating') ?: 0;
                            $ratingChange = $lastMonthAvg > 0 ? round($avgRating - $lastMonthAvg, 1) : 0;
                        @endphp
                        {{ $ratingChange > 0 ? '+' . $ratingChange : $ratingChange }}
                    </span>
                </div>
                <h3 class="text-gray-600 text-xs sm:text-sm mb-1">Average Rating</h3>
                <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $avgRating }}</p>
            </div>

            <!-- Total Products -->
            <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 hover-scale">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-purple-100 p-2 sm:p-3 rounded-full">
                        <i class="fas fa-box text-purple-600"></i>
                    </div>
                    <span class="text-xs sm:text-sm text-amber-600">
                        @php
                            $newProducts = App\Models\Product::where('created_at', '>=', now()->subDays(30))->count();
                        @endphp
                        +{{ $newProducts }}
                    </span>
                </div>
                <h3 class="text-gray-600 text-xs sm:text-sm mb-1">Total Products</h3>
                <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ App\Models\Product::count() }}</p>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 mb-6 sm:mb-8">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <h3 class="font-playfair text-lg sm:text-xl font-bold text-gray-800">Recent Orders</h3>
                <a href="{{ route('orders.index') }}" class="text-sm text-amber-600 hover:text-amber-700">View
                    All</a>
            </div>
            <div class="overflow-x-auto -mx-4 sm:-mx-6">
                <div class="inline-block min-w-full px-4 sm:px-6">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="pb-3 font-medium text-gray-600 text-xs sm:text-sm">Order ID</th>
                                <th
                                    class="pb-3 font-medium text-gray-600 text-xs sm:text-sm hidden sm:table-cell">
                                    Customer</th>
                                <th class="pb-3 font-medium text-gray-600 text-xs sm:text-sm">Product</th>
                                <th class="pb-3 font-medium text-gray-600 text-xs sm:text-sm">Amount</th>
                                <th class="pb-3 font-medium text-gray-600 text-xs sm:text-sm">Status</th>
                                <th class="pb-3 font-medium text-gray-600 text-xs sm:text-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Models\Order::with(['user', 'items.product'])->latest()->take(3)->get() as $order)
                            <tr class="border-b">
                                <td class="py-3 sm:py-4 text-xs sm:text-sm">{{ $order->order_number }}</td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm hidden sm:table-cell">
                                    {{ $order->shipping_name ?: ($order->user->first_name . ' ' . $order->user->last_name) }}
                                </td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm">
                                    {{ $order->items->first()->product_name ?? 'Multiple Items' }}
                                    @if($order->items->count() > 1)
                                        <span class="text-gray-500 text-xs">(+{{ $order->items->count() - 1 }} more)</span>
                                    @endif
                                </td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm">${{ number_format($order->total_amount, 2) }}</td>
                                <td class="py-3 sm:py-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'yellow',
                                            'processing' => 'yellow',
                                            'shipped' => 'blue',
                                            'delivered' => 'green',
                                            'completed' => 'green',
                                            'cancelled' => 'red'
                                        ];
                                        $status = strtolower($order->status);
                                        $color = $statusColors[$status] ?? 'gray';
                                    @endphp
                                    <span class="px-2 py-1 bg-{{ $color }}-100 text-{{ $color }}-700 rounded-full text-xs">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="py-3 sm:py-4">
                                    <a href="{{ route('orders.show', $order) }}" class="text-xs sm:text-sm text-amber-600 hover:text-amber-700">
                                        Details
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection