@extends('layout.app')

@section('content')
    <!-- Hero Section -->
    <x-hero title="Classement des Poules" subtitle="Consultez les statistiques complètes de chaque groupe"
        backgroundImage="/images/stade-classement.jpg" variant="dark" />
    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">

        @forelse ($groups as $group)
            @if ($group->teams->count() > 0)
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
                                                <span>{{ $team->name }}</span>
                                            </div>
                                        </td>
                                        <td class="p-3 text-center font-bold">{{ $team->points ?? 0 }}</td>
                                        <td class="p-3 text-center">{{ $team->played ?? 0 }}</td>
                                        <td class="p-3 text-center">{{ $team->wins ?? 0 }}</td>
                                        <td class="p-3 text-center">{{ $team->draws ?? 0 }}</td>
                                        <td class="p-3 text-center">{{ $team->losses ?? 0 }}</td>
                                        <td class="p-3 text-center">{{ $team->goalsFor ?? 0 }}</td>
                                        <td class="p-3 text-center">{{ $team->goalsAgainst ?? 0 }}</td>
                                        <td
                                            class="p-3 text-center font-bold
                                    @if ($team->goalDifference > 0) text-primary
                                    @elseif($team->goalDifference < 0) text-red-500 @endif">
                                            {{ $team->goalDifference > 0 ? '+' : '' }}{{ $team->goalDifference?? 0 }}
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="px-4 py-6 border-t border-light bg-light/20">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Règles de classement</h3>

                        <ul class="space-y-3">
                            @foreach ($rankingRules as $label => $position)
                                <li class="flex items-start">
                                    <span
                                        class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-primary text-white text-sm font-medium mr-3 flex-shrink-0">
                                        {{ $position }}
                                    </span>
                                    <span class="text-gray-700">{{ ucfirst($label) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        @empty
            <x-empty model="groupe" />
        @endforelse
        <!-- Classement Poule A -->

    </main>
@endsection
