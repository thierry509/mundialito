<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            ['name' => 'BELLE SURPRISE Fc', 'location' => 'Gonaïves'],
            ['name' => 'TOP FRIENDS FC', 'location' => 'Gonaïves'],
            ['name' => 'LA TERREUR', 'location' => 'Gonaïves'],
            ['name' => 'OOOCHA', 'location' => 'Gonaïves'],
            ['name' => 'CALCIO', 'location' => 'Gonaïves'],
            ['name' => 'VEDETTE', 'location' => 'Gonaïves'],
            ['name' => 'LA FAMILIA', 'location' => 'Gonaïves'],
            ['name' => 'ANN RELAX', 'location' => 'Gonaïves'],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
