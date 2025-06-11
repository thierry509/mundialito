@extends('layout.app')

@section('content')
    <!-- Hero Section -->
    <x-hero title="Actualités & Annonces" subtitle="Toute l'actualité du Mundialito 2023"
        backgroundImage="/images/stade-actualites.jpg" haveYear="{{ false }}" variant="accent" />

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Colonne principale -->
            <div class="lg:col-span-2">
                <!-- Articles -->
                <div class="space-y-8">
                    @forelse ($news as $article)
                        <!-- Article -->
                        <article
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                            <div class="md:flex">
                                @if ($article->image()->first())
                                    <div class="md:flex-shrink-0 md:w-1/3">
                                        <img class="h-full w-full object-cover" src="{{ $article->image()->first()->min_url }}"
                                            alt="{{ $article->title }}">
                                    </div>
                                @endif
                                <div class="p-6">
                                    <div class="flex items-center mb-2">
                                        <span
                                            class="px-3 py-1 bg-primary/10 text-primary rounded-full text-xs font-semibold">
                                            {{ $article->category->name ?? 'Non catégorisé' }}
                                        </span>
                                        <span class="ml-2 text-sm text-gray-500">
                                            {{ $article->created_at->diffForHumans()}}
                                        </span>
                                    </div>
                                    <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $article->title }}</h2>
                                    <p class="text-gray-600 mb-4">{{ $article->excerpt }}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            @if ($article->user->image()->first())
                                                <img class="w-8 h-8 rounded-full mr-2"
                                                    src="{{ $article->user->image()->first()->min_url }}"
                                                    alt="{{ $article->user->full_name }}">
                                            @endif
                                            <span class="text-sm font-medium">
                                                {{ $article->user->first_name }} {{ $article->user->last_name }}
                                            </span>
                                        </div>
                                        <a href="{{ route('news.show', $article->slug) }}"
                                            class="text-primary font-medium hover:text-accent transition duration-200">
                                            Lire la suite →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <x-empty model="actualités" />
                    @endforelse
                    {{ $news->links('components.pagination') }}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Dernières annonces -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-accent mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Dernières annonces
                    </h3>
                    <ul class="space-y-4">
                        @forelse ($topNews as $topArticle)
                            <li class="border-b border-light pb-4 last:border-0 last:pb-0">
                                <a href="{{ route('news.show', $topArticle->slug) }}" class="group">
                                    <div class="text-sm text-gray-500 mb-1">
                                        {{ $topArticle->created_at->diffForHumans() }}
                                    </div>
                                    <h4 class="font-medium group-hover:text-primary transition duration-200">
                                        {{ $topArticle->title }}
                                    </h4>
                                </a>
                            </li>
                        @empty
                            <li class="text-gray-500 text-sm">Aucune annonce récente</li>
                        @endforelse
                    </ul>
                </div>

                <!-- À ne pas manquer -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-secondary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                        À ne pas manquer
                    </h3>
                    <div class="space-y-4">
                        @foreach ($topNews as $featured)
                            <article class="flex gap-4">
                                @if ($featured->image()->first())
                                    <img class="w-20 h-20 rounded-lg object-cover flex-shrink-0"
                                        src="{{ $featured->image()->first()->min_url }}" alt="{{ $featured->title }}">
                                @endif
                                <div>
                                    <div class="text-xs text-gray-500 mb-1">
                                        {{ $featured->created_at->diffForHumans() }}
                                    </div>
                                    <h4 class="font-medium hover:text-primary transition duration-200">
                                        <a href="{{ route('news.show', $featured->slug) }}">
                                            {{ Str::limit($featured->title, 50) }}
                                        </a>
                                    </h4>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
