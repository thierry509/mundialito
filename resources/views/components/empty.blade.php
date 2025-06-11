@props([
    'model' => 'donnée',
    'message' => null,
])
<div class="w-full flex justify-center items-center">
    <div class="text-center max-w-md px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-primary/10 mb-6">
            <svg class="h-12 w-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
        </div>
        @if ($message)
        <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $message }}</h2>
        @elseif ($model)
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Aucune {{ $model }} disponible</h2>
            <p class="text-gray-600 mb-6">Vous n'avez {{ $model }} élément pour le moment.</p>
        @endif
    </div>
</div>
