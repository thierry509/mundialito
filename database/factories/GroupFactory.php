<?php

namespace Database\Factories;

use App\Models\Championship;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->lexify('Groupe ?'),
            'championship_id' => Championship::factory(),
        ];
    }
}
