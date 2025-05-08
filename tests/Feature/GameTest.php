<?php

namespace Tests\Feature;

use App\Models\Championship;
use App\Models\Game;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;
    public function test_game_relations()
    {
        $championship = Championship::factory()->create();
        $teamA = Team::factory()->create();
        $teamB = Team::factory()->create();
        $game = Game::factory()->create([
            'championship_id' => $championship->id,
            'team_a_id' => $teamA->id,
            'team_b_id' => $teamB->id,
        ]);

        $this->assertInstanceOf(Championship::class, $game->championship);
        $this->assertInstanceOf(Team::class, $game->teamA);
        $this->assertInstanceOf(Team::class, $game->teamB);
    }

}
