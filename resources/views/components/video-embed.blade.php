@props(['url'])

@php
    $embedUrl = (function ($url) {
        if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
            if (preg_match('/(youtu\.be\/|v=)([^&]+)/', $url, $matches)) {
                return 'https://www.youtube.com/embed/' . $matches[2];
            }
        }

        if (str_contains($url, 'facebook.com')) {
            return 'https://www.facebook.com/plugins/video.php?href=' . urlencode($url) . '&show_text=0&width=560';
        }

        return null;
    })($url);
@endphp

@if ($embedUrl)
    <div class="w-full aspect-video rounded-xl overflow-hidden shadow-md">
        <iframe
            class="w-full h-full"
            src="{{ $embedUrl }}"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen
        ></iframe>
    </div>
@else
    <p class="text-red-600">Lien non supporté.</p>
@endif
