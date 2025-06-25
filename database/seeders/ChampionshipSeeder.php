<?php

namespace Database\Seeders;

use App\Models\Championship;
use App\Models\RankingRule;
use Illuminate\Database\Seeder;

class ChampionshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $championships = [
            ['year' => 2025, 'knockout_round' => 4],
        ];

        foreach ($championships as $championship) {
            $instance = Championship::create($championship);

            $defaultRules = [
                ['code' => 'points', 'position' => 1],
                ['code' => 'diff_buts', 'position' => 2],
                ['code' => 'buts_marques', 'position' => 3],
            ];

            foreach ($defaultRules as $rule) {
                $rankingRule = RankingRule::where('code', $rule['code'])->first();

                if ($rankingRule) {
                    $instance->rankingRules()->attach($rankingRule->id, [
                        'position' => $rule['position']
                    ]);
                }
            }
        }
    }
}
