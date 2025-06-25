<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChampionshipFactory extends Factory
{
    public function definition()
    {
        return [
            'year' => $this->faker->year,
        ];
    }
}
