@extends('layout.app')
@section('content')
    <header class="relative overflow-hidden">
        <!-- Conteneur pour l'image de fond -->
        <div class="relative h-[90vh] md:h-screen">
            <!-- Image de fond avec effet de parallaxe -->
            <div
                class="absolute inset-0 bg-[url({{ asset('images/stadium.jpg') }})] bg-cover bg-center bg-no-repeat md:transform md:hover:scale-105 md:transition md:duration-1000 md:ease-[cubic-bezier(0.25,0.1,0.25,1)]">
            </div>

            <!-- Overlay avec dégradé -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-black/50"></div>

            <!-- Contenu superposé -->
            <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-4">
                <div class="flex flex-col justify-center items-center max-w-4xl space-y-6 md:space-y-8 animate-fadeInUp">
                    <!-- Logo -->
                    <div class="transform hover:scale-105 transition duration-500">
                        <x-picture imageName="mundialito.hero" alt="Mundialito Logo" mobilePath="images/mobile/"
                            desktopPath="images/" loading="lazy" class="w-64 md:w-80 h-auto" />
                        {{-- <img class="w-64 md:w-80 h-auto" src="{{ asset('images/mundialito.png') }}" alt="Mundialito Logo"> --}}
                    </div>

                    <!-- Titre accrocheur -->
                    <h1 class="text-2xl md:text-4xl font-bold text-white tracking-tight leading-tight">
                        Une ville une competition !
                    </h1>

                    <!-- Phrase d'accroche -->
                    <p class="text-sm md:text-lg text-white/90 max-w-2xl px-4">
                        Suivez chaque match, chaque émotion du tournoi le plus attendu de l'année.
                    </p>

                    <!-- Boutons CTA -->
                    <div class="flex justify-center gap-4 md:gap-6 pt-2 md:pt-4">
                        <a href="{{ route('games') }}" class="relative group">
                            <button
                                class="relative px-8 py-3 md:px-10 md:py-3.5 bg-white text-gray-900 font-bold rounded-lg hover:bg-transparent hover:text-white transition-all duration-300 border-2 border-white text-sm md:text-base shadow-lg hover:shadow-white/20 active:scale-95">
                                <span class="text-sm relative z-10">Calendrier</span>
                            </button>
                        </a>
                        <a href="{{ route('groups') }}" class="relative group">
                            <button
                                class="relative px-8 py-3 md:px-10 md:py-3.5 bg-transparent text-white font-bold rounded-lg hover:bg-white hover:text-gray-900 transition-all duration-300 border-2 border-white text-sm md:text-base shadow-lg hover:shadow-white/20 active:scale-95">
                                <span class=" text-sm relative z-10">Classements</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu principal moderne -->
    <main class="">


        <!-- Section À propos - Design carte moderne -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative group">
                    <div
                        class="absolute -inset-2 bg-gradient-to-r from-secondary to-accent rounded-2xl opacity-75 group-hover:opacity-100 blur-lg transition duration-200">
                    </div>
                    <div class="relative h-full rounded-2xl overflow-hidden">
                        <x-picture imageName="ambiance-mundialito-gonaives" alt="Ambiance Mundialito aux Gonaives"
                            mobilePath="images/mobile/" desktopPath="images/" loading="lazy"
                            class="w-full h-auto object-cover transition duration-500 group-hover:scale-105" />
                    </div>
                </div>
                <div class="space-y-6">
                    <span
                        class="inline-block px-3 py-1 bg-secondary/10 text-secondary rounded-full text-sm font-semibold">L'ESPRIT</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900">Une ambiance <span
                            class="text-secondary">incomparable</span></h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Dès ses débuts dans le quartier populaire de <strong>Raboteau</strong>, le Mundialito a été bien
                        plus qu’un tournoi : c’est un <strong>événement communautaire</strong> profondément ancré dans la
                        vie sociale des Gonaïves. Chaque match réunit familles, anciens joueurs, commerçants et enfants dans
                        une effervescence colorée où <strong>spiritualité, musique, et traditions locales</strong> se mêlent
                        au football.
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Des tambours du rara aux slogans peints sur les murs, chaque équipe représente un quartier, une
                        histoire, une fierté. Loin d’un simple divertissement, le Mundialito est un moment de
                        <strong>communion populaire</strong>, de <strong>résistance culturelle</strong> et de
                        <strong>revendication identitaire</strong>, où se célèbre l’unité malgré les difficultés. Cet
                        esprit, hérité de <strong>l’engagement de figures locales comme Tisò</strong>, continue de vibrer
                        dans chaque édition.
                    </p>
                </div>

            </div>
        </section>
        <!-- Section Actualités -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 container mx-auto px-4">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">À la Une</h2>
                    <a href="{{ route('news.index') }}" class="text-primary hover:text-accent transition flex items-center">
                        Voir toutes les actualités
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <div class="flex flex-wrap gap-6">
                    @forelse ($inTheNews as $article)
                        <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 flex flex-col h-full 
                                      @if($inTheNews->count() <= 2) flex-grow min-w-[300px] basis-[calc(50%-12px)] @else w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.33%-16px)] @endif">
                            @if ($article->image()->first())
                                <div class="h-48 overflow-hidden">
                                    <img class="w-full h-full object-cover transition duration-300 hover:scale-105"
                                        src="{{ $article->image()->first()->min_url }}" alt="{{ $article->title }}">
                                </div>
                            @endif
                
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex items-center mb-3">
                                    <span class="px-2 py-1 bg-primary/10 text-primary rounded-full text-xs font-semibold">
                                        {{ $article->category->name ?? 'Général' }}
                                    </span>
                                    <span class="ml-auto text-xs text-gray-500">
                                        {{ $article->created_at->diffForHumans() }}
                                    </span>
                                </div>
                
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $article->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                
                                <div class="mt-auto flex items-center justify-between gap-2">
                                    <div class="flex items-center min-w-0">
                                        @if ($article->user->image()->first())
                                            <img class="w-8 h-8 rounded-full mr-2 flex-shrink-0"
                                                src="{{ $article->user->image()->first()->min_url }}"
                                                alt="{{ $article->user->full_name }}">
                                        @endif
                                        <span class="text-sm font-medium truncate">
                                            Par {{ $article->user->first_name }}
                                        </span>
                                    </div>
                                    <a href="{{ route('news.show', $article->slug) }}"
                                        class="text-primary hover:text-accent transition flex items-center text-sm font-medium whitespace-nowrap">
                                        Lire
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="w-full">
                            <x-empty model="actualités" />
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="py-20 bg-gray-50 rounded-3xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mx-auto text-center space-y-8">
                <span
                    class="border inline-block px-3 py-1 bg-accent/10 text-accent rounded-full text-sm font-semibold">HISTOIRE</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900">Une histoire <span class="text-accent">riche en
                        émotions</span></h2>
                <p class="text-lg text-gray-600 leading-relaxed ">
                    Né en <strong>1966</strong> dans le quartier populaire de <strong>Raboteau</strong> aux Gonaïves, le
                    championnat de football d’été – aujourd’hui connu sous le nom de <strong>Mundialito</strong> – a été
                    fondé par <strong>Mme Antoinette Jean Louis dite Tisò</strong>. D’abord appelé <em>Coupe Jacky Ti
                        Sò</em>, en hommage à son fils décédé, ce tournoi visait à offrir à la jeunesse défavorisée un
                    espace de jeu, de mémoire et de solidarité.
                </p>
                <p class="text-lg text-gray-600 leading-relaxed ">
                    Ce tournoi, destiné aux jeunes de moins de 13 ans (<strong>U-13</strong>), est rapidement devenu un
                    rituel social incontournable, alliant football, culture populaire et résistance urbaine. Il a permis de
                    sauver le <strong>terrain de Rénovation</strong> d’une démolition prévue, en l’élevant au rang de
                    symbole communautaire.
                </p>
                <p class="text-lg text-gray-600 leading-relaxed ">
                    Inspiré par la ferveur populaire autour du <em>Mundialito</em> organisé en Espagne en 1981 et la
                    <strong>Coupe du Monde 1982</strong>, le championnat adopte le nom <strong>Mundialito</strong> aux
                    Gonaïves. L'événement connaît une ascension fulgurante grâce à la couverture de journalistes comme
                    <strong>Belfond Pierre</strong> (Radio Lumière) et <strong>Claude Valbrun</strong> (Radio Soleil),
                    devenant ainsi une institution sportive d’envergure nationale.
                </p>
                <p class="text-sm italic text-gray-500 ">
                    Ce texte est inspiré du livre <strong>« Le football aux Gonaïves à travers le temps »</strong> de
                    <strong>Joanes Clairzius</strong>.
                </p>
            </div>
        </section>

        <!-- Section Classement & Résultats -->
        <section class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12">
                @if ($lastGame)
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Dernière affiche</h2>
                        <div
                            class="bg-gradient-to-r from-primary to-accent rounded-2xl shadow-lg overflow-hidden text-white">
                            <div class="p-6 text-center">
                                <div class="text-lg font-semibold mb-2">{{ gameStage($lastGame->stage) }}</div>
                                <div class="text-sm bg-white/20 rounded-full px-4 py-1 inline-block mb-6">
                                    {{ formatDate($lastGame->date_time) }}</div>

                                <div class="flex justify-around items-center">
                                    <div class="text-center">
                                        <div
                                            class="w-16 h-16 bg-white rounded-full mx-auto mb-3 flex items-center justify-center text-gray-900 font-bold text-xl">
                                            {{ substr($lastGame->TeamA()->first()->name, 0, 2) }}</div>
                                        <div class="text-xl font-bold">{{ $lastGame->TeamA()->first()->name }}</div>
                                    </div>

                                    <div class="mx-4">
                                        <div class="flex items-center">
                                            <span
                                                class="h-8 rounded-md text-center flex items-center justify-center text-2xl font-bold transition-all">
                                                @if ($lastGame->shootout_score_a !== null)
                                                    <span class="mx-2 text-sm">({{ $lastGame->shootout_score_a }})</span>
                                                @endif
                                                {{ $lastGame->team_a_goals }}
                                            </span>
                                            <span class="text-2xl font-medium px-1">-</span>
                                            <span
                                                class="h-8 rounded-md text-center flex items-center justify-center text-2xl font-bold transition-all">
                                                {{ $lastGame->team_b_goals }}
                                                @if ($lastGame->shootout_score_b !== null)
                                                    <span class="mx-2 text-sm">({{ $lastGame->shootout_score_b }})</span>
                                                @endif
                                            </span>

                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <div
                                            class="w-16 h-16 bg-white rounded-full mx-auto mb-3 flex items-center justify-center text-gray-900 font-bold text-xl">
                                            {{ substr($lastGame->TeamB()->first()->name, 0, 2) }}</div>
                                        <div class="text-xl font-bold">{{ $lastGame->TeamB()->first()->name }}</div>
                                    </div>
                                </div>

                                <div class="mt-8 pt-4 border-t border-white/20">
                                    <div class="flex justify-center space-x-4">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="text-sm">{{ $lastGame->location }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <x-empty message="Aucun match n'a été encore joué" />
                @endif
                @if ($nextGame)
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Prochaine affiche</h2>
                        <div
                            class="bg-gradient-to-r from-primary to-accent rounded-2xl shadow-lg overflow-hidden text-white">
                            <div class="p-6 text-center">
                                <div class="text-lg font-semibold mb-2">{{ gameStage($nextGame->stage) }}</div>
                                <div class="text-sm bg-white/20 rounded-full px-4 py-1 inline-block mb-6">
                                    {{ formatDate($nextGame->date_time) }}</div>

                                <div class="flex justify-around items-center">
                                    <div class="text-center">
                                        <div
                                            class="w-16 h-16 bg-white rounded-full mx-auto mb-3 flex items-center justify-center text-gray-900 font-bold text-xl">
                                            {{ substr($nextGame->TeamA()->first()->name, 0, 2) }}</div>
                                        <div class="text-xl font-bold">{{ $nextGame->TeamA()->first()->name }}</div>
                                    </div>

                                    <div class="mx-4">
                                        <div class="text-2xl font-bold bg-white/20 rounded-full px-4 py-2">VS</div>
                                    </div>

                                    <div class="text-center">
                                        <div
                                            class="w-16 h-16 bg-white rounded-full mx-auto mb-3 flex items-center justify-center text-gray-900 font-bold text-xl">
                                            {{ substr($nextGame->TeamB()->first()->name, 0, 2) }}</div>
                                        <div class="text-xl font-bold">{{ $nextGame->TeamB()->first()->name }}</div>
                                    </div>
                                </div>

                                <div class="mt-8 pt-4 border-t border-white/20">
                                    <div class="flex justify-center space-x-4">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="text-sm">{{ $nextGame->location }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <x-empty message="Aucune match n'est programmé pour le futur" />
                @endif
            </div>
        </section>

        <section class="py-20 bg-white rounded-3xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <span
                        class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-semibold">PALMARÈS
                        RÉCENT</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900">Les derniers <span
                            class="text-primary">vainqueurs</span></h2>
                    <p class="text-lg text-gray-600 mt-4 max-w-2xl mx-auto">Retour sur les trois équipes qui ont dominé le
                        Mundialito lors des dernières éditions du tournoi.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Derniers champions -->
                    <div class="bg-light/50 border border-light rounded-xl p-6">
                        <h3 class="text-xl font-bold text-primary mb-2">LOS TECNICOS</h3>
                        <p class="text-gray-600">Champions 2022</p>
                    </div>
                    <div class="bg-light/50 border border-light rounded-xl p-6">
                        <h3 class="text-xl font-bold text-secondary mb-2">TOP FRIENDS</h3>
                        <p class="text-gray-600">Champions 2023</p>
                    </div>
                    <div class="bg-light/50 border border-light rounded-xl p-6">
                        <h3 class="text-xl font-bold text-accent mb-2">OOOCHA</h3>
                        <p class="text-gray-600">Champions 2024</p>
                    </div>
                </div>
            </div>
        </section>



    </main>
@endsection

@push('styles')
    <style>
        /* Animation personnalisée */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 1s ease-out;
        }

        /* Effet de parallaxe */
        @media (min-width: 1024px) {
            .bg-parallax {
                background-attachment: fixed;
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 1s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
