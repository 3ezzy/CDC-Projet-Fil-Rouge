@extends('layouts.client.app')

@section('title', 'About Us')

@section('content')
<!-- Page Header -->
<section class="pt-32 pb-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="font-playfair text-4xl md:text-5xl font-bold text-gray-800 mb-4">Our Story</h1>
            <nav class="flex justify-center">
                <ol class="flex items-center space-x-2 text-sm text-gray-500">
                    <li><a href="{{ route('home') }}" class="hover:text-amber-600 transition-colors">Home</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-amber-600 font-medium">About Us</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- Our Mission Section -->
<section class="bg-[#f8f5f2] py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <div class="aspect-square rounded-full bg-amber-100 absolute -top-10 -left-10 w-64 h-64 z-0"></div>
                <img src="https://images.unsplash.com/photo-1597696929736-6d13bed8e6a8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Artisan at work" class="relative z-10 rounded-2xl shadow-2xl" />
            </div>
            <div>
                <h4 class="uppercase tracking-widest text-amber-600 mb-4">Our Mission</h4>
                <h2 class="font-playfair text-3xl md:text-4xl font-bold text-gray-800 mb-6">Crafting Beauty with
                    Purpose</h2>
                <p class="text-gray-600 mb-6">
                    At Artisan Pottery, our mission is to bring the ancient art of ceramics into modern homes. We
                    believe in the power of handcrafted items to bring warmth, character, and a touch of human
                    connection to everyday living.
                </p>
                <p class="text-gray-600 mb-8">
                    Each piece that leaves our studio is thoughtfully designed and carefully created by our skilled
                    artisans, combining traditional techniques with contemporary aesthetics to create pottery that's
                    both beautiful and functional.
                </p>
                <div class="flex flex-wrap gap-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-handshake text-amber-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Artisan Made</h4>
                            <p class="text-gray-600 text-sm">Handcrafted with care</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-leaf text-amber-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Sustainable</h4>
                            <p class="text-gray-600 text-sm">Eco-friendly materials</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Story Timeline -->
<section class="bg-white py-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h4 class="uppercase tracking-widest text-amber-600 mb-2">Our Journey</h4>
            <h2 class="font-playfair text-3xl md:text-4xl font-bold text-gray-800 mb-6">The Artisan Story</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Our journey from a small studio to a global brand has been shaped by passion, craftsmanship, and a
                dedication to preserving the art of pottery.
            </p>
        </div>

        <div class="space-y-16">
            <!-- Timeline Item 1 -->

            <!-- Timeline Item 2 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                <div class="text-center md:text-right">
                    <h3 class="font-playfair text-2xl font-bold text-gray-800 mb-2">2024</h3>
                    <h4 class="font-medium text-amber-600">Growing Community</h4>
                </div>
                <div class="relative flex justify-center">
                    <div class="h-full w-0.5 bg-amber-200 absolute"></div>
                    <div
                        class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center z-10 timeline-dot">
                        <div class="w-8 h-8 bg-amber-600 rounded-full"></div>
                    </div>
                </div>
                <div>
                    <p class="text-gray-600">
                        We opened our first workshop and store, bringing together a team of five talented artisans
                        and beginning to offer pottery classes to the community.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 3 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                <div class="text-center md:text-right">
                    <h3 class="font-playfair text-2xl font-bold text-gray-800 mb-2">2025</h3>
                    <h4 class="font-medium text-amber-600">Going Digital</h4>
                </div>
                <div class="relative flex justify-center">
                    <div class="h-full w-0.5 bg-amber-200 absolute"></div>
                    <div
                        class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center z-10 timeline-dot">
                        <div class="w-8 h-8 bg-amber-600 rounded-full"></div>
                    </div>
                </div>
                <div>
                    <p class="text-gray-600">
                        We launched our online store and began shipping our handcrafted pottery worldwide,
                        connecting with pottery enthusiasts across the globe and expanding our reach.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 5 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                <div class="text-center md:text-right">
                    <h3 class="font-playfair text-2xl font-bold text-gray-800 mb-2">2026</h3>
                    <h4 class="font-medium text-amber-600">Today & Beyond</h4>
                </div>
                <div class="relative flex justify-center">
                    <div
                        class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center z-10 timeline-dot">
                        <div class="w-8 h-8 bg-amber-600 rounded-full"></div>
                    </div>
                </div>
                <div>
                    <p class="text-gray-600">
                        Today, Artisan Pottery is a community of over 30 artisans dedicated to creating beautiful,
                        functional pottery while educating and inspiring the next generation of ceramic artists.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>






@endsection