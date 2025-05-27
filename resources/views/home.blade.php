@extends('layout.app')
@section('content')
    <header class="relative overflow-hidden">
        <!-- Conteneur pour l'image de fond -->
        <div class="relative h-[90vh] md:h-screen">
            <!-- Image de fond avec effet de parallaxe -->
            <div
                class="absolute inset-0 bg-[url('https://cdn.pixabay.com/photo/2020/01/12/16/57/stadium-4760441_1280.jpg')] bg-cover bg-center bg-no-repeat md:transform md:hover:scale-105 md:transition md:duration-1000 md:ease-[cubic-bezier(0.25,0.1,0.25,1)]">
            </div>

            <!-- Overlay avec dégradé -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-black/50"></div>

            <!-- Contenu superposé -->
            <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-4">
                <div class="flex flex-col justify-center items-center max-w-4xl space-y-6 md:space-y-8 animate-fadeInUp">
                    <!-- Logo -->
                    <div class="transform hover:scale-105 transition duration-500">
                        <img class="w-64 md:w-80 h-auto" src="{{ asset('images/mundialito.png') }}" alt="Mundialito Logo">
                    </div>

                    <!-- Titre accrocheur -->
                    <h1 class="text-2xl md:text-4xl font-bold text-white tracking-tight leading-tight">
                        Une ville une competition !
                    </h1>

                    <!-- Phrase d'accroche -->
                    <p class="text-sm md:text-lg text-white/90 max-w-2xl px-4">
                        Suivez chaque match, chaque émotion du tournoi le plus attendu de l'année.
                    </p>

                    <!-- Boutons CTA -->
                    <div class="flex justify-center gap-4 md:gap-6 pt-2 md:pt-4">
                        <a href="{{ route('games') }}" class="relative group">
                            <button
                                class="relative px-8 py-3 md:px-10 md:py-3.5 bg-white text-gray-900 font-bold rounded-lg hover:bg-transparent hover:text-white transition-all duration-300 border-2 border-white text-sm md:text-base shadow-lg hover:shadow-white/20 active:scale-95">
                                <span class="text-sm relative z-10">Calendrier</span>
                            </button>
                        </a>
                        <a href="{{ route('groups') }}" class="relative group">
                            <button
                                class="relative px-8 py-3 md:px-10 md:py-3.5 bg-transparent text-white font-bold rounded-lg hover:bg-white hover:text-gray-900 transition-all duration-300 border-2 border-white text-sm md:text-base shadow-lg hover:shadow-white/20 active:scale-95">
                                <span class=" text-sm relative z-10">Classements</span>
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
        <section class="py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative group">
                    <div class="absolute -inset-2 bg-gradient-to-r from-secondary to-accent rounded-2xl opacity-75 group-hover:opacity-100 blur-lg transition duration-200"></div>
                    <div class="relative h-full rounded-2xl overflow-hidden">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Crowd_football_match.jpg/800px-Crowd_football_match.jpg" alt="Ambiance Mundialito" class="w-full h-auto object-cover transition duration-500 group-hover:scale-105">
                    </div>
                </div>
                <div class="space-y-6">
                    <span class="inline-block px-3 py-1 bg-secondary/10 text-secondary rounded-full text-sm font-semibold">L'ESPRIT</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900">Une ambiance <span class="text-secondary">incomparable</span></h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Chaque édition du Mundialito, c’est une explosion de couleurs, de chants, de klaxons et de passion. Des
                        quartiers entiers se mobilisent pour soutenir leur équipe avec ferveur. Entre les matchs, on assiste à des
                        prestations culturelles, des animations musicales et des rassemblements festifs qui transforment chaque
                        journée de compétition en une célébration populaire.
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Ce n’est pas seulement le football qui attire les foules, mais aussi cette atmosphère unique, conviviale et
                        survoltée qui fait du Mundialito une expérience inoubliable pour tous les âges.
                    </p>
                </div>
            </div>
        </section>

        <section class="py-20 bg-light/50 rounded-3xl">
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <span class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-semibold">JEUNESSE & AVENIR</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900">Révéler <span class="text-primary">la relève</span> du football haïtien</h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Au fil des ans, le Mundialito est devenu une vitrine exceptionnelle pour les jeunes talents. De nombreux joueurs
                        qui ont foulé la pelouse de ce tournoi ont ensuite intégré des clubs nationaux et parfois même étrangers.
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        C’est un espace d’opportunités où les recruteurs et les passionnés viennent découvrir les stars de demain.
                        L’organisation met un point d’honneur à encourager la discipline, le fair-play et l’excellence, offrant ainsi
                        une base solide pour l’avenir du sport.
                    </p>
                </div>
                <div class="relative group">
                    <div class="absolute -inset-2 bg-gradient-to-r from-primary to-secondary rounded-2xl opacity-75 group-hover:opacity-100 blur-lg transition duration-200"></div>
                    <div class="relative h-full rounded-2xl overflow-hidden">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/Football_training.jpg/800px-Football_training.jpg" alt="Jeunes joueurs" class="w-full h-auto object-cover transition duration-500 group-hover:scale-105">
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20">
            <div class="max-w-6xl mx-auto text-center space-y-8">
                <span class="inline-block px-3 py-1 bg-accent/10 text-accent rounded-full text-sm font-semibold">HISTOIRE</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900">Une histoire <span class="text-accent">riche en émotions</span></h2>
                <p class="text-lg text-gray-600 leading-relaxed max-w-3xl mx-auto">
                    Né en 1998 dans les rues animées des Gonaïves, le Mundialito est rapidement devenu un rendez-vous
                    incontournable de l’été. D’une initiative locale entre amis, le tournoi a évolué pour devenir une véritable
                    institution sportive et culturelle, avec une organisation professionnelle et des supporters toujours plus nombreux.
                </p>
                <p class="text-lg text-gray-600 leading-relaxed max-w-3xl mx-auto">
                    Chaque édition marque une nouvelle page de son histoire, remplie de rivalités légendaires, de buts inoubliables et
                    de moments qui resteront gravés dans la mémoire collective de toute une ville.
                </p>
            </div>
        </section>
        <section class="py-20 bg-white rounded-3xl">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <span class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-semibold">PALMARÈS</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900">Les champions <span class="text-primary">depuis 1998</span></h2>
                    <p class="text-lg text-gray-600 mt-4 max-w-2xl mx-auto">Découvrez les clubs qui ont marqué l’histoire du Mundialito
                        par leurs performances exceptionnelles.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Exemples -->
                    <div class="bg-light/50 border border-light rounded-xl p-6">
                        <h3 class="text-xl font-bold text-primary mb-2">Les Lions</h3>
                        <p class="text-gray-600">6 titres remportés<br><span class="text-sm italic">Dernier titre : 2023</span></p>
                    </div>
                    <div class="bg-light/50 border border-light rounded-xl p-6">
                        <h3 class="text-xl font-bold text-secondary mb-2">Tigres FC</h3>
                        <p class="text-gray-600">4 titres remportés<br><span class="text-sm italic">Dernier titre : 2021</span></p>
                    </div>
                    <div class="bg-light/50 border border-light rounded-xl p-6">
                        <h3 class="text-xl font-bold text-accent mb-2">Espoir Gonaïves</h3>
                        <p class="text-gray-600">3 titres remportés<br><span class="text-sm italic">Dernier titre : 2017</span></p>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-20">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <span class="inline-block px-3 py-1 bg-secondary/10 text-secondary rounded-full text-sm font-semibold">TEMOIGNAGES</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900">Ils racontent <span class="text-secondary">leur Mundialito</span></h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Témoignage 1 -->
                    <div class="bg-white border border-light rounded-2xl p-6 shadow-sm">
                        <p class="text-gray-600 italic mb-4">"Le Mundialito, c’est l’âme des Gonaïves. Chaque été, on vit au rythme des
                            matchs. C’est une fierté locale qu’on partage en famille."</p>
                        <div class="text-sm font-semibold text-gray-800">— Marie S., résidente de Raboteau</div>
                    </div>

                    <!-- Témoignage 2 -->
                    <div class="bg-white border border-light rounded-2xl p-6 shadow-sm">
                        <p class="text-gray-600 italic mb-4">"Je suis venu une fois par curiosité, j’y retourne chaque année. L’ambiance
                            est folle, et le niveau est vraiment impressionnant."</p>
                        <div class="text-sm font-semibold text-gray-800">— Kevin J., supporter capois</div>
                    </div>

                    <!-- Témoignage 3 -->
                    <div class="bg-white border border-light rounded-2xl p-6 shadow-sm">
                        <p class="text-gray-600 italic mb-4">"C’est un moment de rassemblement exceptionnel. Le Mundialito nous fait
                            vibrer, rire et rêver. Une vraie tradition populaire."</p>
                        <div class="text-sm font-semibold text-gray-800">— Eddy M., ancien joueur</div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Section Classement & Résultats -->
        <section id="live" class="py-20 hidden">
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

        .animate-fadeInUp {
            animation: fadeInUp 1s ease-out forwards;
        }

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
    </style>
@endpush
