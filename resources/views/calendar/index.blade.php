@extends('app')
@section('content')
    <x-hero title="Calendrier des Matchs" subtitle="Suivez toutes les rencontres du Mondialito 2023" />

    <!-- Section principale du Calendrier -->
    <main class="container mx-auto px-4 py-12">
        <!-- Vue Mois (par défaut) -->
        <div id="month-view" class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- En-tête avec navigation -->
            <div class="flex items-center justify-between p-4 border-b border-light bg-light/50">
                <button class="p-2 rounded-full hover:bg-light">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <h2 class="text-xl font-bold text-gray-800">Juillet 2023</h2>
                <button class="p-2 rounded-full hover:bg-light">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Jours de la semaine -->
            <div class="grid grid-cols-7 bg-accent text-white text-sm font-medium text-center">
                <div class="py-3">Lundi</div>
                <div class="py-3">Mardi</div>
                <div class="py-3">Mercredi</div>
                <div class="py-3">Jeudi</div>
                <div class="py-3">Vendredi</div>
                <div class="py-3">Samedi</div>
                <div class="py-3">Dimanche</div>
            </div>

            <!-- Dates du mois -->
            <div class="grid grid-cols-7 auto-rows-min border-t border-l border-light">
                <!-- Jours vides pour alignement -->
                <div class="h-24 border-b border-r border-light"></div>
                <div class="h-24 border-b border-r border-light"></div>
                <div class="h-24 border-b border-r border-light"></div>
                <div class="h-24 border-b border-r border-light"></div>
                <div class="h-24 border-b border-r border-light"></div>
                <div class="h-24 border-b border-r border-light"></div>
                <div class="h-24 border-b border-r border-light"></div>

                <!-- Jours avec matchs -->
                <div class="h-24 border-b border-r border-light p-1 hover:bg-light/30">
                    <div class="text-right text-sm p-1">1</div>
                </div>

                <!-- Jour avec match -->
                <div class="h-24 border-b border-r border-light p-1 hover:bg-light/30 relative">
                    <div class="text-right text-sm p-1">5</div>
                    <div class="absolute inset-0 mt-6 p-1 overflow-y-auto">
                        <div class="text-xs bg-primary/10 p-1 rounded mb-1">
                            <div class="font-medium">Lions vs Aigles</div>
                            <div class="text-primary">16:00 - Stade A</div>
                        </div>
                    </div>
                </div>

                <!-- Plus de jours... -->
                <div class="h-24 border-b border-r border-light p-1 hover:bg-light/30 relative">
                    <div class="text-right text-sm p-1">8</div>
                    <div class="absolute inset-0 mt-6 p-1 overflow-y-auto">
                        <div class="text-xs bg-primary/10 p-1 rounded mb-1">
                            <div class="font-medium">Tigres vs Étoiles</div>
                            <div class="text-primary">18:00 - Stade B</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vue Semaine (cachée par défaut) -->
        <div id="week-view" class="bg-white rounded-xl shadow-md overflow-hidden hidden">
            <!-- En-tête avec navigation -->
            <div class="flex items-center justify-between p-4 border-b border-light bg-light/50">
                <button class="p-2 rounded-full hover:bg-light">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <h2 class="text-xl font-bold text-gray-800">Semaine du 10 au 16 Juillet 2023</h2>
                <button class="p-2 rounded-full hover:bg-light">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Grille hebdomadaire -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-accent text-white">
                            <th class="p-3 text-left">Heure</th>
                            <th class="p-3 text-left">Lundi 10</th>
                            <th class="p-3 text-left">Mardi 11</th>
                            <th class="p-3 text-left">Mercredi 12</th>
                            <th class="p-3 text-left">Jeudi 13</th>
                            <th class="p-3 text-left">Vendredi 14</th>
                            <th class="p-3 text-left">Samedi 15</th>
                            <th class="p-3 text-left">Dimanche 16</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Créneau 16:00 -->
                        <tr class="border-b border-light hover:bg-light/30">
                            <td class="p-3 font-medium">16:00</td>
                            <td class="p-3">
                                <div class="text-sm bg-primary/10 p-2 rounded">
                                    <div class="font-medium">Lions vs Aigles</div>
                                    <div class="text-primary text-xs">Stade Pinchinat</div>
                                </div>
                            </td>
                            <td class="p-3"></td>
                            <td class="p-3">
                                <div class="text-sm bg-primary/10 p-2 rounded">
                                    <div class="font-medium">Tigres vs Étoiles</div>
                                    <div class="text-primary text-xs">Stade Municipal</div>
                                </div>
                            </td>
                            <td class="p-3"></td>
                            <td class="p-3"></td>
                            <td class="p-3">
                                <div class="text-sm bg-primary/10 p-2 rounded">
                                    <div class="font-medium">Quart de finale</div>
                                    <div class="text-primary text-xs">Stade Pinchinat</div>
                                </div>
                            </td>
                            <td class="p-3"></td>
                        </tr>

                        <!-- Créneau 18:00 -->
                        <tr class="border-b border-light hover:bg-light/30">
                            <td class="p-3 font-medium">18:00</td>
                            <td class="p-3"></td>
                            <td class="p-3">
                                <div class="text-sm bg-primary/10 p-2 rounded">
                                    <div class="font-medium">Aigles vs Tigres</div>
                                    <div class="text-primary text-xs">Stade Municipal</div>
                                </div>
                            </td>
                            <td class="p-3"></td>
                            <td class="p-3">
                                <div class="text-sm bg-primary/10 p-2 rounded">
                                    <div class="font-medium">Étoiles vs Lions</div>
                                    <div class="text-primary text-xs">Stade Pinchinat</div>
                                </div>
                            </td>
                            <td class="p-3"></td>
                            <td class="p-3"></td>
                            <td class="p-3">
                                <div class="text-sm bg-primary/10 p-2 rounded">
                                    <div class="font-medium">Quart de finale</div>
                                    <div class="text-primary text-xs">Stade Municipal</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Liste complète des matchs -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Tous les matchs</h2>

            <!-- Filtres rapides -->
            <div class="flex flex-wrap gap-2 mb-6">
                <button class="px-3 py-1 bg-primary text-white rounded-full text-sm font-medium">Tous</button>
                <button class="px-3 py-1 bg-light hover:bg-light/80 text-gray-700 rounded-full text-sm font-medium">Phase
                    de groupes</button>
                <button class="px-3 py-1 bg-light hover:bg-light/80 text-gray-700 rounded-full text-sm font-medium">Phases
                    finales</button>
                <button
                    class="px-3 py-1 bg-light hover:bg-light/80 text-gray-700 rounded-full text-sm font-medium">Aujourd'hui</button>
                <button class="px-3 py-1 bg-light hover:bg-light/80 text-gray-700 rounded-full text-sm font-medium">Cette
                    semaine</button>
            </div>

            <!-- Liste des matchs -->
            <div class="space-y-4">
                <!-- Match 1 -->
                <div
                    class="bg-white rounded-lg shadow-sm p-4 border border-light hover:border-primary/50 transition duration-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="text-sm text-gray-500 mb-1">Phase de groupes • Jour 1</div>
                            <div class="flex items-center justify-center md:justify-start gap-4">
                                <div class="text-center">
                                    <div
                                        class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-1">
                                        <span class="font-bold text-primary">L</span>
                                    </div>
                                    <div class="font-medium">Les Lions</div>
                                </div>
                                <div class="text-center px-4">
                                    <div class="text-xs bg-primary/10 text-primary rounded-full px-3 py-1">15 Juil • 16:00
                                    </div>
                                    <div class="text-sm mt-1">Stade Pinchinat</div>
                                </div>
                                <div class="text-center">
                                    <div
                                        class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-1">
                                        <span class="font-bold text-primary">A</span>
                                    </div>
                                    <div class="font-medium">Les Aigles</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center gap-2">
                            <button
                                class="px-4 py-2 bg-light hover:bg-light/80 rounded-lg text-sm font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Détails
                            </button>
                            <button
                                class="px-4 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Suivre
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Match 2 -->
                <div
                    class="bg-white rounded-lg shadow-sm p-4 border border-light hover:border-primary/50 transition duration-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="text-sm text-gray-500 mb-1">Phase de groupes • Jour 2</div>
                            <div class="flex items-center justify-center md:justify-start gap-4">
                                <div class="text-center">
                                    <div
                                        class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-1">
                                        <span class="font-bold text-secondary">T</span>
                                    </div>
                                    <div class="font-medium">Tigres FC</div>
                                </div>
                                <div class="text-center px-4">
                                    <div class="text-xs bg-primary/10 text-primary rounded-full px-3 py-1">17 Juil • 18:00
                                    </div>
                                    <div class="text-sm mt-1">Stade Municipal</div>
                                </div>
                                <div class="text-center">
                                    <div
                                        class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-1">
                                        <span class="font-bold text-primary">E</span>
                                    </div>
                                    <div class="font-medium">Étoiles FC</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center gap-2">
                            <button
                                class="px-4 py-2 bg-light hover:bg-light/80 rounded-lg text-sm font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Détails
                            </button>
                            <button
                                class="px-4 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Suivre
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <nav class="flex items-center gap-1">
                    <button class="px-3 py-1 rounded-lg bg-light hover:bg-light/80">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-primary text-white font-medium">1</button>
                    <button class="px-4 py-2 rounded-lg hover:bg-light">2</button>
                    <button class="px-4 py-2 rounded-lg hover:bg-light">3</button>
                    <button class="px-3 py-1 rounded-lg bg-light hover:bg-light/80">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </nav>
            </div>
        </div>
    </main>

    @push('scripts')
        <script>
            // Basculer entre les vues Mois/Semaine
            document.getElementById('view-month').addEventListener('click', function() {
                document.getElementById('month-view').classList.remove('hidden');
                document.getElementById('week-view').classList.add('hidden');
                this.classList.add('bg-primary', 'text-white');
                this.classList.remove('bg-light', 'text-gray-700');
                document.getElementById('view-week').classList.add('bg-light', 'text-gray-700');
                document.getElementById('view-week').classList.remove('bg-primary', 'text-white');
            });

            document.getElementById('view-week').addEventListener('click', function() {
                document.getElementById('week-view').classList.remove('hidden');
                document.getElementById('month-view').classList.add('hidden');
                this.classList.add('bg-primary', 'text-white');
                this.classList.remove('bg-light', 'text-gray-700');
                document.getElementById('view-month').classList.add('bg-light', 'text-gray-700');
                document.getElementById('view-month').classList.remove('bg-primary', 'text-white');
            });

            // Filtrer les matchs
            document.getElementById('phase').addEventListener('change', function() {
                // Ici, vous ajouteriez la logique de filtrage
                console.log('Filtrer par phase:', this.value);
            });

            document.getElementById('team').addEventListener('change', function() {
                // Ici, vous ajouteriez la logique de filtrage
                console.log('Filtrer par équipe:', this.value);
            });
        </script>
    @endpush
@endsection
