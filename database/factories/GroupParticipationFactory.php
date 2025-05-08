<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupParticipationFactory extends Factory
{
    public function definition()
    {
        return [
            'team_id' => Team::factory(),
            'groupe_id' => Group::factory(),
        ];
    }
}
