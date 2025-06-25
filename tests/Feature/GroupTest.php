<?php

namespace Tests\Feature;

use App\Models\Championship;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;
    public function test_group_belongs_to_championship()
    {
        $championship = Championship::factory()->create();
        $group = Group::factory()->create(['championship_id' => $championship->id]);

        $this->assertEquals($championship->id, $group->championship->id);
    }
}
