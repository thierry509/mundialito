<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Game;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    public function test_comment_can_be_associated_with_game_only()
    {
        $game = Game::factory()->create();

        $comment = Comment::create([
            'name' => 'Game Comment',
            'content' => 'Comment about game',
            'news_id' => null,
            'game_id' => $game->id
        ]);

        // Recharge explicitement avec les relations
        $comment = $comment->fresh(['game']);

        $this->assertNull($comment->news);
        $this->assertNotNull($comment->game, 'Game relation should be loaded');
        $this->assertEquals($game->id, $comment->game->id);
    }

    public function test_comment_can_be_associated_with_both_news_and_game()
    {
        $news = News::factory()->create();
        $game = Game::factory()->create();

        $comment = Comment::create([
            'name' => 'Combined Comment',
            'content' => 'Comment about both',
            'news_id' => $news->id,
            'game_id' => $game->id
        ]);

        $comment->load(['news', 'game']);

        $this->assertNotNull($comment->news, 'News relation should be loaded');
        $this->assertNotNull($comment->game, 'Game relation should be loaded');
        $this->assertEquals($news->id, $comment->news->id);
        $this->assertEquals($game->id, $comment->game->id);
    }

    // public function test_comment_requires_at_least_one_association()
    // {
    //     $this->expectException(\Illuminate\Database\QueryException::class);

    //     try {
    //         Comment::create([
    //             'name' => 'Invalid Comment',
    //             'content' => 'Comment with no associations',
    //             'news_id' => null,
    //             'game_id' => null
    //         ]);
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         $this->assertStringContainsString('constraint failed', $e->getMessage());
    //         throw $e;
    //     }
    // }
}
