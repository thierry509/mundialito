<!-- Navbar -->
<nav id="navbar" class="fixed w-full z-50 py-4 px-6 md:px-12 h-20 transition-all duration-300 bg-transparent">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}">
            <div class="flex items-center">
                <span class="text-2xl font-bold text-white transition-colors duration-300 navbar-logo">Mundialito</span>
            </div>
        </a>

        <!-- Menu pour desktop -->
        <div id="menu" class="hidden lg:flex space-x-8 items-center">
            <a href="{{ route('home') }}"
                class="text-white hover:text-secondary font-medium transition-colors duration-200 navbar-link">Accueil</a>
            <a href="{{ route('games') }}"
                class="text-white hover:text-secondary font-medium transition-colors duration-200 navbar-link">Matchs</a>
            <a href="{{ route('groups') }}"
                class="text-white hover:text-secondary font-medium transition-colors duration-200 navbar-link">Classement</a>
            <a href="{{ route('knockout') }}"
                class="text-white hover:text-secondary font-medium transition-colors duration-200 navbar-link">Elimination</a>
            <a href="{{ route('about') }}"
                class="text-white hover:text-secondary font-medium transition-colors duration-200 navbar-link">À
                propos</a>
            <a href="{{ route('news') }}"
                class="text-white hover:text-secondary font-medium transition-colors duration-200 navbar-link">Actualités</a>
        </div>
        <div class="flex">
            <a href="{{ route('dashboard') }}"
                class="justify-center flex items-center px-4 py-3 mx-2 my-1 text-primary transition rounded-2xl shadow-sm hover:bg-primary/10 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                <svg class="w-5 h-5 md:mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span class="hidden md:block font-semibold">Éditions</span>
            </a>


            <!-- Menu mobile button -->
            <button id="mobile-menu-button"
                class="lg:hidden text-white focus:outline-none transition-colors duration-300 navbar-button">
                <svg class="w-8 h-8 transition-colors duration-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Menu mobile amélioré -->
    <div id="mobile-menu" class="fixed inset-0 z-40 hidden transition-all duration-300 transform translate-x-full">
        <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm" id="mobile-menu-overlay"></div>
        <div class="absolute right-0 top-0 h-full w-4/5 max-w-md bg-white shadow-xl flex flex-col">
            <!-- En-tête du menu mobile -->
            <div class="flex justify-between items-center p-4 border-b">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-primary">Mundialito</a>
                <button id="mobile-menu-close" class="text-gray-500 hover:text-primary focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Contenu du menu mobile -->
            <div class="flex-1 overflow-y-auto p-4">
                <nav class="space-y-2">
                    <a href="{{ route('home') }}"
                        class="block px-4 py-3 rounded-lg hover:bg-primary/10 text-gray-800 hover:text-primary font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Accueil
                    </a>
                    <a href="{{ route('games') }}"
                        class="block px-4 py-3 rounded-lg hover:bg-primary/10 text-gray-800 hover:text-primary font-medium transition-colors duration-200 flex items-center">

                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Matchs
                    </a>
                    <a href="{{ route('groups') }}"
                        class="block px-4 py-3 rounded-lg hover:bg-primary/10 text-gray-800 hover:text-primary font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                        Classement
                    </a>
                    <a href="{{ route('knockout') }}"
                        class="block px-4 py-3 rounded-lg hover:bg-primary/10 text-gray-800 hover:text-primary font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 21h8m-4-4v4m0-4c-5.523 0-10-4.477-10-10V5a2 2 0 012-2h2.5a2 2 0 012 2h5a2 2 0 012-2H20a2 2 0 012 2v2c0 5.523-4.477 10-10 10z" />
                        </svg>
                        Elimination
                    </a>
                    <a href="{{ route('about') }}"
                        class="block px-4 py-3 rounded-lg hover:bg-primary/10 text-gray-800 hover:text-primary font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        À propos
                    </a>
                    <a href="{{ route('news') }}"
                        class="block px-4 py-3 rounded-lg hover:bg-primary/10 text-gray-800 hover:text-primary font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                        Actualités
                    </a>

                </nav>
            </div>
        </div>
    </div>
</nav>

<script defer>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    const navbar = document.getElementById('navbar');

    // Gestion de l'ouverture/fermeture du menu mobile
    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
        setTimeout(() => {
            mobileMenu.classList.remove('translate-x-full');
        }, 10);
        document.body.style.overflow = 'hidden';
    });

    function closeMobileMenu() {
        mobileMenu.classList.add('translate-x-full');
        setTimeout(() => {
            mobileMenu.classList.add('hidden');
        }, 300);
        document.body.style.overflow = 'auto';
    }

    mobileMenuClose.addEventListener('click', closeMobileMenu);
    mobileMenuOverlay.addEventListener('click', closeMobileMenu);

    // Gestion du scroll pour la navbar
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('bg-white', 'shadow-md');
            navbar.classList.remove('bg-transparent');
            document.querySelectorAll('.navbar-link').forEach(link => {
                link.classList.remove('text-white');
                link.classList.add('text-primary');
            });
            document.querySelector('.navbar-logo').classList.remove('text-white');
            document.querySelector('.navbar-logo').classList.add('text-primary');
            document.querySelector('.navbar-button').classList.add('text-primary');
            document.querySelector('.navbar-button').classList.remove('text-white');
        } else {
            navbar.classList.remove('bg-white', 'shadow-md');
            navbar.classList.add('bg-transparent');
            document.querySelectorAll('.navbar-link').forEach(link => {
                link.classList.add('text-white');
                link.classList.remove('text-primary');
            });
            document.querySelector('.navbar-logo').classList.add('text-white');
            document.querySelector('.navbar-logo').classList.remove('text-primary');
            document.querySelector('.navbar-button').classList.remove('text-primary');
            document.querySelector('.navbar-button').classList.add('text-white');
        }
    });
</script>
