@extends('layouts.client.app')

@section('title', 'Contact Us')

@section('content')
  <!-- Page Header -->
  <section class="pt-32 pb-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="font-playfair text-4xl md:text-5xl font-bold text-gray-800 mb-4">Contact Us</h1>
            <nav class="flex justify-center">
                <ol class="flex items-center space-x-2 text-sm text-gray-500">
                    <li><a href="index.html" class="hover:text-amber-600 transition-colors">Home</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-amber-600 font-medium">Contact Us</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- Contact Information Section -->
<section class="bg-[#f8f5f2] py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Address -->
            <div class="bg-white p-8 rounded-2xl shadow-lg text-center hover-scale">
                <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-map-marker-alt text-amber-600 text-2xl"></i>
                </div>
                <h3 class="font-playfair text-xl font-bold text-gray-800 mb-3">Our Location</h3>
                <p class="text-gray-600">
                    123 Pottery Lane<br>
                    Ceramics District<br>
                    San Francisco, CA 94110
                </p>
                <a href="https://goo.gl/maps/123" class="inline-block mt-4 text-amber-600 hover:underline">View on Map</a>
            </div>
            
            <!-- Email -->
            <div class="bg-white p-8 rounded-2xl shadow-lg text-center hover-scale">
                <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-envelope text-amber-600 text-2xl"></i>
                </div>
                <h3 class="font-playfair text-xl font-bold text-gray-800 mb-3">Email Us</h3>
                <p class="text-gray-600">
                    General Inquiries:<br>
                    <a href="mailto:info@artisanpottery.com" class="text-amber-600 hover:underline">info@artisanpottery.com</a>
                </p>
                <p class="text-gray-600 mt-2">
                    Customer Support:<br>
                    <a href="mailto:support@artisanpottery.com" class="text-amber-600 hover:underline">support@artisanpottery.com</a>
                </p>
            </div>
            
            <!-- Phone -->
            <div class="bg-white p-8 rounded-2xl shadow-lg text-center hover-scale">
                <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-phone-alt text-amber-600 text-2xl"></i>
                </div>
                <h3 class="font-playfair text-xl font-bold text-gray-800 mb-3">Call Us</h3>
                <p class="text-gray-600">
                    Phone: <a href="tel:+15551234567" class="text-amber-600 hover:underline">(555) 123-4567</a>
                </p>
                <p class="text-gray-600 mt-2">
                    Business Hours:<br>
                    Mon - Fri: 9AM - 5PM<br>
                    Sat - Sun: 10AM - 4PM
                </p>
            </div>
        </div>
        
        <!-- Contact Form & Map Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white p-8 rounded-2xl shadow-lg">
                <h2 class="font-playfair text-2xl font-bold text-gray-800 mb-6">Send Us a Message</h2>
                
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                            <input 
                                type="text" 
                                id="first_name" 
                                name="first_name"
                                value="{{ old('first_name') }}"
                                required 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-amber-500 @error('first_name') border-red-500 @enderror"
                            >
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                            <input 
                                type="text" 
                                id="last_name" 
                                name="last_name"
                                value="{{ old('last_name') }}"
                                required 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-amber-500 @error('last_name') border-red-500 @enderror"
                            >
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email"
                                value="{{ old('email') }}"
                                required 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-amber-500 @error('email') border-red-500 @enderror"
                            >
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone"
                                value="{{ old('phone') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-amber-500 @error('phone') border-red-500 @enderror"
                            >
                        </div>
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject *</label>
                        <input 
                            type="text" 
                            id="subject" 
                            name="subject"
                            value="{{ old('subject') }}"
                            required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-amber-500 @error('subject') border-red-500 @enderror"
                        >
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message *</label>
                        <textarea 
                            id="message" 
                            name="message" 
                            rows="5" 
                            required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-amber-500 @error('message') border-red-500 @enderror"
                        >{{ old('message') }}</textarea>
                    </div>
                    <div class="flex items-start">
                        <input 
                            type="checkbox" 
                            id="privacy_policy" 
                            name="privacy_policy" 
                            required 
                            class="mt-1 rounded text-amber-600 focus:ring-amber-500 @error('privacy_policy') border-red-500 @enderror"
                        >
                        <label for="privacy_policy" class="ml-2 text-sm text-gray-600">
                            I agree to the <a href="#" class="text-amber-600 hover:underline">Privacy Policy</a> and consent to Artisan Pottery contacting me.
                        </label>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-amber-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-amber-700 transition-colors">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>

            <!-- Map -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.8354345093747!2d-122.4194155846816!3d37.77492997975921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085809c6c8f4459%3A0xb10ed6d9b5050fa5!2s123%20Pottery%20Ln%2C%20San%20Francisco%2C%20CA%2094110%2C%20USA!5e0!3m2!1sen!2sin!4v1633023226784!5m2!1sen!2sin" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy"
                ></iframe>
            </div>
        </div>
    </div>
</section>

@endsection