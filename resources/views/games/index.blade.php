@extends('layout.app')

@section('content')
    <!-- Hero Section avec le composant réutilisable -->
    <x-hero title="Les Matchs" subtitle="Tous les Matchs  Mundialito" backgroundImage="/images/stade-resultats.jpg"
        variant="secondary" />

    <!-- Contenu principal -->
    <main class="px-6 md:px-12 py-12">
        @forelse ($games as $matchDays)
            <div class="max-w-7xl mx-auto space-y-6 my-6">
                <!-- Journée 1 -->
                <div class="bg-primary rounded-lg shadow-lg overflow-hidden px-2">
                    <!-- En-tête de journée -->
                    <div class="py-2">
                        <div class="flex justify-between items-center">
                            <h2 class="text-sm md:text-xl font-semibold text-gray-50">
                                {{ gameStage($matchDays->first()->stage) }}</h2>
                            <span
                                class="text-xs bg-white text-primary font-semibold px-2 py-1 rounded-full">{{ $matchDays->count() }}
                                matchs</span>
                        </div>
                    </div>
                    @foreach ($matchDays as $game)
                        <x-SingleGame :game="$game" />
                    @endforeach
                </div>
            </div>
        @empty
            <x-empty model="match"/>
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
