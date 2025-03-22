<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Seller Dashboard') | Artisan Pottery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap');

        .font-playfair {
            font-family: 'Playfair Display', serif;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .hover-scale {
            transition: transform 0.3s ease-in-out;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        /* Responsive Sidebar Styles */
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            #sidebar.active {
                transform: translateX(0);
            }

            .ml-64 {
                margin-left: 0 !important;
            }
        }

        /* Mobile Menu Button Styles */
        .mobile-menu-button {
            display: none;
            transition: opacity 0.3s ease-in-out;
        }

        @media (max-width: 768px) {
            .mobile-menu-button {
                display: block;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 40;
                opacity: 1;
            }

            .mobile-menu-button.hidden {
                opacity: 0;
                pointer-events: none;
            }
        }
    </style>
</head>

<body class="bg-[#f8f5f2] font-poppins">
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-button p-2 bg-white rounded-lg shadow-lg" id="openSidebar">
        <i class="fas fa-bars text-gray-600"></i>
    </button>

    <div class="flex min-h-screen relative">
        <!-- Sidebar -->
        @include('layouts.admin.navigation')

        <!-- Main Content -->
        <main class="flex-1 bg-[#f8f5f2] p-4 transition-all duration-300 ml-0 md:ml-64">
            @yield('content')
        </main>
    </div>

    <!-- Overlay for mobile -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black opacity-50 z-20 hidden md:hidden"></div>
    <!-- Before closing body tag -->
    @if(session('success') || session('error'))
    <div class="fixed bottom-4 right-4 z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg flex items-center">
                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg flex items-center">
                <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif
    </div>
@endif
    @stack('scripts')

    
    <!-- JavaScript for Sidebar Toggle -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const openSidebar = document.getElementById('openSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar(show) {
            if (show) {
                sidebar.classList.add('active');
                sidebarOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                openSidebar.classList.add('hidden'); // Hide the menu button
            } else {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.add('hidden');
                document.body.style.overflow = 'auto';
                openSidebar.classList.remove('hidden'); // Show the menu button
            }
        }

        openSidebar.addEventListener('click', () => toggleSidebar(true));
        closeSidebar.addEventListener('click', () => toggleSidebar(false));
        sidebarOverlay.addEventListener('click', () => toggleSidebar(false));

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                toggleSidebar(false);
            }
        });
    </script>

    <!-- Chart.js Scripts -->
    <script>
        // Only initialize charts if the elements exist
        if (document.getElementById('salesChart')) {
            const salesChartCtx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(salesChartCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Sales',
                        data: [12000, 19000, 3000, 5000, 2000, 3000],
                        borderColor: '#D97706',
                        tension: 0.4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        }

        if (document.getElementById('productsChart')) {
            const productsChartCtx = document.getElementById('productsChart').getContext('2d');
            const productsChart = new Chart(productsChartCtx, {
                type: 'bar',
                data: {
                    labels: ['Vase Set', 'Dinnerware', 'Tea Set', 'Mugs', 'Bowls'],
                    datasets: [{
                        label: 'Sales',
                        data: [120, 190, 30, 50, 20],
                        backgroundColor: '#D97706',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        }
    </script>
</body>

</html>
