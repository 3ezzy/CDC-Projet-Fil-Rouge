<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pixel Pottery Dashboard') | Artisan Pottery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap');

        .font-playfair {
            font-family: 'Playfair Display', serif;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        /* Enhanced hover effects for pixel art */
        .hover-scale {
            transition: transform 0.2s ease-in-out;
            image-rendering: -moz-crisp-edges;
            image-rendering: -webkit-crisp-edges;
            image-rendering: pixelated;
            image-rendering: crisp-edges;
        }

        .hover-scale:hover {
            transform: scale(1.02) translate(-1px, -1px);
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        /* Pixel Art Body Styling */
        body {
            background: linear-gradient(
                135deg,
                var(--pixel-neutral-light) 0%,
                var(--pixel-neutral) 50%,
                var(--pixel-neutral-dark) 100%
            );
            background-attachment: fixed;
        }

        /* Responsive Sidebar Styles with Pixel Art */
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                border-right: 4px solid var(--pixel-secondary);
            }

            #sidebar.active {
                transform: translateX(0);
                box-shadow: 6px 0 20px rgba(0, 0, 0, 0.3);
            }

            .ml-64 {
                margin-left: 0 !important;
            }
        }

        /* Mobile Menu Button Styles with Pixel Art */
        .mobile-menu-button {
            display: none;
            transition: all 0.3s ease-in-out;
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

        /* Custom scrollbar with pixel art styling */
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: var(--pixel-neutral);
            border: 2px solid var(--pixel-secondary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--pixel-primary);
            border: 2px solid var(--pixel-secondary);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--pixel-primary-dark);
        }
    </style>
</head>

<body class="pixel-bg-diagonal font-poppins">
    <!-- Mobile Menu Button with Pixel Art Styling -->
    <button class="mobile-menu-button pixel-button p-2" id="openSidebar">
        <i class="fas fa-bars pixel-text-secondary"></i>
    </button>

    <div class="flex min-h-screen relative">
        <!-- Sidebar -->
        @include('layouts.admin.navigation')

        <!-- Main Content -->
        <main class="flex-1 pixel-bg-dots p-4 transition-all duration-300 ml-0 md:ml-64">
            @yield('content')
        </main>
    </div>

    <!-- Overlay for mobile with pixel art styling -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black opacity-50 z-20 hidden md:hidden"></div>
    
    <!-- Pixel Art Notifications -->
    @if(session('success') || session('error'))
    <div class="fixed bottom-4 right-4 z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        @if(session('success'))
            <div class="pixel-notification pixel-panel p-4 text-white font-bold pixel-shake" style="background: var(--pixel-success);">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="pixel-notification pixel-panel p-4 text-white font-bold pixel-shake" style="background: var(--pixel-error);">
                <i class="fas fa-exclamation-triangle mr-2"></i>
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

    <!-- Chart.js Scripts with Pixel Art Colors -->
    <script>
        // Pixel Art Color Palette
        const pixelColors = {
            primary: '#FE7743',
            secondary: '#273F4F',
            accent: '#447D9B',
            neutral: '#D7D7D7',
            success: '#4AE54A',
            warning: '#FFD700',
            error: '#FF4444'
        };

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
                        borderColor: pixelColors.primary,
                        backgroundColor: pixelColors.primary + '33',
                        borderWidth: 3,
                        tension: 0,
                        pointBackgroundColor: pixelColors.secondary,
                        pointBorderColor: pixelColors.primary,
                        pointBorderWidth: 3,
                        pointRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: pixelColors.secondary,
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: pixelColors.neutral,
                                lineWidth: 2
                            },
                            ticks: {
                                color: pixelColors.secondary,
                                font: {
                                    weight: 'bold'
                                }
                            }
                        },
                        y: {
                            grid: {
                                color: pixelColors.neutral,
                                lineWidth: 2
                            },
                            ticks: {
                                color: pixelColors.secondary,
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    }
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
                        backgroundColor: [
                            pixelColors.primary,
                            pixelColors.accent,
                            pixelColors.warning,
                            pixelColors.success,
                            pixelColors.error
                        ],
                        borderColor: pixelColors.secondary,
                        borderWidth: 3,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: pixelColors.secondary,
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: pixelColors.neutral,
                                lineWidth: 2
                            },
                            ticks: {
                                color: pixelColors.secondary,
                                font: {
                                    weight: 'bold'
                                }
                            }
                        },
                        y: {
                            grid: {
                                color: pixelColors.neutral,
                                lineWidth: 2
                            },
                            ticks: {
                                color: pixelColors.secondary,
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>
</body>

</html>
