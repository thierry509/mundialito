<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company,
            'location' => $this->faker->city,
        ];
    }
}
