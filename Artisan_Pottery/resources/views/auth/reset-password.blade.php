@extends('layouts.auth.guest')

@section('content')
<section class="min-h-screen pt-32 pb-12 px-4">
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="text-center mb-8">
                <h1 class="font-playfair text-3xl font-bold text-gray-800 mb-2">Reset Password</h1>
                <p class="text-gray-600">Enter your new password below.</p>
            </div>

            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            <form class="space-y-6" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required
                            class="block w-full pl-10 px-4 py-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-transparent transition-colors"
                            placeholder="your@email.com">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="block w-full pl-10 px-4 py-3 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-transparent transition-colors"
                            placeholder="Enter your new password">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="block w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-transparent transition-colors"
                            placeholder="Confirm your new password">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-amber-600 hover:bg-amber-700 text-white font-medium py-3 px-4 rounded-lg transition-colors hover-scale">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</section>
@endsection 