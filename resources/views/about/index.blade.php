@extends('layout.app')

@section('content')
    <!-- Hero Section -->
    <x-hero
        title="À Propos du Mondialito"
        subtitle="Découvrez l'histoire et l'esprit de notre tournoi"
        backgroundImage="/images/about-hero.jpg"
        variant="primary"
    />

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <!-- History Section -->
        <section class="mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                        Notre <span class="text-primary">Histoire</span>
                    </h2>
                    <div class="prose max-w-none text-gray-600">
                        <p class="text-lg leading-relaxed">
                            Le Mondialito des Gonaïves a été créé en 1998 par un groupe de passionnés de football souhaitant offrir à la jeunesse locale un tournoi estival de qualité.
                        </p>
                        <p>
                            Ce qui a commencé comme un petit tournoi entre quartiers est rapidement devenu l'événement sportif le plus attendu de la région. Aujourd'hui, le Mondialito rassemble chaque année les meilleures équipes locales et attire des milliers de spectateurs.
                        </p>
                        <p>
                            À travers les années, le tournoi a gardé son esprit communautaire tout en gagnant en professionnalisme, devenant un véritable tremplin pour les jeunes talents de la région.
                        </p>
                    </div>
                </div>
                <div class="relative group">
                    <div class="absolute -inset-2 bg-gradient-to-r from-primary to-accent rounded-2xl opacity-75 group-hover:opacity-100 blur-lg transition duration-200"></div>
                    <div class="relative h-full rounded-2xl overflow-hidden">
                        <img src="https://img.olympics.com/images/image/private/t_s_16_9_g_auto/t_s_w1460/f_auto/primary/ngdjbafv3twathukjbq2" alt="Première édition du Mondialito" class="w-full h-auto object-cover transition duration-500 group-hover:scale-105">
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="mb-16 py-12 bg-gradient-to-r from-light to-white rounded-3xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                    Nos <span class="text-accent">Valeurs</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mt-4">
                    Le Mondialito est bien plus qu'un simple tournoi de football
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
                <!-- Value 1 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center text-primary mb-4 mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-3">Communauté</h3>
                    <p class="text-gray-600 text-center">
                        Un événement qui rassemble tous les habitants des Gonaïves autour de leur passion commune pour le football.
                    </p>
                </div>

                <!-- Value 2 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center text-secondary mb-4 mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-3">Fair-play</h3>
                    <p class="text-gray-600 text-center">
                        Le respect des adversaires, des arbitres et des règles est au cœur de notre philosophie.
                    </p>
                </div>

                <!-- Value 3 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center text-accent mb-4 mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-3">Développement</h3>
                    <p class="text-gray-600 text-center">
                        Nous croyons au pouvoir du sport pour développer les compétences et le caractère des jeunes.
                    </p>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                    L'<span class="text-primary">Équipe</span> du Mondialito
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mt-4">
                    Une équipe dévouée qui travaille toute l'année pour organiser le tournoi
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Member 1 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="/images/team1.jpg" alt="Jean Dupont" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold">Jean Dupont</h3>
                        <p class="text-primary font-medium">Président</p>
                        <p class="text-gray-600 mt-2">Fondateur du Mondialito en 1998</p>
                    </div>
                </div>

                <!-- Member 2 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="/images/team2.jpg" alt="Marie Legrand" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold">Marie Legrand</h3>
                        <p class="text-primary font-medium">Directrice Sportive</p>
                        <p class="text-gray-600 mt-2">Ancienne joueuse internationale</p>
                    </div>
                </div>

                <!-- Member 3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="/images/team3.jpg" alt="Pierre Martin" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold">Pierre Martin</h3>
                        <p class="text-primary font-medium">Coordinateur</p>
                        <p class="text-gray-600 mt-2">Organisateur depuis 15 ans</p>
                    </div>
                </div>

                <!-- Member 4 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="/images/team4.jpg" alt="Lucie Bernard" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold">Lucie Bernard</h3>
                        <p class="text-primary font-medium">Responsable Communication</p>
                        <p class="text-gray-600 mt-2">Journaliste sportive</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-12 bg-primary rounded-3xl text-white">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Le Mondialito <span class="text-secondary">en Chiffres</span>
                </h2>
                <p class="text-lg max-w-2xl mx-auto">
                    Quelques statistiques qui montrent l'ampleur de l'événement
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 px-4">
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">25+</div>
                    <div class="text-sm uppercase tracking-wider">Éditions</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">24</div>
                    <div class="text-sm uppercase tracking-wider">Équipes</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">5,000+</div>
                    <div class="text-sm uppercase tracking-wider">Spectateurs</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">150+</div>
                    <div class="text-sm uppercase tracking-wider">Bénévoles</div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="mt-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                    Témoignages
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mt-4">
                    Ce que les participants disent du Mondialito
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <img src="/images/testimonial1.jpg" alt="Marc Antoine" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h3 class="font-bold">Marc Antoine</h3>
                            <p class="text-primary text-sm">Capitaine des Aigles</p>
                        </div>
                    </div>
                    <blockquote class="text-gray-600 italic">
                        "Le Mondialito est bien plus qu'un tournoi, c'est une institution. J'y participe depuis 10 ans et l'ambiance est toujours aussi incroyable."
                    </blockquote>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <img src="/images/testimonial2.jpg" alt="Sophie Durand" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h3 class="font-bold">Sophie Durand</h3>
                            <p class="text-primary text-sm">Spectatrice</p>
                        </div>
                    </div>
                    <blockquote class="text-gray-600 italic">
                        "Chaque été, toute ma famille attend avec impatience le Mondialito. C'est l'occasion de se retrouver entre amis autour de notre passion commune."
                    </blockquote>
                </div>
            </div>
        </section>
    </main>
@endsection
