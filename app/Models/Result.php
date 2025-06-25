<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['score_team_a', 'score_team_b', 'match_id'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}

