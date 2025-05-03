<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Modern Ceramic Art') | Artisan Pottery</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    {{-- <link href="{{ asset('css/output.css') }}" rel="stylesheet"> --}}

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap');

        .font-playfair {
            font-family: 'Playfair Display', serif;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .hover-scale {
            transition: transform 0.3s ease-in-out;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .text-stroke {
            -webkit-text-stroke: 1px #ffffff;
            color: transparent;
        }

        .custom-shape-divider {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .animate-fade-in-right {
            animation: fadeInRight 0.3s ease-out forwards;
        }
    </style>
   
    
</head>

<body class="bg-[#f8f5f2] font-poppins">
    <!-- Modern Floating Navigation -->
    @include('layouts.client.navigation')

    <!-- Success Message -->
    @if (session('success'))
        <div id="success-message"
            class="fixed bottom-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow z-50 flex items-center space-x-2">
            <i class="fas fa-check-circle text-green-700"></i>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <script>
        // Automatically hide the success message after 10 seconds
        setTimeout(() => {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }
        }, 5000); // 10 seconds = 10000 milliseconds
    </script>

    @yield('content')

    <!-- Footer Section -->
    @include('layouts.client.footer')
    <!-- Error Message Display -->
    @if (session('error'))
        <div class="fixed top-4 right-4 z-50 flex items-center gap-4">
            <!-- Error Notification -->
            <div
                class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg flex items-center space-x-2 animate-fade-in-right">
                <!-- Error Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <!-- Error Message -->
                <span>{{ session('error') }}</span>
                <!-- Close Button -->
                <button class="ml-2 focus:outline-none" onclick="this.parentElement.remove()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
    
    <script>
        // Auto-hide the error message after 5 seconds
        setTimeout(() => {
            const errorMessage = document.querySelector('.animate-fade-in-right');
            if (errorMessage) {
                errorMessage.style.animation = 'fadeOut 0.3s ease-out forwards';
                setTimeout(() => {
                    errorMessage.remove();
                }, 300);
            }
        }, 5000);
    </script>
    <!-- ScrollReveal Initialization -->
    <script>
        ScrollReveal().reveal('.hover-scale', {
            delay: 200,
            distance: '20px',
            origin: 'bottom',
            interval: 200
        });
    </script>

    @stack('scripts')
</body>

</html>
