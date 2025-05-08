<?php

namespace Database\Factories;

use App\Models\Championship;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    public function definition()
    {
        return [
            'date_time' => $this->faker->dateTimeThisYear,
            'location' => $this->faker->city,
            'type' => $this->faker->randomElement(['amical', 'officiel']),
            'stage' => $this->faker->randomElement(['groupe', 'quart', 'demi', 'finale']),
            'status' => $this->faker->randomElement(['programmé', 'en cours', 'terminé']),
            'championship_id' => Championship::factory(),
            'team_a_id' => Team::factory(),
            'team_b_id' => Team::factory(),
        ];
    }
}
