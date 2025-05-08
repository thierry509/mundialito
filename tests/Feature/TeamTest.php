<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    public function test_team_can_be_created()
    {
        $team = Team::create(['name' => 'Équipe A', 'location' => 'Paris']);
        $this->assertDatabaseHas('teams', ['name' => 'Équipe A']);
    }

}
