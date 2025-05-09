@extends('app')

@section('content')
    <style>
        .bracket-connector {
            position: relative;
        }
        .bracket-connector::after, .bracket-connector::before {
            content: '';
            position: absolute;
            background-color: #e5e7eb;
        }
        .bracket-connector::after {
            background: #e70000;
            width: 20px;
            height: 2px;
            top: 50%;
            right: -20px;
        }
        .bracket-connector::before {
            background: #3700ff;
            width: 20px;
            height: 2px;
            top: 50%;
            left: -3200px;
        }
        .bracket-connector.last-in-group::before {
            /* height: 50%; */
        }
        .bracket-connector.first-in-group::before {
            height: calc(50% + 20px);
            top: 0;
        }
        .bracket-connector.single-connector::before {
            height: 0;
        }
    </style>

    <!-- Hero Section -->
    <x-hero
        title="Phase à Élimination Directe"
        subtitle="Suivez le parcours des équipes vers la finale"
        backgroundImage="/images/stade-knockout.jpg"
        variant="primary"
    />

    <!-- Bracket Section -->
    <main class="container mx-auto px-4 py-12 flex flex-col items-center ">
        <div class="flex gap-4 md:gap-8 pb-8">
            <!-- Huitièmes de finale -->
            <div class="flex flex-col gap-6 min-w-max">
                <h2 class="text-xl font-bold text-center mb-4 bg-accent text-white py-2 px-4 rounded-lg">Quarts de finale</h2>

                <!-- Match 1 -->
                <div class="bracket-connector">
                    <div class="bg-white rounded-lg shadow-lg p-4 w-64 border-l-4 border-primary">
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-primary">L</span>
                                </div>
                                <span class="font-medium">Les Lions</span>
                            </div>
                            <span class="font-bold bg-primary text-white px-2 rounded">3</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-secondary/10 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-secondary">T</span>
                                </div>
                                <span class="font-medium">Tigres FC</span>
                            </div>
                            <span class="font-bold bg-gray-100 px-2 rounded">1</span>
                        </div>
                    </div>
                </div>

                <!-- Match 2 -->
                <div class="bracket-connector">
                    <div class="bg-white rounded-lg shadow-lg p-4 w-64 border-l-4 border-primary">
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-accent/10 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-accent">A</span>
                                </div>
                                <span class="font-medium">Les Aigles</span>
                            </div>
                            <span class="font-bold bg-primary text-white px-2 rounded">2</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-gray-600">E</span>
                                </div>
                                <span class="font-medium">Étoiles FC</span>
                            </div>
                            <span class="font-bold bg-gray-100 px-2 rounded">1</span>
                        </div>
                    </div>
                </div>

                <!-- Match 3 -->
                <div class="bracket-connector first-in-group">
                    <div class="bg-white rounded-lg shadow-lg p-4 w-64 border-l-4 border-primary">
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-primary">P</span>
                                </div>
                                <span class="font-medium">Panthères</span>
                            </div>
                            <span class="font-bold bg-primary text-white px-2 rounded">1</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-secondary/10 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-secondary">C</span>
                                </div>
                                <span class="font-medium">Chevaliers</span>
                            </div>
                            <span class="font-bold bg-gray-100 px-2 rounded">1</span>
                        </div>
                    </div>
                </div>

                <!-- Match 4 -->
                <div class="bracket-connector last-in-group">
                    <div class="bg-white rounded-lg shadow-lg p-4 w-64 border-l-4 border-primary">
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-accent/10 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-accent">F</span>
                                </div>
                                <span class="font-medium">Faucons</span>
                            </div>
                            <span class="font-bold bg-primary text-white px-2 rounded">4</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-gray-600">S</span>
                                </div>
                                <span class="font-medium">Sagittaires</span>
                            </div>
                            <span class="font-bold bg-gray-100 px-2 rounded">1</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quarts de finale -->
            <div class="flex flex-col gap-16 pt-12 min-w-max">
                <h2 class="text-xl font-bold text-center mb-4 bg-accent text-white py-2 px-4 rounded-lg">Demi-finales</h2>

                <!-- Match 1 -->
                <div class="bracket-connector">
                    <div class="bg-white rounded-lg shadow-lg p-4 w-64 border-l-4 border-primary">
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-primary">L</span>
                                </div>
                                <span class="font-medium">Les Lions</span>
                            </div>
                            <span class="font-bold bg-primary text-white px-2 rounded">1</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-accent/10 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-accent">A</span>
                                </div>
                                <span class="font-medium">Les Aigles</span>
                            </div>
                            <span class="font-bold bg-gray-100 px-2 rounded">2</span>
                        </div>
                    </div>
                </div>

                <!-- Match 2 -->
                <div class="bracket-connector last-in-group">
                    <div class="bg-white rounded-lg shadow-lg p-4 w-64 border-l-4 border-primary">
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-secondary/10 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-secondary">C</span>
                                </div>
                                <span class="font-medium">Chevaliers</span>
                            </div>
                            <span class="font-bold bg-primary text-white px-2 rounded">1</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-accent/10 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-accent">F</span>
                                </div>
                                <span class="font-medium">Faucons</span>
                            </div>
                            <span class="font-bold bg-gray-100 px-2 rounded">1</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Demi-finales -->
            <div class="flex flex-col gap-32 pt-24 min-w-max">
                <h2 class="text-xl font-bold text-center mb-4 bg-accent text-white py-2 px-4 rounded-lg">Finale</h2>

                <!-- Match 1 -->
                <div class="bracket-connector single-connector">
                    <div class="bg-white rounded-lg shadow-lg p-4 w-64 border-l-4 border-primary">
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-accent/10 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-accent">A</span>
                                </div>
                                <span class="font-medium">Les Aigles</span>
                            </div>
                            <span class="font-bold bg-primary text-white px-2 rounded">3</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-accent/10 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-accent">F</span>
                                </div>
                                <span class="font-medium">Faucons</span>
                            </div>
                            <span class="font-bold bg-gray-100 px-2 rounded">0</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Finale -->
            {{-- <div class="flex flex-col gap-64 pt-36 min-w-max">
                <h2 class="text-xl font-bold text-center mb-4 bg-accent text-white py-2 px-4 rounded-lg">Finale</h2>

                <!-- Vainqueur -->
                <div class="bg-gradient-to-r from-secondary to-yellow-300 text-gray-900 rounded-lg shadow-lg p-4 w-64 border-l-4 border-secondary font-bold text-center">
                    <div class="flex items-center justify-center gap-2">
                        <div class="w-6 h-6 bg-white/80 rounded-full flex items-center justify-center">
                            <span class="text-xs">A</span>
                        </div>
                        <span>Les Aigles Champions</span>
                    </div>
                </div>
            </div> --}}
        </div>

        <!-- Légende -->
        <div class="mt-8 bg-white rounded-lg shadow p-4 max-w-2xl mx-auto">
            <h3 class="font-bold text-lg mb-2 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Légende
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-primary rounded-full"></div>
                    <span>Équipe victorieuse</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-gray-100 rounded-full border border-gray-300"></div>
                    <span>Équipe éliminée</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-secondary rounded-full"></div>
                    <span>Champion</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 border-2 border-primary rounded-full"></div>
                    <span>Match en cours</span>
                </div>
            </div>
        </div>
    </main>
@endsection
