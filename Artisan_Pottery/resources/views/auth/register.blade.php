    @extends('layouts.auth.guest')

    @section('title', 'register | Artisan Pottery')

    @section('content')
    <section class="pt-32 pb-20">
        <div class="max-w-2xl mx-auto px-4 sm:px-6">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <h1 class="font-playfair text-3xl font-bold text-gray-800 mb-2">Create Your Account</h1>
                        <p class="text-gray-600">Join our community of pottery enthusiasts</p>
                    </div>
                    
                    <!-- Social Login Buttons -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <button class="flex items-center justify-center py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fab fa-google text-red-500 mr-2"></i>
                            <span class="text-gray-700 text-sm">Continue with Google</span>
                        </button>
                        <button class="flex items-center justify-center py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fab fa-facebook-f text-blue-600 mr-2"></i>
                            <span class="text-gray-700 text-sm">Continue with Facebook</span>
                        </button>
                    </div>
                    
                    <!-- Divider -->
                    <div class="flex items-center my-6">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="px-4 text-gray-500 text-sm">or register with email</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>
                    
                    <!-- Registration Form -->
                    <form action="#" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name*</label>
                                <input 
                                    type="text" 
                                    id="first_name" 
                                    name="first_name" 
                                    required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500"
                                    placeholder="Enter your first name"
                                >
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name*</label>
                                <input 
                                    type="text" 
                                    id="last_name" 
                                    name="last_name" 
                                    required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500"
                                    placeholder="Enter your last name"
                                >
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address*</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="far fa-envelope text-gray-400"></i>
                                </span>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    required 
                                    class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500"
                                    placeholder="your@email.com"
                                >
                            </div>
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password*</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </span>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    required 
                                    class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500"
                                    placeholder="Create a password"
                                >
                                <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                                    <i class="far fa-eye text-gray-400"></i>
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Password must be at least 8 characters long with a number and special character</p>
                        </div>
                        
                        <div>
                            <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password*</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </span>
                                <input 
                                    type="password" 
                                    id="confirm_password" 
                                    name="confirm_password" 
                                    required 
                                    class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500"
                                    placeholder="Confirm your password"
                                >
                            </div>
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number (optional)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="fas fa-phone-alt text-gray-400"></i>
                                </span>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone" 
                                    class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500"
                                    placeholder="Your phone number"
                                >
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <input 
                                type="checkbox" 
                                id="terms" 
                                name="terms" 
                                required 
                                class="mt-1 h-4 w-4 rounded text-amber-600 focus:ring-amber-500"
                            >
                            <label for="terms" class="ml-2 text-sm text-gray-600">
                                I agree to the <a href="#" class="text-amber-600 hover:underline">Terms of Service</a> and <a href="#" class="text-amber-600 hover:underline">Privacy Policy</a>
                            </label>
                        </div>
                        
                        <div class="flex items-start">
                            <input 
                                type="checkbox" 
                                id="newsletter" 
                                name="newsletter" 
                                class="mt-1 h-4 w-4 rounded text-amber-600 focus:ring-amber-500"
                            >
                            <label for="newsletter" class="ml-2 text-sm text-gray-600">
                                Subscribe to our newsletter to receive updates on new products and special offers
                            </label>
                        </div>
                        
                        <div>
                            <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white py-3 rounded-lg transition-colors font-medium">
                                Create Account
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-6">
                        <p class="text-gray-600 text-sm">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-amber-600 hover:underline">Sign in</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
