<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResultFactory extends Factory
{
    public function definition()
    {
        return [
            'score_team_a' => $this->faker->numberBetween(0, 5),
            'score_team_b' => $this->faker->numberBetween(0, 5),
            'game_id' => Game::factory(),
        ];
    }
}
