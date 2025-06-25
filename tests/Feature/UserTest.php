<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_has_many_news()
    {
        $user = User::factory()->create();
        $news = News::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->news->contains($news));
    }

}
