@extends('app')

@section('content')
    <!-- Hero Section -->
    <x-hero
        title="Classement des Poules"
        subtitle="Consultez les statistiques complètes de chaque groupe"
        backgroundImage="/images/stade-classement.jpg"
        variant="dark"
    />

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">
        <!-- Filtre par poule -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                <button class="px-4 py-2 bg-primary text-white rounded-full font-medium">Poule A</button>
                <button class="px-4 py-2 bg-light hover:bg-light/80 rounded-full font-medium">Poule B</button>
                <button class="px-4 py-2 bg-light hover:bg-light/80 rounded-full font-medium">Poule C</button>
                <button class="px-4 py-2 bg-light hover:bg-light/80 rounded-full font-medium">Poule D</button>
            </div>
        </div>

        <!-- Classement Poule A -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-12">
            <!-- Titre Poule -->
            <div class="bg-accent text-white p-4">
                <h2 class="text-xl font-bold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Poule A - Classement
                </h2>
                <div class="text-sm opacity-90 mt-1">Mis à jour le {{ now()->format('d/m/Y à H:i') }}</div>
            </div>

            <!-- Tableau classement -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-light/50">
                        <tr>
                            <th class="p-3 text-left w-8">#</th>
                            <th class="p-3 text-left min-w-[200px]">Équipe</th>
                            <th class="p-3 text-center">PTS</th>
                            <th class="p-3 text-center">J</th>
                            <th class="p-3 text-center">V</th>
                            <th class="p-3 text-center">N</th>
                            <th class="p-3 text-center">D</th>
                            <th class="p-3 text-center">BP</th>
                            <th class="p-3 text-center">BC</th>
                            <th class="p-3 text-center">+/-</th>
                            <th class="p-3 text-center">Forme</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-light">
                        <!-- Équipe 1 -->
                        <tr class="hover:bg-light/30">
                            <td class="p-3 font-bold text-primary">1</td>
                            <td class="p-3">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mr-3">
                                        <span class="font-bold text-primary">L</span>
                                    </div>
                                    <span>Les Lions</span>
                                </div>
                            </td>
                            <td class="p-3 text-center font-bold">9</td>
                            <td class="p-3 text-center">3</td>
                            <td class="p-3 text-center">3</td>
                            <td class="p-3 text-center">0</td>
                            <td class="p-3 text-center">0</td>
                            <td class="p-3 text-center">8</td>
                            <td class="p-3 text-center">2</td>
                            <td class="p-3 text-center font-bold text-primary">+6</td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center space-x-1">
                                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                </div>
                            </td>
                        </tr>

                        <!-- Équipe 2 -->
                        <tr class="hover:bg-light/30">
                            <td class="p-3 font-bold">2</td>
                            <td class="p-3">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-secondary/10 rounded-full flex items-center justify-center mr-3">
                                        <span class="font-bold text-secondary">T</span>
                                    </div>
                                    <span>Tigres FC</span>
                                </div>
                            </td>
                            <td class="p-3 text-center font-bold">6</td>
                            <td class="p-3 text-center">3</td>
                            <td class="p-3 text-center">2</td>
                            <td class="p-3 text-center">0</td>
                            <td class="p-3 text-center">1</td>
                            <td class="p-3 text-center">5</td>
                            <td class="p-3 text-center">3</td>
                            <td class="p-3 text-center font-bold">+2</td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center space-x-1">
                                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                </div>
                            </td>
                        </tr>

                        <!-- Équipe 3 -->
                        <tr class="hover:bg-light/30">
                            <td class="p-3 font-bold">3</td>
                            <td class="p-3">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-accent/10 rounded-full flex items-center justify-center mr-3">
                                        <span class="font-bold text-accent">A</span>
                                    </div>
                                    <span>Les Aigles</span>
                                </div>
                            </td>
                            <td class="p-3 text-center font-bold">3</td>
                            <td class="p-3 text-center">3</td>
                            <td class="p-3 text-center">1</td>
                            <td class="p-3 text-center">0</td>
                            <td class="p-3 text-center">2</td>
                            <td class="p-3 text-center">4</td>
                            <td class="p-3 text-center">6</td>
                            <td class="p-3 text-center font-bold text-danger">-2</td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center space-x-1">
                                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                </div>
                            </td>
                        </tr>

                        <!-- Équipe 4 -->
                        <tr class="hover:bg-light/30">
                            <td class="p-3 font-bold">4</td>
                            <td class="p-3">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                        <span class="font-bold text-gray-600">E</span>
                                    </div>
                                    <span>Étoiles FC</span>
                                </div>
                            </td>
                            <td class="p-3 text-center font-bold">0</td>
                            <td class="p-3 text-center">3</td>
                            <td class="p-3 text-center">0</td>
                            <td class="p-3 text-center">0</td>
                            <td class="p-3 text-center">3</td>
                            <td class="p-3 text-center">2</td>
                            <td class="p-3 text-center">8</td>
                            <td class="p-3 text-center font-bold text-danger">-6</td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center space-x-1">
                                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Légende -->
            <div class="p-4 border-t border-light bg-light/20">
                <div class="flex flex-wrap items-center justify-center gap-4 text-sm">
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                        <span>Victoire</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-gray-500 rounded-full mr-2"></span>
                        <span>Nul</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                        <span>Défaite</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-primary rounded-full mr-2"></span>
                        <span>Qualifié</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-danger rounded-full mr-2"></span>
                        <span>Éliminé</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prochains matchs de la poule -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Titre Section -->
            <div class="bg-light/50 p-4 border-b border-light">
                <h2 class="text-xl font-bold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Prochains matchs - Poule A
                </h2>
            </div>

            <!-- Liste des matchs -->
            <div class="divide-y divide-light">
                <!-- Match 1 -->
                <div class="p-4 hover:bg-light/20 transition duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="text-sm bg-primary/10 text-primary rounded-full px-3 py-1 mr-4">
                                20 Juillet • 16:00
                            </div>
                            <div class="font-medium">Stade Pinchinat</div>
                        </div>
                        <button class="text-primary hover:text-accent transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center justify-center mt-3">
                        <div class="text-center w-1/3">
                            <div class="font-bold">Les Lions</div>
                            <div class="text-xs text-gray-500">1ère place</div>
                        </div>
                        <div class="mx-4 font-bold text-gray-500">VS</div>
                        <div class="text-center w-1/3">
                            <div class="font-bold">Les Aigles</div>
                            <div class="text-xs text-gray-500">3ème place</div>
                        </div>
                    </div>
                </div>

                <!-- Match 2 -->
                <div class="p-4 hover:bg-light/20 transition duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="text-sm bg-primary/10 text-primary rounded-full px-3 py-1 mr-4">
                                21 Juillet • 18:00
                            </div>
                            <div class="font-medium">Stade Municipal</div>
                        </div>
                        <button class="text-primary hover:text-accent transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center justify-center mt-3">
                        <div class="text-center w-1/3">
                            <div class="font-bold">Tigres FC</div>
                            <div class="text-xs text-gray-500">2ème place</div>
                        </div>
                        <div class="mx-4 font-bold text-gray-500">VS</div>
                        <div class="text-center w-1/3">
                            <div class="font-bold">Étoiles FC</div>
                            <div class="text-xs text-gray-500">4ème place</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
