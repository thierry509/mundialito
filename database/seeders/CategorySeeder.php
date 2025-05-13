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
            ['name' => 'Blessures et suspensions'],
            ['name' => 'Calendrier des matchs'],
            ['name' => 'Jeunes talents'],
            ['name' => 'Histoire de club'],
            ['name' => 'Opinion éditoriale'],
            ['name' => 'Stades et infrastructures'],
            ['name' => 'Supporters et ambiance'],
            ['name' => 'Staff technique'],
            ['name' => 'Arbitrage'],
            ['name' => 'Comparaisons statistiques'],
            ['name' => 'Revue de presse'],
            ['name' => 'Conférences de presse'],
            ['name' => 'Controverses'],
            ['name' => 'Économie du football'],
        ];

        DB::table('categories')->insert($categories);
    }
}
