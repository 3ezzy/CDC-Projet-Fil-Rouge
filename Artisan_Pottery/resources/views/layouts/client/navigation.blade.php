<nav class="fixed w-full z-50 top-0 left-0 px-4 py-3">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white/80 backdrop-blur-md rounded-full shadow-lg px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="text-2xl font-playfair font-bold text-gray-800">
                    Artisan<span class="text-amber-600">.</span>
                </a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.html" class="text-amber-600 hover:text-amber-600 transition-colors">Home</a>
                    <a href="product.html" class="text-gray-600 hover:text-amber-600 transition-colors">Shop</a>
                    <a href="about.html" class="text-gray-600 hover:text-amber-600 transition-colors">About</a>
                    <a href="contact.html" class="text-gray-600 hover:text-amber-600 transition-colors">Contact</a>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <i class="fas fa-search text-gray-600"></i>
                    </button>
                    <a href="wishlist.html" class="p-2 hover:bg-gray-100 rounded-full transition-colors relative">
                        <i class="fas fa-heart text-gray-600"></i>
                        <span class="absolute -top-1 -right-1 bg-amber-600 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
                    </a>
                    <a href="cart.html" class="p-2 hover:bg-gray-100 rounded-full transition-colors relative">
                        <i class="fas fa-shopping-bag text-gray-600"></i>
                        <span class="absolute -top-1 -right-1 bg-amber-600 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">2</span>
                    </a>
                    <div class="hidden md:flex items-center space-x-2">
                        <a href="login.html" class="text-gray-600 hover:text-amber-600 transition-colors">Login</a>
                        <span class="text-gray-400">|</span>
                        <a href="register.html" class="text-gray-600 hover:text-amber-600 transition-colors">Register</a>
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
            <a href="index.html" class="py-2 px-4 text-amber-600 hover:bg-amber-50 rounded-lg">Home</a>
            <a href="product.html" class="py-2 px-4 text-gray-600 hover:bg-amber-50 rounded-lg">Shop</a>
            <a href="about.html" class="py-2 px-4 text-gray-600 hover:bg-amber-50 rounded-lg">About</a>
            <a href="contact.html" class="py-2 px-4 text-gray-600 hover:bg-amber-50 rounded-lg">Contact</a>
        </div>
    </div>
</div>
