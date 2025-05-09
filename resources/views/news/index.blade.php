@extends('app')

@section('content')
    <!-- Hero Section -->
    <x-hero
        title="Actualités & Annonces"
        subtitle="Toute l'actualité du Mondialito 2023"
        backgroundImage="/images/stade-actualites.jpg"
        variant="accent"
    />

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Colonne principale -->
            <div class="lg:col-span-2">
                <!-- Filtres -->
                <div class="flex flex-wrap gap-4 mb-8">
                    <button class="px-4 py-2 bg-primary text-white rounded-full font-medium">Tout voir</button>
                    <button class="px-4 py-2 bg-light hover:bg-light/80 rounded-full font-medium">Résumés</button>
                    <button class="px-4 py-2 bg-light hover:bg-light/80 rounded-full font-medium">Interviews</button>
                    <button class="px-4 py-2 bg-light hover:bg-light/80 rounded-full font-medium">Annonces</button>
                </div>

                <!-- Articles -->
                <div class="space-y-8">
                    <!-- Article 1 - Résumé de match -->
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="md:flex">
                            <div class="md:flex-shrink-0 md:w-1/3">
                                <img class="h-full w-full object-cover" src="https://img.olympics.com/images/image/private/t_s_16_9_g_auto/t_s_w1460/f_auto/primary/ngdjbafv3twathukjbq2" alt="Résumé du match">
                            </div>
                            <div class="p-6 md:w-2/3">
                                <div class="flex items-center mb-2">
                                    <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-xs font-semibold">Résumé</span>
                                    <span class="ml-2 text-sm text-gray-500">15 Juillet 2023</span>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-900 mb-3">Les Lions dominent les Tigres en ouverture</h2>
                                <p class="text-gray-600 mb-4">Dans un match intense, les Lions se sont imposés 3-1 face aux Tigres FC lors de la journée d'ouverture du Mondialito. Retour sur les temps forts de cette rencontre.</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img class="w-8 h-8 rounded-full mr-2" src="/images/auteur1.jpg" alt="Auteur">
                                        <span class="text-sm font-medium">Jean Bernard</span>
                                    </div>
                                    <a href="#" class="text-primary font-medium hover:text-accent transition duration-200">
                                        Lire la suite →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Article 2 - Interview -->
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <span class="px-3 py-1 bg-secondary/10 text-secondary rounded-full text-xs font-semibold">Interview</span>
                                <span class="ml-2 text-sm text-gray-500">12 Juillet 2023</span>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-3">"Nous sommes prêts" - Entretien avec le capitaine des Aigles</h2>
                            <div class="flex items-center mb-4">
                                <svg class="w-5 h-5 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm text-gray-500">Durée de lecture : 4 min</span>
                            </div>
                            <p class="text-gray-600 mb-4">À quelques jours du début du tournoi, nous avons rencontré Marc Antoine, capitaine des Aigles, pour parler des ambitions de son équipe et des préparatifs pour cette édition 2023.</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img class="w-8 h-8 rounded-full mr-2" src="data:image/png;base64,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" alt="Auteur">
                                    <span class="text-sm font-medium">Marie Legrand</span>
                                </div>
                                <a href="#" class="text-primary font-medium hover:text-accent transition duration-200">
                                    Lire l'interview →
                                </a>
                            </div>
                        </div>
                    </article>

                    <!-- Article 3 - Annonce -->
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 border-l-4 border-accent">
                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <span class="px-3 py-1 bg-accent/10 text-accent rounded-full text-xs font-semibold">Annonce</span>
                                <span class="ml-2 text-sm text-gray-500">10 Juillet 2023</span>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-3">Changement d'horaire pour la cérémonie d'ouverture</h2>
                            <div class="flex items-center mb-4">
                                <svg class="w-5 h-5 text-red-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                <span class="text-sm text-red-500">Important</span>
                            </div>
                            <p class="text-gray-600 mb-4">En raison des prévisions météorologiques, la cérémonie d'ouverture initialement prévue à 15h sera avancée à 13h. Les matchs du premier jour ne sont pas affectés par ce changement.</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Par l'organisation du Mondialito</span>
                                <a href="#" class="text-primary font-medium hover:text-accent transition duration-200">
                                    Voir les détails →
                                </a>
                            </div>
                        </div>
                    </article>

                    <!-- Pagination -->
                    <div class="mt-8 flex justify-center">
                        <nav class="flex items-center gap-1">
                            <button class="px-3 py-1 rounded-lg bg-light hover:bg-light/80">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button class="px-4 py-2 rounded-lg bg-primary text-white font-medium">1</button>
                            <button class="px-4 py-2 rounded-lg hover:bg-light">2</button>
                            <button class="px-4 py-2 rounded-lg hover:bg-light">3</button>
                            <button class="px-3 py-1 rounded-lg bg-light hover:bg-light/80">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Dernières annonces -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-accent mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Dernières annonces
                    </h3>
                    <ul class="space-y-4">
                        <li class="border-b border-light pb-4">
                            <a href="#" class="group">
                                <div class="text-sm text-gray-500 mb-1">14 Juillet 2023</div>
                                <h4 class="font-medium group-hover:text-primary transition duration-200">Nouveaux horaires pour les quarts de finale</h4>
                            </a>
                        </li>
                        <li class="border-b border-light pb-4">
                            <a href="#" class="group">
                                <div class="text-sm text-gray-500 mb-1">12 Juillet 2023</div>
                                <h4 class="font-medium group-hover:text-primary transition duration-200">Accès au stade - Consignes de sécurité</h4>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="group">
                                <div class="text-sm text-gray-500 mb-1">10 Juillet 2023</div>
                                <h4 class="font-medium group-hover:text-primary transition duration-200">Programme des animations autour des matchs</h4>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- À ne pas manquer -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-secondary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        À ne pas manquer
                    </h3>
                    <div class="space-y-4">
                        <article class="flex gap-4">
                            <img class="w-20 h-20 rounded-lg object-cover flex-shrink-0" src="https://img.olympics.com/images/image/private/t_s_16_9_g_auto/t_s_w1460/f_auto/primary/ngdjbafv3twathukjbq2" alt="Image article">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">8 Juillet 2023</div>
                                <h4 class="font-medium hover:text-primary transition duration-200">
                                    <a href="#">Les jeunes talents à suivre cette année</a>
                                </h4>
                            </div>
                        </article>
                        <article class="flex gap-4">
                            <img class="w-20 h-20 rounded-lg object-cover flex-shrink-0" src="https://img.olympics.com/images/image/private/t_s_16_9_g_auto/t_s_w1460/f_auto/primary/ngdjbafv3twathukjbq2" alt="Image article">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">5 Juillet 2023</div>
                                <h4 class="font-medium hover:text-primary transition duration-200">
                                    <a href="#">L'histoire du Mondialito en 5 moments clés</a>
                                </h4>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
