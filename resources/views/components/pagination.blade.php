@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-12 px-4 py-3 bg-white rounded-lg shadow-sm">
        {{-- Affichage des résultats --}}
        <div class="text-sm text-gray-600">
            Affichage 
            <span class="font-medium text-gray-800">{{ $paginator->firstItem() }}</span>
            à
            <span class="font-medium text-gray-800">{{ $paginator->lastItem() }}</span>
            sur
            <span class="font-medium text-primary">{{ $paginator->total() }}</span>
            résultats
        </div>
        
        {{-- Navigation --}}
        <div class="flex items-center gap-1">
            {{-- Bouton Précédent --}}
            @if ($paginator->onFirstPage())
                <span class="p-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" 
                   class="p-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 border border-gray-200 hover:border-primary hover:text-primary transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            @endif

            {{-- Numéros de page --}}
            <div class="flex items-center gap-1 mx-2">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="px-3 py-1 text-gray-400">...</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-3 py-1 rounded-lg bg-primary text-white font-medium">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" 
                                   class="px-3 py-1 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors duration-200">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Bouton Suivant --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" 
                   class="p-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 border border-gray-200 hover:border-primary hover:text-primary transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @else
                <span class="p-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            @endif
        </div>
    </div>
@endif