    @extends('layouts.auth.guest')

    @section('title', 'Login | Artisan Pottery')

    @section('content')
        <section class="pt-32 pb-20">
            <div class="max-w-md mx-auto px-4 sm:px-6">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-8">
                        <div class="text-center mb-8">
                            <h1 class="font-playfair text-3xl font-bold text-gray-800 mb-2">Welcome Back</h1>
                            <p class="text-gray-600">Sign in to continue to your account</p>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <button
                                class="flex items-center justify-center py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fab fa-google text-red-500 mr-2"></i>
                                <span class="text-gray-700 text-sm">Google</span>
                            </button>
                            <button
                                class="flex items-center justify-center py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fab fa-facebook-f text-blue-600 mr-2"></i>
                                <span class="text-gray-700 text-sm">Facebook</span>
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="flex items-center my-6">
                            <div class="flex-grow border-t border-gray-200"></div>
                            <span class="px-4 text-gray-500 text-sm">or sign in with email</span>
                            <div class="flex-grow border-t border-gray-200"></div>
                        </div>

                        <!-- Login Form -->
                        <form action="#" method="POST" class="space-y-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                    Address</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="far fa-envelope text-gray-400"></i>
                                    </span>
                                    <input type="email" id="email" name="email" value="3ezzy@example.com" required
                                        class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500"
                                        placeholder="your@email.com">
                                </div>
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </span>
                                    <input type="password" id="password" name="password" value="••••••••••" required
                                        class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500"
                                        placeholder="••••••••">
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                                        <i class="far fa-eye text-gray-400"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="checkbox" id="remember_me" name="remember_me" checked
                                        class="h-4 w-4 rounded text-amber-600 focus:ring-amber-500">
                                    <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
                                </div>
                                <a href="#" class="text-sm text-amber-600 hover:underline">Forgot password?</a>
                            </div>
                            <div>
                                <button type="submit"
                                    class="w-full bg-amber-600 hover:bg-amber-700 text-white py-3 rounded-lg transition-colors font-medium">
                                    Sign In
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-6">
                            <p class="text-gray-600 text-sm">
                                Don't have an account?
                                <a href="{{ route('register') }}" class="text-amber-600 hover:underline">Create account</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
