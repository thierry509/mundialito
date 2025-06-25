<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Result;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResultTest extends TestCase
{
    use RefreshDatabase;
    public function test_result_belongs_to_game()
    {
        $game = Game::factory()->create();
        $result = Result::factory()->create(['game_id' => $game->id]);

        $this->assertInstanceOf(Game::class, $result->game);
    }
}
