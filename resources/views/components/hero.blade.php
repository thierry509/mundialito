@props([
    'title',
    'subtitle' => null,
    'gradientFrom' => 'from-primary',
    'gradientTo' => 'to-accent',
    'opacity' => '20',
    'height' => 'py-20 md:py-28 lg:py-36',
    'textColor' => 'text-white'
])

<header class="relative {{ $height }} bg-gradient-to-r {{ $gradientFrom }} {{ $gradientTo }}">
    <div class="absolute inset-0 bg-[url('https://img.freepik.com/photos-gratuite/concept-faire-du-sport_23-2151937746.jpg?ga=GA1.1.90895242.1736884756&semt=ais_hybrid&w=740')] bg-cover bg-center opacity-{{ $opacity }}" role="img" aria-label="Image de fond sportive"></div>
    <div class="absolute inset-0 bg-black opacity-30"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto text-center {{ $textColor }}">
            <span class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 block">{{ $title }}</span>
            @if($subtitle)
                <h1 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-semibold mt-4">{{ $subtitle }}</h1>
            @endif
        </div>
    </div>
</header>
