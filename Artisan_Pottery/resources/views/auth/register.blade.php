@extends('layouts.auth.guest')

@section('title', 'Register | Artisan Pottery')

@section('content')
<section class="pt-32 pb-20">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-8">
                <div class="text-center mb-8">
                    <h1 class="font-playfair text-3xl font-bold text-gray-800 mb-2">Create Your Account</h1>
                    <p class="text-gray-600">Join our community of pottery enthusiasts</p>
                </div>

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="mb-4">
                        <div class="font-medium text-red-600">Whoops! Something went wrong.</div>
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Registration Form -->
                <form action="{{ route('register') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name*</label>
                            <input 
                                type="text" 
                                id="first_name" 
                                name="first_name" 
                                value="{{ old('first_name') }}" 
                                required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500 @error('first_name') border-red-500 @enderror"
                                placeholder="Enter your first name"
                            >
                            @error('first_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name*</label>
                            <input 
                                type="text" 
                                id="last_name" 
                                name="last_name" 
                                value="{{ old('last_name') }}" 
                                required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500 @error('last_name') border-red-500 @enderror"
                                placeholder="Enter your last name"
                            >
                            @error('last_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
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
                                value="{{ old('email') }}" 
                                required 
                                class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500 @error('email') border-red-500 @enderror"
                                placeholder="your@email.com"
                            >
                        </div>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
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
                                class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500 @error('password') border-red-500 @enderror"
                                placeholder="Create a password"
                            >
                            <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                                <i class="far fa-eye text-gray-400"></i>
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Password must be at least 8 characters long with a number and special character</p>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password*</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-lock text-gray-400"></i>
                            </span>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                required 
                                class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500 @error('password_confirmation') border-red-500 @enderror"
                                placeholder="Confirm your password"
                            >
                        </div>
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        @if ($errors->has('password'))
                            <span class="text-red-500 text-sm">{{ $errors->first('password') }}</span>
                        @endif
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
                                value="{{ old('phone') }}"
                                class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:border-amber-500 @error('phone') border-red-500 @enderror"
                                placeholder="Your phone number"
                            >
                        </div>
                        @error('phone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-start">
                        <input 
                            type="checkbox" 
                            id="terms" 
                            name="terms" 
                            required 
                            class="mt-1 h-4 w-4 rounded text-amber-600 focus:ring-amber-500 @error('terms') border-red-500 @enderror"
                        >
                        <label for="terms" class="ml-2 text-sm text-gray-600">
                            I agree to the <a href="#" class="text-amber-600 hover:underline">Terms of Service</a> and <a href="#" class="text-amber-600 hover:underline">Privacy Policy</a>
                        </label>
                        @error('terms')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
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