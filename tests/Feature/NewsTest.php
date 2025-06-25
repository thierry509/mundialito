<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;
    public function test_news_belongs_to_user()
    {
        $user = User::factory()->create();
        $news = News::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $news->user->id);
    }
}
