<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Accueil --}}
    <url>
        <loc> {{ route('home') }} </loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- Matchs (exemple avec 2024) --}}
    <url>
        <loc>{{ route('games', ['year' => 2024]) }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>

    {{-- Classement --}}
    <url>
        <loc>{{ route('groups', ['year' => 2024]) }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- Phase à élimination --}}
    <url>
        <loc>{{ route('knockout', ['year' => 2024]) }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>

    {{-- À propos --}}
    <url>
        <loc>{{ route('about') }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>

    {{-- Palmarès --}}
    <url>
        <loc>{{ route('prize-list') }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>

    {{-- actualite --}}
    <url>
        <loc>{{route('news')}}</loc>
        <lastmod>{{ optional($news->first())->updated_at?->toDateString() ?? now()->toDateString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>

    @foreach ($news as $article)
        <url>
            <loc>{{ url('/news/' . $article->slug) }}</loc>
            <lastmod>{{ $article->updated_at->toDateString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

</urlset>
