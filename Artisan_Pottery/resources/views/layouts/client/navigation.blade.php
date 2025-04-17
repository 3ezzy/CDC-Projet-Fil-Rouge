<nav class="fixed w-full z-50 top-0 left-0 px-4 py-3">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white/80 backdrop-blur-md rounded-full shadow-lg px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-2xl font-playfair font-bold text-gray-800">
                    Artisan<span class="text-amber-600">.</span>
                </a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-{{ Request::routeIs('home') ? 'amber' : 'gray' }}-600 hover:text-amber-600 transition-colors">Home</a>
                    <a href="{{ route('shop') }}" class="text-{{ Request::routeIs('shop') ? 'amber' : 'gray' }}-600 hover:text-amber-600 transition-colors">Shop</a>
                    <a href="{{ route('about') }}" class="text-{{ Request::routeIs('about') ? 'amber' : 'gray' }}-600 hover:text-amber-600 transition-colors">About</a>
                    <a href="{{ route('contact') }}" class="text-{{ Request::routeIs('contact') ? 'amber' : 'gray' }}-600 hover:text-amber-600 transition-colors">Contact</a>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <i class="fas fa-search text-gray-600"></i>
                    </button>
                    <a href="#" class="p-2 hover:bg-gray-100 rounded-full transition-colors relative">
                        <i class="fas fa-heart text-gray-600"></i>
                        @if(session()->has('wishlist') && count(session('wishlist')) > 0)
                            <span class="absolute -top-1 -right-1 bg-amber-600 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">
                                {{ count(session('wishlist')) }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('cart.show') }}" class="p-2 hover:bg-gray-100 rounded-full transition-colors relative">
                        <i class="fas fa-shopping-bag text-gray-600"></i>
                        @if(session()->has('cart') && count(session('cart')) > 0)
                            <span id="cart-counter" class="absolute -top-1 -right-1 bg-amber-600 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">
                                {{ array_sum(array_column(session('cart'), 'quantity')) }}
                            </span>
                        @endif
                    </a>
                    <div class="hidden md:flex items-center space-x-2">
                        @auth
                            <div class="relative group">
                                <button class="flex items-center space-x-1 text-gray-600 hover:text-amber-600 transition-colors">
                                    <span>{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible hover:opacity-100 hover:visible transition-all duration-300 ease-in-out">
                                    <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-amber-50">Profile</a>
                                    <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-amber-50">Orders</a>
                                    <form method="POST" action="#">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-600 hover:bg-amber-50">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-amber-600 transition-colors">Login</a>
                            <span class="text-gray-400">|</span>
                            <a href="{{ route('register') }}" class="text-gray-600 hover:text-amber-600 transition-colors">Register</a>
                        @endauth
                    </div>
                    <button class="md:hidden p-2 hover:bg-gray-100 rounded-full transition-colors" id="mobile-menu-button">
                        <i class="fas fa-bars text-gray-600"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Menu -->
<div class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" id="mobile-menu-overlay">
    <div class="bg-white h-full w-64 p-5 transform transition-transform duration-300 -translate-x-full"
        id="mobile-menu">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-xl font-playfair font-bold">Menu</h2>
            <button id="close-mobile-menu">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="flex flex-col space-y-4">
            <a href="{{ route('home') }}" class="py-2 px-4 text-{{ Request::routeIs('home') ? 'amber' : 'gray' }}-600 hover:bg-amber-50 rounded-lg">Home</a>
            <a href="{{ route('shop') }}" class="py-2 px-4 text-{{ Request::routeIs('shop') ? 'amber' : 'gray' }}-600 hover:bg-amber-50 rounded-lg">Shop</a>
            <a href="{{ route('about') }}" class="py-2 px-4 text-{{ Request::routeIs('about') ? 'amber' : 'gray' }}-600 hover:bg-amber-50 rounded-lg">About</a>
            <a href="{{ route('contact') }}" class="py-2 px-4 text-{{ Request::routeIs('contact') ? 'amber' : 'gray' }}-600 hover:bg-amber-50 rounded-lg">Contact</a>
            @auth
                <hr class="my-2">
                <a href="#" class="py-2 px-4 text-gray-600 hover:bg-amber-50 rounded-lg">Profile</a>
                <a href="#" class="py-2 px-4 text-gray-600 hover:bg-amber-50 rounded-lg">Orders</a>
                <form method="POST" action="#">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 px-4 text-gray-600 hover:bg-amber-50 rounded-lg">
                        Logout
                    </button>
                </form>
            @else
                <hr class="my-2">
                <a href="{{ route('login') }}" class="py-2 px-4 text-gray-600 hover:bg-amber-50 rounded-lg">Login</a>
                <a href="{{ route('register') }}" class="py-2 px-4 text-gray-600 hover:bg-amber-50 rounded-lg">Register</a>
            @endauth
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Mobile menu functionality
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const closeMobileMenu = document.getElementById('close-mobile-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

    function openMobileMenu() {
        mobileMenuOverlay.classList.remove('hidden');
        setTimeout(() => {
            mobileMenu.classList.remove('-translate-x-full');
        }, 10);
    }

    function closeMobileMenuHandler() {
        mobileMenu.classList.add('-translate-x-full');
        setTimeout(() => {
            mobileMenuOverlay.classList.add('hidden');
        }, 300);
    }

    mobileMenuButton.addEventListener('click', openMobileMenu);
    closeMobileMenu.addEventListener('click', closeMobileMenuHandler);
    mobileMenuOverlay.addEventListener('click', (e) => {
        if (e.target === mobileMenuOverlay) {
            closeMobileMenuHandler();
        }
    });
</script>
@endpush