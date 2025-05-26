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
            ['code' => 'points', 'label' => 'Points', 'order' => 'desc'],
            ['code' => 'goalDifference', 'label' => 'Différence de buts', 'order' => 'desc'],
            ['code' => 'goalsFor', 'label' => 'Buts marqués', 'order' => 'desc'],
            ['code' => 'directConfrontation', 'label' => 'Direct Confrontation', 'order' => 'desc'],
            ['code' => 'wins', 'label' => 'Nombre de victoires', 'order' => 'desc'],
            ['code' => 'fair_play_points', 'label' => 'Classement fair-play', 'order' => 'asc'],
        ];

        foreach ($rules as $rule) {
            RankingRule::firstOrCreate(['code' => $rule['code']], $rule);
        }
    }
}
