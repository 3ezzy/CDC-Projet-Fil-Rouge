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
    <link href="path/to/output.css" rel="stylesheet">

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
    </style>
</head>

<body class="bg-[#f8f5f2] font-poppins">
    <!-- Modern Floating Navigation -->
    @include('layouts.client.navigation')

    @yield('content')

    <!-- Footer Section -->
    @include('layouts.client.footer')

   

    <!-- ScrollReveal Initialization -->
    <script>
        ScrollReveal().reveal('.hover-scale', {
            delay: 200,
            distance: '20px',
            origin: 'bottom',
            interval: 200
        });
    </script>
</body>

</html>
