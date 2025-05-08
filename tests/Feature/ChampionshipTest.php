<?php

namespace Tests\Feature;

use App\Models\Championship;
use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChampionshipTest extends TestCase
{
    use RefreshDatabase;
    public function test_championship_has_many_games()
    {
        $championship = Championship::factory()->create();
        $game = Game::factory()->create(['championship_id' => $championship->id]);

        // Recharge le modèle avec ses relations
        $championship->load('games');

        $this->assertTrue($championship->games->contains($game));
    }

}
