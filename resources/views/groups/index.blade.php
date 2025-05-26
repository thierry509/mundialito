@extends('layout.app')

@section('content')
    <!-- Hero Section -->
    <x-hero title="Classement des Poules" subtitle="Consultez les statistiques complètes de chaque groupe"
        backgroundImage="/images/stade-classement.jpg" variant="dark" />

        {{$groups}}
    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">

        @forelse ($groups as $group)
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-12">
                <!-- Titre Poule -->
                <div class="bg-accent text-white p-4">
                    <h2 class="text-xl font-bold flex items-center">
                        Poule {{ $group->name }}
                    </h2>
                    <div class="text-sm opacity-90 mt-1">Mundialito</div>
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
                                    <td class="p-3 font-bold text-primary">{{ $loop->iteration }}</td>
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
                <div class="px-4 py-6 border-t border-light bg-light/20">
                </div>
            </div>
        @empty
            <x-empty model="groupe" />
        @endforelse
        <!-- Classement Poule A -->

    </main>
@endsection
