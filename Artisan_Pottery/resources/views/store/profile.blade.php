@extends('layouts.client.app')

@section('title', 'My Profile')

@section('content')
    <!-- Profile Section -->
    <section class="pt-32 pb-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-['Playfair_Display'] font-bold text-gray-800 mb-3">My Profile</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">Manage your account information</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-8">
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <!-- Personal Information -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4 pb-2 border-b border-gray-200">Personal Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                <input type="text" name="first_name" id="first_name" value="{{ Auth::user()->first_name }}" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                @error('first_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                <input type="text" name="last_name" id="last_name" value="{{ Auth::user()->last_name }}" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                @error('last_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="text" name="phone" id="phone" value="{{ Auth::user()->phone ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Password Change -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4 pb-2 border-b border-gray-200">Change Password</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div></div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Leave password fields empty if you don't want to change it.</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full md:w-auto px-8 py-3 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-full transition-colors">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection 