@extends('layout.app')

@section('content')
    @php
        $prizeList = [
            ['year' => 2005, 'team' => 'Descahos Big FC'],
            ['year' => 2006, 'team' => 'Uranus FC'],
            ['year' => 2007, 'team' => 'Parvencia FC'],
            ['year' => 2008, 'team' => 'La Terreur FC'],
            ['year' => 2009, 'team' => 'Bon Zanmi FC'],
            ['year' => 2010, 'team' => 'Vedette FC'],
            ['year' => 2011, 'team' => 'AS Magnifique'],
            ['year' => 2012, 'team' => 'Top Marc FC'],
            ['year' => 2013, 'team' => 'Top Marc FC'],
            ['year' => 2014, 'team' => 'OOOCHA'],
            ['year' => 2015, 'team' => 'AS Magnifique'],
            ['year' => 2016, 'team' => 'Cosmos FC'],
            ['year' => 2017, 'team' => 'Ti Monnen Pa Ja FC'],
            ['year' => 2018, 'team' => 'Aigle Rouge SC'],
            ['year' => 2019, 'team' => 'Ti Monnen Pa Ja FC'],
            ['year' => 2020, 'team' => 'Non organisé / Covid-19'],
            ['year' => 2021, 'team' => 'Top Marc FC'],
            ['year' => 2022, 'team' => 'LOS TECNICOS'],
            ['year' => 2023, 'team' => 'TOP FRIENDS'],
            ['year' => 2024, 'team' => 'OOOCHA'],

        ];
        $prizeList = array_reverse($prizeList);

    @endphp
    <!-- Hero Section -->
    <x-hero title="Palmarès du Mundialito" subtitle="Revivez chaque édition et découvrez les équipes légendaires"
        backgroundImage="/images/champions-hero.jpg" variant="primary" haveYear="{{ false }}" />
    <section class="py-20 bg-white rounded-3xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-semibold">PALMARÈS
                    RÉCENT</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900">Les derniers <span
                        class="text-primary">vainqueurs</span></h2>
                <p class="text-lg text-gray-600 mt-4 max-w-2xl mx-auto">Retrouvez les équipes championnes depuis 2005,
                    témoins de l'histoire vibrante du tournoi.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Derniers champions -->
                @foreach ($prizeList as $prize)
                    <div class="bg-light/50 border border-light rounded-xl p-6">
                        <h3 class="text-xl font-bold text-primary mb-2">{{ $prize['year'] }}</h3>
                        <p class="text-gray-600">{{ $prize['team'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
