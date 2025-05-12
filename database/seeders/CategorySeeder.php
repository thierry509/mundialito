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
            ['name' => 'Actualités générales'],
            ['name' => 'Résultats en direct'],
            ['name' => 'Classements'],
            ['name' => 'Reportages exclusifs'],
            ['name' => 'Interviews joueurs'],
            ['name' => 'Analyse tactique'],
            ['name' => 'Mercato et transferts'],
            ['name' => 'Blessures et suspensions'],
            ['name' => 'Calendrier des matchs'],
            ['name' => 'Coupe d\'Europe'],
            ['name' => 'Coupe nationale'],
            ['name' => 'Jeunes talents'],
            ['name' => 'Histoire du club'],
            ['name' => 'Opinion éditoriale'],
            ['name' => 'Fantasy Football'],
            ['name' => 'Technologie VAR'],
            ['name' => 'Stades et infrastructures'],
            ['name' => 'Supporters et ambiance'],
            ['name' => 'Féminines'],
            ['name' => 'Parieurs et cotes'],
            ['name' => 'Staff technique'],
            ['name' => 'Arbitrage'],
            ['name' => 'Comparaisons statistiques'],
            ['name' => 'Revue de presse'],
            ['name' => 'Diaporamas photos'],
            ['name' => 'Vidéos exclusives'],
            ['name' => 'Podcasts audio'],
            ['name' => 'Conférences de presse'],
            ['name' => 'Controverses'],
            ['name' => 'Économie du football'],
            ['name' => 'Saison en chiffres'],
        ];

        DB::table('categories')->insert($categories);
    }
}
