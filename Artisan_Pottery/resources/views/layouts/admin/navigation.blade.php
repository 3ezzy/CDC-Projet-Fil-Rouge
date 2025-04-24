<aside class="bg-white w-64 fixed h-full shadow-lg z-30 sidebar transition-transform duration-300" id="sidebar">
    <div class="p-4 border-b">
        <div class="flex items-center justify-between">
            <a href="/" class="text-2xl font-playfair font-bold text-gray-800">
                Artisan<span class="text-amber-600">.</span>
            </a>
            <button class="md:hidden text-gray-500 hover:text-gray-700" id="closeSidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- User Info -->
    <div class="p-4 border-b">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-amber-600 rounded-full flex items-center justify-center">
                <span class="text-white font-bold">3E</span>
            </div>
            <div>
                <h3 class="font-medium text-gray-800">3ezzy</h3>
                <p class="text-sm text-gray-500">Seller Account</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center space-x-3 text-amber-600 bg-amber-50 rounded-lg px-4 py-3">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('categories.index') }}"
                    class="flex items-center space-x-3 text-gray-600 hover:bg-amber-50 rounded-lg px-4 py-3">
                    <i class="fas fa-tags"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}"
                    class="flex items-center space-x-3 text-gray-600 hover:bg-amber-50 rounded-lg px-4 py-3">
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="{{ route('orders.index') }}"
                    class="flex items-center space-x-3 text-gray-600 hover:bg-amber-50 rounded-lg px-4 py-3">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center space-x-3 text-gray-600 hover:bg-amber-50 rounded-lg px-4 py-3">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
            
            <li class="mt-8 pt-6 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 text-red-600 hover:bg-red-50 rounded-lg px-4 py-3 transition-colors">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>