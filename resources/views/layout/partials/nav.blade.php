<!-- Navbar -->
<nav id="navbar" class="fixed w-full z-50 py-4 px-6 md:px-12 h-20 transition-all duration-300 bg-transparent">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="logo mundialito">
                <span
                    class=" ml-2 text-2xl font-bold text-white transition-colors duration-300 navbar-logo">Mundialito</span>
            </div>
        </a>

        <!-- Menu pour desktop -->
        <div id="menu" class="hidden lg:flex space-x-8 items-center">
            <a href="{{ route('home') }}"
                class="text-white hover:text-secondary font-medium transition-colors duration-200 navbar-link">Accueil</a>
            <a href="{{ route('games') }}"
                class="needsYear text-white hover:text-secondary font-medium transition-colors duration-200 navbar-link">Matchs</a>
            <a href="{{ route('groups') }}"
                class="needsYear text-white hover:text-secondary font-medium transition-colors duration-200 navbar-link">Classement</a>
            <a href="{{ route('knockout') }}"
                class="needsYear text-white hover:text-secondary font-medium transition-colors duration-200 navbar-link">Elimination</a>
            <a href="{{ route('about') }}"
                class="text-white hover:text-secondary font-medium transition-colors duration-200 navbar-link">À
                propos</a>
            <a href="{{ route('news') }}"
                class="text-white hover:text-secondary font-medium transition-colors duration-200 navbar-link">Actualités</a>
            <a href="{{ route('prize-list') }}"
                class="text-white hover:text-secondary font-medium transition-colors duration-200 navbar-link">Palmares</a>
        </div>
        <div class="flex">
            @auth
                <div x-data="{ open: false }" class="relative">
                    <!-- Bouton profil avec animation -->
                    <button @click="open = !open"
                        class="flex items-center gap-2 focus:outline-none group">
                        <div class="relative">
                            <!-- Image de profil avec bordure animée -->
                            <div
                                class="h-10 w-10 rounded-full p-0.5 bg-gradient-to-tr from-blue-500 to-purple-600 group-hover:from-blue-400 group-hover:to-purple-500 transition-all duration-300">

                                <div
                                    class="h-full w-full rounded-full overflow-hidden bg-white flex items-center justify-center">
                                    @if (auth()->user()->avatar)
                                        <img src="{{ auth()->user()->avatar }}" alt="Photo de profil"
                                            class="h-full w-full object-cover" />
                                    @else
                                        <div
                                            class="h-full w-full flex items-center justify-center
                                                    text-sm font-semibold uppercase text-white
                                                    bg-gradient-to-r from-indigo-500 to-pink-500">
                                            {{ mb_substr(auth()->user()->first_name, 0, 2, 'UTF-8') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Badge online -->
                            <span
                                class="absolute bottom-0 right-0 h-3 w-3 rounded-full bg-green-500 ring-2 ring-white"></span>
                        </div>


                        <!-- Icône chevron animée -->
                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-300" :class="{ 'rotate-180': open }"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Menu dropdown moderne -->
                    <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-200" x-cloak
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute right-0 z-20 mt-3 w-64 rounded-xl shadow-xl bg-white/90 backdrop-blur-sm border border-gray-100 overflow-hidden">
                        <!-- En-tête avec infos utilisateur -->
                        <div class="px-4 py-3 bg-gradient-to-r from-blue-50 to-purple-50">
                            <p class="text-sm font-semibold text-gray-900 capitalize">{{ auth()->user()->first_name }}
                                <span class="capitalize">{{ auth()->user()->last_name }}</span>
                            </p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }} </p>
                        </div>

                        <div class="py-1">
                            <!-- Item avec icône -->
                            <a href="{{ route('blade.profile') }}"
                                class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Mon profil
                            </a>
                            @if (auth()->user()->isAdmin())
                                <!-- Nouveau lien Mode Édition -->
                                <a href="{{ route('dashboard') }}"
                                    class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Mode Édition
                                </a>
                            @endif

                            <!-- Item avec icône -->
                            <a href="#"
                                class="hidden flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Paramètres
                            </a>

                            <!-- Séparateur -->
                            <div class="border-t border-gray-100 my-1"></div>

                            <!-- Item avec icône -->
                            <div href="#"
                                class="flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-3 text-red-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="g_id_signout"> Déconnexion </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth
            @guest
                <div x-data="{ isOpen: false }" class="relative">
                    <!-- Bouton pour utilisateur non connecté -->
                    <button @click="isOpen = !isOpen"
                        class="flex items-center justify-center h-10 w-10 rounded-full p-0.5 bg-gradient-to-tr from-gray-300 to-gray-400 hover:from-gray-200 hover:to-gray-300 transition-all duration-300 focus:outline-none">
                        <!-- Icône utilisateur -->
                        <div class="h-full w-full rounded-full bg-white text-gray-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </button>

                    <!-- Dropdown menu - Structure de base -->
                    <div x-show="isOpen" @click.outside="isOpen = false" x-transition:enter="transition ease-out duration-200" x-cloak
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute right-0 z-20 mt-3 w-64 rounded-xl shadow-xl bg-white/90 backdrop-blur-sm border border-gray-100 overflow-hidden">
                        <div class="px-4 py-3 bg-gradient-to-r from-blue-50 to-purple-50">
                            <p class="text-sm font-semibold text-gray-900">Invité</p>
                            <p class="text-xs text-gray-500">Non connecté</p>
                        </div>

                        <div class="py-1">
                            <a href="{{ route('login') }}" @click="isOpen = false"
                                class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Se connecter
                            </a>

                            <a href="{{ route('register') }}" @click="isOpen = false"
                                class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                Créer un compte
                            </a>
                        </div>
                    </div>
                </div>
            @endguest
            <!-- Menu mobile button -->
            <button id="mobile-menu-button" aria-label="Ouvrir le menu mobile"
                class="lg:hidden text-white focus:outline-none transition-colors duration-300 navbar-button ml-4">
                <svg class="w-8 h-8 transition-colors duration-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12">
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
                        class="needsYear block px-4 py-3 rounded-lg hover:bg-primary/10 text-gray-800 hover:text-primary font-medium transition-colors duration-200 flex items-center">

                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Matchs
                    </a>
                    <a href="{{ route('groups') }}"
                        class="needsYear block px-4 py-3 rounded-lg hover:bg-primary/10 text-gray-800 hover:text-primary font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                        Classement
                    </a>
                    <a href="{{ route('knockout') }}"
                        class="needsYear block px-4 py-3 rounded-lg hover:bg-primary/10 text-gray-800 hover:text-primary font-medium transition-colors duration-200 flex items-center">
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
                    <a href="{{ route('prize-list') }}"
                        class="block px-4 py-3 rounded-lg hover:bg-primary/10 text-gray-800 hover:text-primary font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 0v4m0-4h4m-4 0H8m6 8H6a2 2 0 01-2-2V6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Palmarès
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
