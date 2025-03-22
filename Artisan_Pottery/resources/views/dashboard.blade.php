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
                        3ezzy!</h1>
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
                    <span class="text-xs sm:text-sm text-green-500">+12.5%</span>
                </div>
                <h3 class="text-gray-600 text-xs sm:text-sm mb-1">Total Sales</h3>
                <p class="text-xl sm:text-2xl font-bold text-gray-800">$12,426</p>
            </div>

            <!-- Total Orders -->
            <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 hover-scale">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-100 p-2 sm:p-3 rounded-full">
                        <i class="fas fa-shopping-bag text-blue-600"></i>
                    </div>
                    <span class="text-xs sm:text-sm text-green-500">+8.2%</span>
                </div>
                <h3 class="text-gray-600 text-xs sm:text-sm mb-1">Total Orders</h3>
                <p class="text-xl sm:text-2xl font-bold text-gray-800">284</p>
            </div>

            <!-- Average Rating -->
            <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 hover-scale">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-yellow-100 p-2 sm:p-3 rounded-full">
                        <i class="fas fa-star text-yellow-600"></i>
                    </div>
                    <span class="text-xs sm:text-sm text-green-500">+0.3</span>
                </div>
                <h3 class="text-gray-600 text-xs sm:text-sm mb-1">Average Rating</h3>
                <p class="text-xl sm:text-2xl font-bold text-gray-800">4.8</p>
            </div>

            <!-- Total Products -->
            <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 hover-scale">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-purple-100 p-2 sm:p-3 rounded-full">
                        <i class="fas fa-box text-purple-600"></i>
                    </div>
                    <span class="text-xs sm:text-sm text-amber-600">+5</span>
                </div>
                <h3 class="text-gray-600 text-xs sm:text-sm mb-1">Total Products</h3>
                <p class="text-xl sm:text-2xl font-bold text-gray-800">46</p>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 mb-6 sm:mb-8">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <h3 class="font-playfair text-lg sm:text-xl font-bold text-gray-800">Recent Orders</h3>
                <a href="manage-orders.html" class="text-sm text-amber-600 hover:text-amber-700">View
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
                            <tr class="border-b">
                                <td class="py-3 sm:py-4 text-xs sm:text-sm">#ORD-7842</td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm hidden sm:table-cell">Sarah
                                    Johnson</td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm">Ceramic Vase Set</td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm">$128.50</td>
                                <td class="py-3 sm:py-4">
                                    <span
                                        class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">Completed</span>
                                </td>
                                <td class="py-3 sm:py-4">
                                    <button
                                        class="text-xs sm:text-sm text-amber-600 hover:text-amber-700">Details</button>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 sm:py-4 text-xs sm:text-sm">#ORD-7841</td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm hidden sm:table-cell">Mike Peters
                                </td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm">Dinner Plate Set</td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm">$95.00</td>
                                <td class="py-3 sm:py-4">
                                    <span
                                        class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">Processing</span>
                                </td>
                                <td class="py-3 sm:py-4">
                                    <button
                                        class="text-xs sm:text-sm text-amber-600 hover:text-amber-700">Details</button>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 sm:py-4 text-xs sm:text-sm">#ORD-7840</td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm hidden sm:table-cell">Emma
                                    Thompson</td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm">Tea Set Collection</td>
                                <td class="py-3 sm:py-4 text-xs sm:text-sm">$245.00</td>
                                <td class="py-3 sm:py-4">
                                    <span
                                        class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">Shipped</span>
                                </td>
                                <td class="py-3 sm:py-4">
                                    <button
                                        class="text-xs sm:text-sm text-amber-600 hover:text-amber-700">Details</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection