<?php

namespace Database\Seeders;

use App\Models\Championship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChampionshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $championships = [
            ['year' => 2022, 'knockout_round' => 2],
            ['year' => 2023, 'knockout_round' => 3],
            ['year' => 2024, 'knockout_round' => 4],
        ];

        foreach ($championships as $championship) {
            Championship::create($championship);
        }    }
}
