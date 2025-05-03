<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mondialito - Championnat Vacance d'Été</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#27AE60',
                        secondary: '#F4D03F',
                        accent: '#3498DB',
                        danger: '#E74C3C',
                        light: '#ECF0F1',
                    }
                }
            }
        }
    </script>
    <style>
        .navbar-transparent {
            background-color: transparent !important;
            transition: all 0.3s ease;
        }

        .navbar-solid {
            background-color: white !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="font-sans">
    <!-- Navbar -->
    <nav id="navbar" class="navbar-transparent fixed w-full z-50 py-4 px-6 md:px-12 h-16">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('home') }}">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-primary">Mondialito</span>
                    {{-- <span class="ml-2 text-sm hidden md:block text-white bg-primary px-2 py-1 rounded">Gonaïves</span> --}}
                </div>
            </a>
            <!-- Menu pour desktop -->
            <div id="menu" class="text-white hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="hover:text-secondary font-medium transition">Accueil</a>
                <a href="{{ route('results') }}" class="hover:text-secondary font-medium transition">Résultats</a>
                <a href="{{ route('about') }}" class="hover:text-secondary font-medium transition">À propos</a>
                <a href="{{ route('news') }}" class="hover:text-secondary font-medium transition">Actualités</a>
                <a href="{{ route('calendar') }}" class="hover:text-secondary font-medium transition">Calendrier</a>
            </div>

            <!-- Menu mobile button -->
            <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden mt-8 pb-4 bg-white rounded shadow-md">
            <div class="">
                <a href="{{ route('home') }}"
                    class="block text-primary hover:bg-primary hover:text-white px-3 py-2 rounded transition">Accueil</a>
                <a href="{{ route('results') }}"
                    class="block text-primary hover:bg-primary hover:text-white px-3 py-2 rounded transition">Résultats</a>
                <a href="{{ route('about') }}"
                    class="block text-primary hover:bg-primary hover:text-white px-3 py-2 rounded transition">À
                    propos</a>
                <a href="{{ route('news') }}"
                    class="block text-primary hover:bg-primary hover:text-white px-3 py-2 rounded transition">Actualités</a>
                <a href="{{ route('calendar') }}"
                    class="block text-primary hover:bg-primary hover:text-white px-3 py-2 rounded transition">Calendrier</a>
            </div>
        </div>

    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-primary text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <h3 class="text-2xl font-bold mb-4">Mondialito Gonaïves</h3>
                    <p class="text-light">
                        Le championnat de football estival le plus passionnant de la région.
                        Rejoignez-nous pour célébrer le sport, la jeunesse et la communauté.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Navigation</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}"
                                class="text-light hover:text-secondary transition">Accueil</a></li>
                        <li><a href="{{ route('results') }}"
                                class="text-light hover:text-secondary transition">Résultats</a></li>
                        <li><a href="{{ route('about') }}" class="text-light hover:text-secondary transition">À
                                propos</a></li>
                        <li><a href="{{ route('news') }}"
                                class="text-light hover:text-secondary transition">Actualités</a></li>
                        <li><a href="#" class="text-light hover:text-secondary transition">Calendrier</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center text-light">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            +509 00 00 0000
                        </li>
                        <li class="flex items-center text-light">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            contact@mondialitogonaives.com
                        </li>
                        <li class="flex items-center text-light">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Gonaïves, Haïti
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-light border-opacity-20 mt-8 pt-8 text-center text-light">
                <p>&copy; 2023 Mondialito Gonaïves. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const navbar = document.getElementById('navbar');
        const desktopLinks = document.querySelectorAll('#menu a');
        const mobileLinks = document.querySelectorAll('#mobile-menu a');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.remove('navbar-transparent');
                navbar.classList.add('navbar-solid');

                // Modifier la couleur des liens desktop
                desktopLinks.forEach(link => {
                    link.classList.remove('text-white');
                    link.classList.add('text-primary');
                });

                mobileMenuButton.classList.remove('text-white');
                mobileMenuButton.classList.add('text-primary');
            } else {
                navbar.classList.add('navbar-transparent');
                navbar.classList.remove('navbar-solid');

                // Revenir à la couleur blanche pour les liens desktop
                desktopLinks.forEach(link => {
                    link.classList.add('text-white');
                    link.classList.remove('text-primary');
                });


                mobileMenuButton.classList.add('text-white');
                mobileMenuButton.classList.remove('text-primary');
            }
        });
    </script>

</body>

</html>
