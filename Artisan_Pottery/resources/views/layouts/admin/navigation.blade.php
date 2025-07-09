<aside class="pixel-panel w-64 fixed h-full z-30 sidebar transition-transform duration-300 pixel-border" id="sidebar" style="background: var(--pixel-neutral-light);">
    <div class="p-4 pixel-border-primary">
        <div class="flex items-center justify-between">
            <a href="/" class="text-2xl font-playfair font-bold pixel-text-primary pixel-glow">
                🏺 Pixel<span class="pixel-text-accent">Pottery</span>
            </a>
            <button class="md:hidden pixel-button p-2" id="closeSidebar">
                <i class="fas fa-times pixel-text-secondary"></i>
            </button>
        </div>
    </div>

    <!-- User Info with Pixel Art -->
    <div class="p-4 pixel-border-accent">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 pixel-panel-primary flex items-center justify-center pixel-art">
                <span class="text-white font-bold text-shadow">{{ substr(Auth::user()->first_name, 0, 1) }}{{ substr(Auth::user()->last_name, 0, 1) }}</span>
            </div>
            <div>
                <h3 class="font-medium pixel-text-secondary font-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                <p class="text-sm pixel-text-accent">✨ Pixel Artist ✨</p>
            </div>
        </div>
    </div>

    <!-- Navigation with Pixel Art Styling -->
    <nav class="p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center space-x-3 pixel-panel-primary px-4 py-3 pixel-hover font-bold text-white">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                    <div class="ml-auto pixel-star pixel-pulse"></div>
                </a>
            </li>
            <li>
                <a href="{{ route('categories.index') }}"
                    class="flex items-center space-x-3 pixel-text-secondary hover:bg-gray-100 px-4 py-3 pixel-hover font-bold border-2 border-transparent hover:border-current">
                    <i class="fas fa-tags"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}"
                    class="flex items-center space-x-3 pixel-text-secondary hover:bg-gray-100 px-4 py-3 pixel-hover font-bold border-2 border-transparent hover:border-current">
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="{{ route('orders.index') }}"
                    class="flex items-center space-x-3 pixel-text-secondary hover:bg-gray-100 px-4 py-3 pixel-hover font-bold border-2 border-transparent hover:border-current">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center space-x-3 pixel-text-secondary hover:bg-gray-100 px-4 py-3 pixel-hover font-bold border-2 border-transparent hover:border-current">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
            
            <li class="mt-8 pt-6" style="border-top: 4px solid var(--pixel-secondary);">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 text-white font-bold px-4 py-3 pixel-hover transition-colors pixel-button" style="background: var(--pixel-error);">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                        <div class="ml-auto pixel-heart pixel-pulse"></div>
                    </button>
                </form>
            </li>
        </ul>
        
        <!-- Decorative Elements -->
        <div class="mt-6 text-center">
            <div class="flex justify-center space-x-2 mb-2">
                <div class="pixel-star pixel-float"></div>
                <div class="pixel-heart pixel-pulse"></div>
                <div class="pixel-star pixel-float" style="animation-delay: 1s;"></div>
            </div>
            <p class="text-xs pixel-text-accent font-bold">Pixel Art Magic</p>
        </div>
    </nav>
</aside>