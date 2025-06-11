@props([
    'imageName',
    'alt' => '', // Texte alternatif obligatoire
    'mobilePath' => 'images/mobile/', // Dossier mobile
    'desktopPath' => 'images/', // Dossier desktop
    'loading' => 'lazy', // lazy ou eager
    'class' => '', // Classes CSS supplémentaires
])

@php
    $hasMobileWebP = Storage::exists("public/{$mobilePath}{$imageName}.webp");
    $hasMobileJpg = Storage::exists("public/{$mobilePath}{$imageName}.jpg");
    $hasDesktopWebP = Storage::exists("public/{$desktopPath}{$imageName}.webp");
@endphp

<picture>
    <!-- Mobile -->
    @if($hasMobileWebP)
        <source media="(max-width: 600px)" srcset="{{ asset("{$mobilePath}{$imageName}.webp") }}" type="image/webp">
    @endif
    @if($hasMobileJpg)
        <source media="(max-width: 600px)" srcset="{{ asset("{$mobilePath}{$imageName}.jpg") }}" type="image/jpeg">
    @endif

    <!-- Desktop -->
    @if($hasDesktopWebP)
        <source srcset="{{ asset("{$desktopPath}{$imageName}.webp") }}" type="image/webp">
    @endif

    <!-- Fallback (toujours chargé) -->
    <img
        src="{{ asset("{$desktopPath}{$imageName}.jpg") }}"
        alt="{{ $alt }}"
        loading="{{ $loading }}"
        class="{{ $class }}"
        width="100%"
        height="auto"
    >
</picture>
