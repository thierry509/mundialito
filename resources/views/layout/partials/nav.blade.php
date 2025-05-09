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
