@extends('app')

@section('content')
    <!-- Hero Section avec le composant réutilisable -->
    <x-hero
        title="Résultats des Matchs"
        subtitle="Tous les scores et statistiques du Mondialito 2023"
        backgroundImage="/images/stade-resultats.jpg"
        variant="secondary"
    />

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">


        <!-- Liste des résultats -->
        <div class="space-y-6">
            <!-- Match 1 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-light hover:shadow-lg transition duration-300">
                <!-- En-tête du match -->
                <div class="bg-light/50 p-4 border-b border-light">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-medium text-gray-700">
                            Phase de groupes • Journée 1 • 15 Juillet 2023
                        </div>
                        <div class="text-sm bg-primary text-white px-3 py-1 rounded-full">
                            Terminé
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 mt-1">
                        Stade Pinchinat • 16:00
                    </div>
                </div>

                <!-- Score et équipes -->
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <!-- Équipe domicile -->
                        <div class="flex items-center w-1/3">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mr-4">
                                <span class="font-bold text-primary">L</span>
                            </div>
                            <div class="font-bold text-lg">Les Lions</div>
                        </div>

                        <!-- Score -->
                        <div class="flex items-center justify-center flex-1">
                            <div class="text-3xl font-bold mx-4">3</div>
                            <div class="text-gray-500">-</div>
                            <div class="text-3xl font-bold mx-4">1</div>
                        </div>

                        <!-- Équipe extérieure -->
                        <div class="flex items-center justify-end w-1/3">
                            <div class="font-bold text-lg">Les Aigles</div>
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center ml-4">
                                <span class="font-bold text-primary">A</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Détails du match (expandable) -->
                <div x-data="{ open: false }" class="border-t border-light">
                    <!-- Bouton pour afficher les détails -->
                    <button
                        @click="open = !open"
                        class="w-full p-4 flex items-center justify-between text-sm font-medium text-primary hover:bg-light/20 transition duration-200"
                    >
                        <span>Voir les détails du match</span>
                        <svg
                            class="w-5 h-5 transform transition duration-200"
                            :class="{ 'rotate-180': open }"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Contenu des détails -->
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <!-- Buteurs -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold mb-3 flex items-center">
                                <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Buteurs
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Buteurs domicile -->
                                <div>
                                    <div class="font-medium mb-2">Les Lions</div>
                                    <ul class="space-y-2">
                                        <li class="flex items-center">
                                            <span class="w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center mr-2">1</span>
                                            <span>Jean Dupont (23')</span>
                                        </li>
                                        <li class="flex items-center">
                                            <span class="w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center mr-2">2</span>
                                            <span>Marc Lavoie (45+1')</span>
                                        </li>
                                        <li class="flex items-center">
                                            <span class="w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center mr-2">3</span>
                                            <span>Paul Martin (78')</span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Buteurs extérieur -->
                                <div>
                                    <div class="font-medium mb-2">Les Aigles</div>
                                    <ul class="space-y-2">
                                        <li class="flex items-center">
                                            <span class="w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center mr-2">1</span>
                                            <span>Luc Tremblay (67')</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Cartons -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold mb-3 flex items-center">
                                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                Cartons
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Cartons domicile -->
                                <div>
                                    <div class="font-medium mb-2">Les Lions</div>
                                    <ul class="space-y-2">
                                        <li class="flex items-center">
                                            <span class="w-6 h-6 bg-yellow-500 text-white rounded-full flex items-center justify-center mr-2">J</span>
                                            <span>Jean Dupont (34')</span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Cartons extérieur -->
                                <div>
                                    <div class="font-medium mb-2">Les Aigles</div>
                                    <ul class="space-y-2">
                                        <li class="flex items-center">
                                            <span class="w-6 h-6 bg-yellow-500 text-white rounded-full flex items-center justify-center mr-2">J</span>
                                            <span>Pierre Legrand (56')</span>
                                        </li>
                                        <li class="flex items-center">
                                            <span class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center mr-2">R</span>
                                            <span>Jacques Monet (89')</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Homme du match -->
                        <div class="bg-light/30 p-4 rounded-lg">
                            <h3 class="text-lg font-bold mb-2 flex items-center">
                                <svg class="w-5 h-5 text-secondary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                                Homme du match
                            </h3>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mr-4">
                                    <span class="font-bold text-primary">J</span>
                                </div>
                                <div>
                                    <div class="font-bold">Jean Dupont</div>
                                    <div class="text-sm text-gray-600">Les Lions • 1 but, 1 passe décisive</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Match 2 (similaire structure) -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-light hover:shadow-lg transition duration-300">
                <!-- Structure similaire au match 1 -->
            </div>
        </div>

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
    </main>

    @push('scripts')
        <script>
            // Gestion des filtres
            document.getElementById('journee').addEventListener('change', function() {
                console.log('Filtrer par journée:', this.value);
                // Implémentez la logique de filtrage ici
            });

            document.getElementById('equipe').addEventListener('change', function() {
                console.log('Filtrer par équipe:', this.value);
                // Implémentez la logique de filtrage ici
            });

            document.getElementById('phase').addEventListener('change', function() {
                console.log('Filtrer par phase:', this.value);
                // Implémentez la logique de filtrage ici
            });
        </script>
    @endpush
@endsection
