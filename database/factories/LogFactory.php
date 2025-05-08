<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'action' => $this->faker->word,
        ];
    }
}
