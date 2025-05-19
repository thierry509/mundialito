@extends('layout.app')
@section('content')
    <!-- Hero Section Moderne avec BG Image - Version mobile optimisée -->
    <header class="relative overflow-hidden">
        <!-- Conteneur pour l'image de fond avec hauteur adaptative -->
        <div class="relative h-[90vh] md:h-screen">
            <!-- Image de fond avec effet de parallaxe -->
            <div
                class="absolute inset-0 bg-[url('https://cdn.pixabay.com/photo/2020/01/12/16/57/stadium-4760441_1280.jpg')] bg-cover bg-center bg-no-repeat md:transform md:hover:scale-105 md:transition md:duration-1000 md:ease-in-out">
            </div>
            <div class="absolute inset-0 bg-black opacity-70"></div>

            <!-- Contenu superposé avec animation -->
            <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-4 py-16 md:py-0">
                <div class="max-w-4xl space-y-4 md:space-y-6 animate-fadeInUp">
                    <h1 class="text-4xl md:text-7xl font-bold text-white leading-tight">
                        {{-- <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-secondary to-accent">Mundialito</span>
                        <span class="block md:inline">Gonaïves</span>
                    </h1>
                    <p class="text-lg md:text-2xl text-gray-200 font-light max-w-2xl mx-auto">Championnat de Vacances d'Été
                        - La passion du football réunie</p> --}}


                    <img src="{{ asset('images/mundialito.png') }}" alt="">
                    <!-- Boutons avec effet hover moderne -->
                    <div class="flex flex-wrap justify-center gap-3 md:gap-4 pt-4 md:pt-6">
                        <a href="{{ route('calendar') }}" class="relative group">

                            <button
                                class="relative px-6 py-2 md:px-8 md:py-3 bg-white text-gray-900 font-bold rounded-lg hover:bg-transparent hover:text-white transition duration-200 border-2 border-white text-sm md:text-base">
                                Calendrier
                            </button>
                        </a>
                        <a href="{{ route('groups') }}" class="relative group">
                            <button
                                class="relative px-6 py-2 md:px-8 md:py-3 bg-transparent text-white font-bold rounded-lg hover:bg-white hover:text-gray-900 transition duration-200 border-2 border-white text-sm md:text-base">
                                Classement
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu principal moderne -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section À propos - Design carte moderne -->
        <section id="about" class="py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <span class="inline-block px-3 py-1 bg-accent/10 text-accent rounded-full text-sm font-semibold">LE
                        TOURNOI</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900">
                        Plus qu'un championnat, <span class="text-primary">une tradition</span>
                    </h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Depuis 1998, le Mundialito des Gonaïves rassemble chaque été les passionnés de football autour d'un
                        tournoi explosif.
                        Ce championnat est devenu bien plus qu'une compétition sportive, c'est un événement culturel qui
                        anime la ville.
                    </p>
                    <div class="grid grid-cols-2 gap-4 pt-4">
                        <div class="p-4 bg-light/50 rounded-xl border border-light">
                            <h3 class="text-xl font-bold text-primary">24</h3>
                            <p class="text-gray-600">Équipes</p>
                        </div>
                        <div class="p-4 bg-light/50 rounded-xl border border-light">
                            <h3 class="text-xl font-bold text-primary">25e</h3>
                            <p class="text-gray-600">Édition</p>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <div
                        class="absolute -inset-2 bg-gradient-to-r from-primary to-accent rounded-2xl opacity-75 group-hover:opacity-100 blur-lg transition duration-200">
                    </div>
                    <div class="relative h-full rounded-2xl overflow-hidden">
                        <img src="https://scontent-mia3-3.cdninstagram.com/v/t39.30808-6/490739523_3326385414202174_6671966704155999471_n.jpg?stp=dst-jpg_e35_s640x640_sh0.08_tt6&efg=eyJ2ZW5jb2RlX3RhZyI6ImltYWdlX3VybGdlbi4yMDQ4eDEzNjYuc2RyLmYzMDgwOC5kZWZhdWx0X2ltYWdlIn0&_nc_ht=scontent-mia3-3.cdninstagram.com&_nc_cat=110&_nc_oc=Q6cZ2QF64Z0-fIt5Y6qt8mqCwunk8IwIXXzICy_UQeJAjA5BnVLL3uKtGfGxPcK4rAzhDNs&_nc_ohc=7sB3WWtVlIsQ7kNvwEJPs-H&_nc_gid=oP-hzwwIEEepc1avdb9C-A&edm=ANTKIIoAAAAA&ccb=7-5&oh=00_AfGCUA4c_0h3C2hKX8MbWPFGQz0HtsgTweJUm_er2zrAFA&oe=6815760A&_nc_sid=d885a2"
                            alt="Équipes du Mundialito"
                            class="w-full h-auto object-cover transition duration-500 group-hover:scale-105">
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Classement & Résultats -->
        <section id="live" class="py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Classement -->
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-3xl font-bold text-gray-900">Classement</h2>
                        <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-semibold">MIS À
                            JOUR</span>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="grid grid-cols-12 bg-accent text-white font-bold">
                            <div class="col-span-1 p-4 text-center">#</div>
                            <div class="col-span-7 p-4">Équipe</div>
                            <div class="col-span-2 p-4 text-center">PTS</div>
                            <div class="col-span-2 p-4 text-center">MJ</div>
                        </div>

                        <!-- Équipe 1 -->
                        <div class="grid grid-cols-12 border-b border-light hover:bg-light/50 transition duration-200">
                            <div class="col-span-1 p-4 text-center font-bold text-primary">1</div>
                            <div class="col-span-7 p-4 flex items-center">
                                <div
                                    class="w-8 h-8 rounded-full bg-primary mr-3 flex items-center justify-center text-white font-bold">
                                    L</div>
                                <span>Les Lions</span>
                            </div>
                            <div class="col-span-2 p-4 text-center font-bold">15</div>
                            <div class="col-span-2 p-4 text-center">5</div>
                        </div>

                        <!-- Équipe 2 -->
                        <div class="grid grid-cols-12 border-b border-light hover:bg-light/50 transition duration-200">
                            <div class="col-span-1 p-4 text-center font-bold text-primary">2</div>
                            <div class="col-span-7 p-4 flex items-center">
                                <div
                                    class="w-8 h-8 rounded-full bg-secondary mr-3 flex items-center justify-center text-gray-900 font-bold">
                                    T</div>
                                <span>Tigres FC</span>
                            </div>
                            <div class="col-span-2 p-4 text-center font-bold">12</div>
                            <div class="col-span-2 p-4 text-center">5</div>
                        </div>
                    </div>
                </div>

                <!-- Prochain match -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Prochain match</h2>

                    <div class="bg-gradient-to-r from-primary to-accent rounded-2xl shadow-lg overflow-hidden text-white">
                        <div class="p-6 text-center">
                            <div class="text-lg font-semibold mb-2">Phase de groupes • Jour 6</div>
                            <div class="text-sm bg-white/20 rounded-full px-4 py-1 inline-block mb-6">15 Juillet 2023 -
                                16:00</div>

                            <div class="flex justify-around items-center">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-white rounded-full mx-auto mb-3 flex items-center justify-center text-gray-900 font-bold text-xl">
                                        L</div>
                                    <div class="text-xl font-bold">Lions</div>
                                    <div class="text-sm opacity-80">3 victoires</div>
                                </div>

                                <div class="mx-4">
                                    <div class="text-2xl font-bold bg-white/20 rounded-full px-4 py-2">VS</div>
                                </div>

                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-white rounded-full mx-auto mb-3 flex items-center justify-center text-gray-900 font-bold text-xl">
                                        T</div>
                                    <div class="text-xl font-bold">Tigres</div>
                                    <div class="text-sm opacity-80">2 victoires</div>
                                </div>
                            </div>

                            <div class="mt-8 pt-4 border-t border-white/20">
                                <div class="flex justify-center space-x-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Stade Pinchinat
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white/10 p-4 text-center">
                            <a href="#"
                                class="inline-flex items-center text-white font-medium hover:text-secondary transition duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Suivre en direct
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Calendrier -->
        <section id="calendrier" class="py-20">
            <div class="text-center mb-12">
                <span
                    class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-semibold">CALENDRIER</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-4">Programme des <span
                        class="text-accent">matchs</span></h2>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Navigation mois -->
                <div class="flex justify-between items-center p-4 border-b border-light">
                    <button class="p-2 rounded-full hover:bg-light transition duration-200">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>
                    <div class="text-lg font-bold">Juillet 2023</div>
                    <button class="p-2 rounded-full hover:bg-light transition duration-200">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- En-têtes jours -->
                <div class="grid grid-cols-7 bg-light text-center font-medium text-sm text-gray-600">
                    <div class="p-3">Lun</div>
                    <div class="p-3">Mar</div>
                    <div class="p-3">Mer</div>
                    <div class="p-3">Jeu</div>
                    <div class="p-3">Ven</div>
                    <div class="p-3">Sam</div>
                    <div class="p-3">Dim</div>
                </div>

                <!-- Jours du mois -->
                <div class="grid grid-cols-7 text-center">
                    <!-- Exemple de jour avec match -->
                    <div class="p-3 border border-light min-h-16 hover:bg-light/50 transition duration-200">
                        <div class="text-gray-400">1</div>
                    </div>
                    <div class="p-3 border border-light min-h-16 hover:bg-light/50 transition duration-200">
                        <div class="text-gray-400">2</div>
                    </div>
                    <div class="p-3 border border-light min-h-16 hover:bg-light/50 transition duration-200 relative">
                        <div class="text-gray-900 font-medium">3</div>
                        <div class="absolute bottom-1 left-0 right-0">
                            <div class="w-2 h-2 bg-primary rounded-full mx-auto"></div>
                        </div>
                    </div>
                    <!-- Jour avec match -->
                    <div
                        class="p-3 border border-light min-h-16 bg-primary/10 hover:bg-primary/20 transition duration-200">
                        <div class="font-medium">10</div>
                        <div class="text-xs mt-1">
                            <div class="truncate">Lions vs Tigres</div>
                            <div class="text-primary font-semibold">16:00</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('styles')
    <style>
        /* Animation personnalisée */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 1s ease-out;
        }

        /* Effet de parallaxe */
        @media (min-width: 1024px) {
            .bg-parallax {
                background-attachment: fixed;
            }
        }
    </style>
@endpush
