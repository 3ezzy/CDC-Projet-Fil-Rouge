@extends('layouts.auth.guest')

@section('title', 'Login | Artisan Pottery')

@section('content')
<section class="pt-32 pb-20">
    <div class="max-w-lg mx-auto px-4 sm:px-6">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-8">
                <div class="text-center mb-8">
                    <h1 class="font-playfair text-3xl font-bold text-gray-800 mb-2">Sign in to Your Account</h1>
                    <p class="text-gray-600">Access your pottery collection and orders</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

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

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500"
                            placeholder="your@email.com"
                        >
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500"
                            placeholder="Enter your password"
                        >
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
                        <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white py-3 rounded-lg transition-colors font-medium">
                            Sign In
                        </button>
                    </div>
                </form>

                <div class="text-center mt-6">
                    <p class="text-gray-600 text-sm">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-amber-600 hover:underline">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
