<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'content' => $this->faker->paragraph,
            'news_id' => News::factory(),
            'game_id' => Game::factory(),
        ];
    }
}
