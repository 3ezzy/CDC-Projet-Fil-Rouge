@extends('layouts.admin.master')

@section('title', 'Seller Dashboard')

@section('content')

<div class="max-w-7xl mx-auto pixel-bg-grid" style="min-height: 100vh;">
    <!-- Dashboard Content -->
    <div class="p-2 sm:p-6 mt-14 sm:mt-0">
        <!-- Welcome Section -->
        <div class="mb-6 sm:mb-8 pixel-panel p-6 pixel-hover relative">
            <!-- Decorative pixel art elements -->
            <div class="absolute top-2 right-2 pixel-star pixel-float"></div>
            <div class="absolute top-2 right-8 pixel-heart pixel-pulse" style="animation-delay: 0.5s;"></div>
            
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-xl sm:text-2xl font-playfair font-bold pixel-text-primary mb-2">
                        <span class="pixel-glow">Welcome back, {{ Auth::user()->first_name }}!</span>
                    </h1>
                    <p class="text-sm sm:text-base pixel-text-secondary">
                        Here's what's happening with your pixel pottery store today.
                    </p>
                </div>
                
                <!-- Pixel Art Calendar Icon -->
                <div class="pixel-icon-calendar pixel-float"></div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
            <!-- Total Sales -->
            <div class="pixel-panel-primary p-4 sm:p-6 pixel-hover relative">
                <!-- Decorative corner elements -->
                <div class="absolute top-1 left-1 w-2 h-2 bg-white pixel-art"></div>
                <div class="absolute top-1 right-1 w-2 h-2 bg-white pixel-art"></div>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="pixel-panel p-2 sm:p-3" style="background: var(--pixel-warning);">
                        <i class="fas fa-dollar-sign pixel-text-secondary" style="font-size: 20px;"></i>
                    </div>
                    <span class="text-xs sm:text-sm pixel-text-secondary font-bold pixel-button" style="padding: 4px 8px;">
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
                <h3 class="pixel-text-secondary text-xs sm:text-sm mb-1 font-bold text-shadow">Total Sales</h3>
                <p class="text-xl sm:text-2xl font-bold pixel-text-secondary">${{ number_format(App\Models\Order::sum('total_amount'), 2) }}</p>
                
                <!-- Pixel progress bar -->
                <div class="pixel-progress mt-3">
                    <div class="pixel-progress-bar" style="width: {{ min(100, ($currentMonthSales / max(1, $lastMonthSales)) * 50) }}%"></div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="pixel-panel-accent p-4 sm:p-6 pixel-hover relative">
                <!-- Decorative corner elements -->
                <div class="absolute top-1 left-1 w-2 h-2 bg-white pixel-art"></div>
                <div class="absolute top-1 right-1 w-2 h-2 bg-white pixel-art"></div>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="pixel-panel p-2 sm:p-3" style="background: var(--pixel-primary);">
                        <i class="fas fa-shopping-bag text-white" style="font-size: 20px;"></i>
                    </div>
                    <span class="text-xs sm:text-sm text-white font-bold pixel-button" style="padding: 4px 8px; background: var(--pixel-success);">
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
                <h3 class="text-white text-xs sm:text-sm mb-1 font-bold text-shadow">Total Orders</h3>
                <p class="text-xl sm:text-2xl font-bold text-white">{{ App\Models\Order::count() }}</p>
                
                <!-- Pixel progress bar -->
                <div class="pixel-progress mt-3">
                    <div class="pixel-progress-bar" style="width: {{ min(100, ($currentMonthOrders / max(1, $lastMonthOrders)) * 50) }}%"></div>
                </div>
            </div>

            <!-- Average Rating -->
            <div class="pixel-panel p-4 sm:p-6 pixel-hover relative" style="background: var(--pixel-warning);">
                <!-- Decorative corner elements -->
                <div class="absolute top-1 left-1 w-2 h-2" style="background: var(--pixel-secondary);"></div>
                <div class="absolute top-1 right-1 w-2 h-2" style="background: var(--pixel-secondary);"></div>
                
                <!-- Star decorations -->
                <div class="absolute top-2 right-2 pixel-star" style="animation-delay: 1s;"></div>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="pixel-panel p-2 sm:p-3" style="background: var(--pixel-accent);">
                        <i class="fas fa-star text-white" style="font-size: 20px;"></i>
                    </div>
                    <span class="text-xs sm:text-sm pixel-text-secondary font-bold pixel-button" style="padding: 4px 8px;">
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
                <h3 class="pixel-text-secondary text-xs sm:text-sm mb-1 font-bold text-shadow">Average Rating</h3>
                <p class="text-xl sm:text-2xl font-bold pixel-text-secondary">{{ $avgRating }}</p>
                
                <!-- Star rating display -->
                <div class="flex mt-2">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $avgRating)
                            <div class="pixel-star mr-1"></div>
                        @else
                            <div class="pixel-star mr-1" style="background: var(--pixel-neutral); opacity: 0.5;"></div>
                        @endif
                    @endfor
                </div>
            </div>

            <!-- Total Products -->
            <div class="pixel-panel p-4 sm:p-6 pixel-hover relative" style="background: var(--pixel-accent-light);">
                <!-- Decorative corner elements -->
                <div class="absolute top-1 left-1 w-2 h-2 bg-white pixel-art"></div>
                <div class="absolute top-1 right-1 w-2 h-2 bg-white pixel-art"></div>
                
                <!-- Heart decoration -->
                <div class="absolute top-2 right-2 pixel-heart pixel-pulse" style="animation-delay: 1.5s;"></div>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="pixel-panel p-2 sm:p-3" style="background: var(--pixel-secondary);">
                        <i class="fas fa-box text-white" style="font-size: 20px;"></i>
                    </div>
                    <span class="text-xs sm:text-sm text-white font-bold pixel-button" style="padding: 4px 8px; background: var(--pixel-primary);">
                        @php
                            $newProducts = App\Models\Product::where('created_at', '>=', now()->subDays(30))->count();
                        @endphp
                        +{{ $newProducts }}
                    </span>
                </div>
                <h3 class="text-white text-xs sm:text-sm mb-1 font-bold text-shadow">Total Products</h3>
                <p class="text-xl sm:text-2xl font-bold text-white">{{ App\Models\Product::count() }}</p>
                
                <!-- Pixel progress bar -->
                <div class="pixel-progress mt-3">
                    <div class="pixel-progress-bar" style="width: {{ min(100, ($newProducts / max(1, 10)) * 100) }}%"></div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="pixel-panel p-4 sm:p-6 mb-6 sm:mb-8 pixel-hover relative">
            <!-- Decorative elements -->
            <div class="absolute top-2 left-2 pixel-star pixel-float"></div>
            <div class="absolute bottom-2 right-2 pixel-heart pixel-pulse" style="animation-delay: 2s;"></div>
            
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <h3 class="font-playfair text-lg sm:text-xl font-bold pixel-text-primary">Recent Orders</h3>
                <a href="{{ route('orders.index') }}" class="pixel-button text-sm text-white p-2">View All</a>
            </div>
            
            <div class="overflow-x-auto -mx-4 sm:-mx-6">
                <div class="inline-block min-w-full px-4 sm:px-6">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b-4" style="border-color: var(--pixel-secondary);">
                                <th class="pb-3 font-medium pixel-text-secondary text-xs sm:text-sm">Order ID</th>
                                <th class="pb-3 font-medium pixel-text-secondary text-xs sm:text-sm hidden sm:table-cell">Customer</th>
                                <th class="pb-3 font-medium pixel-text-secondary text-xs sm:text-sm">Product</th>
                                <th class="pb-3 font-medium pixel-text-secondary text-xs sm:text-sm">Amount</th>
                                <th class="pb-3 font-medium pixel-text-secondary text-xs sm:text-sm">Status</th>
                                <th class="pb-3 font-medium pixel-text-secondary text-xs sm:text-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Models\Order::with(['user', 'items.product'])->latest()->take(3)->get() as $order)
                            <tr class="border-b-2 pixel-hover" style="border-color: var(--pixel-neutral-dark);">
                                <td class="py-3 sm:py-4 text-xs sm:text-sm pixel-text-secondary font-bold">{{ $order->order_number }}</td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm hidden sm:table-cell pixel-text-secondary">
                                    {{ $order->shipping_name ?: ($order->user->first_name . ' ' . $order->user->last_name) }}
                                </td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm pixel-text-secondary">
                                    {{ $order->items->first()->product_name ?? 'Multiple Items' }}
                                    @if($order->items->count() > 1)
                                        <span class="pixel-text-accent text-xs">(+{{ $order->items->count() - 1 }} more)</span>
                                    @endif
                                </td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm pixel-text-primary font-bold">${{ number_format($order->total_amount, 2) }}</td>
                                <td class="py-3 sm:py-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'var(--pixel-warning)',
                                            'processing' => 'var(--pixel-primary)',
                                            'shipped' => 'var(--pixel-accent)',
                                            'delivered' => 'var(--pixel-success)',
                                            'completed' => 'var(--pixel-success)',
                                            'cancelled' => 'var(--pixel-error)'
                                        ];
                                        $status = strtolower($order->status);
                                        $color = $statusColors[$status] ?? 'var(--pixel-neutral)';
                                    @endphp
                                    <span class="pixel-button text-xs font-bold text-white" style="background: {{ $color }}; padding: 4px 8px;">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="py-3 sm:py-4">
                                    <a href="{{ route('orders.show', $order) }}" class="pixel-button text-xs sm:text-sm text-white p-1">
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
        
        <!-- Pixel Art Footer with animated elements -->
        <div class="text-center py-6">
            <div class="flex justify-center space-x-4 mb-4">
                <div class="pixel-star pixel-float"></div>
                <div class="pixel-heart pixel-pulse"></div>
                <div class="pixel-star pixel-float" style="animation-delay: 1s;"></div>
                <div class="pixel-heart pixel-pulse" style="animation-delay: 0.5s;"></div>
                <div class="pixel-star pixel-float" style="animation-delay: 1.5s;"></div>
            </div>
            <p class="pixel-text-secondary font-bold">✨ Crafted with pixel art magic ✨</p>
        </div>
    </div>
</div>

@endsection