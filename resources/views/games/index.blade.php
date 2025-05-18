@extends('layout.app')

@section('content')
    <!-- Hero Section avec le composant réutilisable -->
    <x-hero title="Résultats des Matchs" subtitle="Tous les scores et statistiques du Mundialito 2023"
        backgroundImage="/images/stade-resultats.jpg" variant="secondary" />

    <!-- Contenu principal -->
    <main class="px-6 md:px-12 py-12">
        @forelse ($games as $matchDays)
            <div class="max-w-7xl mx-auto space-y-6 my-6">
                <!-- Journée 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- En-tête de journée -->
                    <div class="bg-secondary px-4 py-2 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h2 class="font-semibold text-gray-50">{{ gameStage($matchDays[0]->first()->stage) }}</h2>
                            <span class="text-xs bg-primary text-white px-2 py-1 rounded-full">{{ $matchDays->count() }}
                                matchs</span>
                        </div>
                    </div>
                        @foreach ($matchDays as $game)
                        <x-SingleGame :game="$game"/>
                        @endforeach
                    </div>
            </div>
        @empty
        @endforelse

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
