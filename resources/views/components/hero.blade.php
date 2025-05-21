@props([
    'title',
    'subtitle' => null,
    'gradientFrom' => 'from-primary',
    'gradientTo' => 'to-accent',
    'opacity' => '20',
    'height' => 'py-20 md:py-28 lg:py-36',
    'textColor' => 'text-white',
])

<header class="relative {{ $height }} bg-gradient-to-r {{ $gradientFrom }} {{ $gradientTo }}">
    <div class="absolute inset-0 bg-[url('https://img.freepik.com/photos-gratuite/concept-faire-du-sport_23-2151937746.jpg?ga=GA1.1.90895242.1736884756&semt=ais_hybrid&w=740')] bg-cover bg-center opacity-{{ $opacity }}"
        role="img" aria-label="Image de fond sportive"></div>
    <div class="absolute inset-0 bg-black opacity-30"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto text-center {{ $textColor }}">
            <span class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 block">{{ $title }}</span>
            @if ($subtitle)
                <h1 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-semibold mt-4">{{ $subtitle }}</h1>
            @endif
        </div>
    </div>

    <div class="flex justify-center mt-6 py-3">
        <div class="relative group">
            <!-- Sélecteur avec bordure et coins arrondis -->
            <select
                class="outline-none px-6 py-3 bg-white/5 backdrop-blur-sm text-white text-lg font-medium rounded-lg border-2 border-white/20 focus:border-amber-300 focus:ring-2 focus:ring-amber-300/30 transition-all duration-300 appearance-none pr-12 cursor-pointer hover:border-white/40">
                <option value="" disabled selected class="bg-gray-800">Choisissez une édition</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}" class="bg-gray-800">Mundialito {{ $year }}</option>
                @endforeach
            </select>

            <!-- Icône flèche stylisée -->
            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                <svg class="w-5 h-5 text-white/60 group-hover:text-white/80 transition-colors duration-300"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>
    </div>
</header>

<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        const yearSelect = document.querySelector('select');
        const storageKey = 'year-store';
        try {
            // Récupérer l'année stockée
            const store = sessionStorage.getItem(storageKey);
            const storedYear = JSON.parse(store).year

            console.log(store, storedYear)

            // Vérifier si l'année existe dans les options
            if (storedYear) yearSelect.value = storedYear;


            // Gérer le changement de sélection
            yearSelect.addEventListener('change', function() {
                if (this.value) {
                    sessionStorage.setItem(storageKey, JSON.stringify({
                        year: this.value
                    }));
                    const url = new URL(window.location.href);
                    url.searchParams.set('year', this.value);
                    window.location.href = url.toString();
                }
            });
        } catch (e) {
            console.error('Erreur avec sessionStorage:', e);
        }
    });
</script>
