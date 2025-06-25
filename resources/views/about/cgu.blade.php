@extends('layout.app')

@section('content')
    <x-hero title="Conditions d'utilisation" subtitle="Lisez attentivement nos conditions d'utilisation avant de participer"
        backgroundImage="/images/terms-hero.jpg" variant="primary" haveYear="{{ false }}" />
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-primary mb-4">Conditions d'utilisation</h1>
        <p class="text-gray-600">Dernière mise à jour : {{ date('d/m/Y') }}</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 p-6 md:p-8">
        <!-- Article 1 -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold text-primary mb-4 flex items-center">
                <span class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">1</span>
                Acceptation des conditions
            </h2>
            <div class="prose text-gray-600">
                <p>En accédant et utilisant le site web du <strong>Mundialito des Gonaïves</strong>, vous acceptez sans réserve les présentes conditions d'utilisation. Ces conditions s'appliquent à tous les visiteurs, participants, et contributeurs.</p>
            </div>
        </section>

        <!-- Article 2 -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold text-primary mb-4 flex items-center">
                <span class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">2</span>
                Utilisation du site
            </h2>
            <div class="prose text-gray-600">
                <p><strong>2.1</strong> Le site a pour objectif de fournir des informations sur le tournoi de football "Mundialito" organisé aux Gonaïves, incluant mais ne se limitant pas à :</p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>Calendriers des matchs</li>
                    <li>Résultats en direct</li>
                    <li>Actualités du tournoi</li>
                    <li>Historique des éditions</li>
                </ul>

                <p class="mt-4"><strong>2.2</strong> Vous vous engagez à ne pas :</p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>Utiliser le site à des fins illégales</li>
                    <li>Publier de contenu diffamatoire ou injurieux</li>
                    <li>Perturber délibérément les services</li>
                    <li>Tenter d'accéder à des données non publiques</li>
                </ul>
            </div>
        </section>

        <!-- Article 3 -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold text-primary mb-4 flex items-center">
                <span class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">3</span>
                Comptes utilisateurs
            </h2>
            <div class="prose text-gray-600">
                <p><strong>3.1</strong> Certaines fonctionnalités peuvent nécessiter la création d'un compte. Vous devez fournir des informations exactes et maintenir la confidentialité de vos identifiants.</p>

                <p><strong>3.2</strong> Le comité organisateur se réserve le droit de suspendre ou supprimer tout compte en cas de violation des règles du tournoi ou de ces conditions.</p>
            </div>
        </section>

        <!-- Article 4 -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold text-primary mb-4 flex items-center">
                <span class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">4</span>
                Propriété intellectuelle
            </h2>
            <div class="prose text-gray-600">
                <p><strong>4.1</strong> Tout le contenu du site (textes, images, logos, vidéos) est la propriété exclusive du Comité Organisateur du Mundialito ou de ses partenaires.</p>

                <p><strong>4.2</strong> Les reproductions sans autorisation écrite sont strictement interdites, excepté pour :</p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>Usage privé</li>
                    <li>Citations courtes avec mention de la source</li>
                    <li>Partage via les boutons de réseaux sociaux intégrés</li>
                </ul>
            </div>
        </section>

        <!-- Article 5 -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold text-primary mb-4 flex items-center">
                <span class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">5</span>
                Responsabilités
            </h2>
            <div class="prose text-gray-600">
                <p><strong>5.1</strong> Le comité organisateur s'efforce de maintenir des informations exactes mais ne garantit pas l'exhaustivité ou l'actualité permanente des données.</p>

                <p><strong>5.2</strong> Les utilisateurs publient du contenu sous leur seule responsabilité. Le comité se réserve le droit de modérer a posteriori.</p>

                <p><strong>5.3</strong> En cas de force majeure (intempéries, problèmes techniques), l'organisation décline toute responsabilité concernant :</p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>Report ou annulation de matchs</li>
                    <li>Indisponibilité temporaire du site</li>
                    <li>Erreurs dans les résultats affichés</li>
                </ul>
            </div>
        </section>

        <!-- Article 6 -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold text-primary mb-4 flex items-center">
                <span class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">6</span>
                Modifications
            </h2>
            <div class="prose text-gray-600">
                <p>Ces conditions peuvent être mises à jour à tout moment. La version en ligne fera toujours foi. Nous vous encourageons à les consulter régulièrement.</p>
            </div>
        </section>

        <!-- Article 7 -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold text-primary mb-4 flex items-center">
                <span class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">7</span>
                Contact
            </h2>
            <div class="prose text-gray-600">
                <p>Pour toute question concernant ces conditions :</p>
                <ul class="list-none pl-0 space-y-2">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-primary mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>contact@mundialitogonaives.com</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-primary mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>+509 36 00 0000</span>
                    </li>
                </ul>
            </div>
        </section>

        <div class="mt-8 p-4 bg-light rounded-lg border-l-4 border-primary">
            <p class="font-medium text-gray-700">En continuant à utiliser ce site, vous reconnaissez avoir lu, compris et accepté l'intégralité de ces conditions d'utilisation.</p>
        </div>
    </div>
@endsection
