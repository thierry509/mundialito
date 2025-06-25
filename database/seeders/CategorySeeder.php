<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Actualités du championnat'], // fusionne actualités générales, conférences de presse, revue de presse
            ['name' => 'Résultats & Classements'],   // fusionne résultats en direct et classements
            ['name' => 'Interviews & Reportages'],   // fusionne interviews joueurs et reportages exclusifs
            ['name' => 'Analyse & Tactique'],        // fusionne analyse tactique et comparaisons statistiques
            ['name' => 'Blessures & Suspensions'],   // reste pertinent pour les infos d’effectifs
            ['name' => 'Calendrier & Matchs'],       // calendrier des matchs, matchs à venir, etc.
            ['name' => 'Supporters & Ambiance'],     // fusionne supporters, ambiance et stades
            ['name' => 'Polémiques & Arbitrage'],    // fusionne controverses et arbitrage
        ];

        DB::table('categories')->insert($categories);
    }
}
