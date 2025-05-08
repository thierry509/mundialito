<?php

namespace Tests\Feature;

use App\Models\Log;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogTest extends TestCase
{
    use RefreshDatabase;
    public function test_log_belongs_to_user()
    {
        $user = User::factory()->create();
        $log = Log::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $log->user->id);
    }
}
