<?php

namespace Database\Seeders;

use App\Models\RankingRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RankingRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            ['code' => 'points', 'label' => 'Points'],
            ['code' => 'diff_buts', 'label' => 'Différence de buts'],
            ['code' => 'buts_marques', 'label' => 'Buts marqués'],
            ['code' => 'confrontation_directe_points', 'label' => 'Points en confrontation directe'],
            ['code' => 'victoires', 'label' => 'Nombre de victoires'],
            ['code' => 'fair_play', 'label' => 'Classement fair-play'],
            ['code' => 'match_appui', 'label' => 'Match d\'appui'],
            ['code' => 'tirage_au_sort', 'label' => 'Tirage au sort'],
        ];

        foreach ($rules as $rule) {
            RankingRule::firstOrCreate(['code' => $rule['code']], $rule);
        }
    }
}
