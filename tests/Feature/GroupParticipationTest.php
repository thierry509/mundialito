<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\GroupParticipation;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupParticipationTest extends TestCase
{
    use RefreshDatabase;
    public function test_group_participation_links_team_and_group()
    {
        $group = Group::factory()->create();
        $team = Team::factory()->create();
        $gp = GroupParticipation::factory()->create([
            'team_id' => $team->id,
            'groupe_id' => $group->id
        ]);

        $this->assertEquals($team->id, $gp->team->id);
        $this->assertEquals($group->id, $gp->group->id);
    }
}
