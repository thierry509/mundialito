<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
            'date' => $this->faker->date,
            'image_url' => $this->faker->optional()->imageUrl,
            'user_id' => User::factory(),
        ];
    }
}
