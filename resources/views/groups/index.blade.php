@extends('layout.app')

@section('content')
    <!-- Hero Section -->
    <x-hero title="Classement des Poules" subtitle="Consultez les statistiques complètes de chaque groupe"
        backgroundImage="/images/stade-classement.jpg" variant="dark" />

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">

        @forelse ($groups as $group)
            <pre>
        </pre>
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-12">
                <!-- Titre Poule -->
                <div class="bg-accent text-white p-4">
                    <h2 class="text-xl font-bold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                        Poule {{ $group->name }} - Classement
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
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-light">
                            @forelse ($group->teams as $team)
                                <tr class="hover:bg-light/30">
                                    <td class="p-3 font-bold text-primary">1</td>
                                    <td class="p-3">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mr-3">
                                                <span class="font-bold text-primary">
                                                    {{ substr($team->name, 0, 2) }}</span>
                                            </div>
                                            <span>{{ $team->name }}</span>
                                        </div>
                                    </td>
                                    <td class="p-3 text-center font-bold">9</td>
                                    <td class="p-3 text-center">0</td>
                                    <td class="p-3 text-center">0</td>
                                    <td class="p-3 text-center">0</td>
                                    <td class="p-3 text-center">0</td>
                                    <td class="p-3 text-center">0</td>
                                    <td class="p-3 text-center">0</td>
                                    <td class="p-3 text-center font-bold text-primary">0</td>
                                </tr>
                            @empty
                            @endforelse


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
        @empty
        @endforelse
        <!-- Classement Poule A -->

    </main>
@endsection
