<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'game_id',
        'team_id',
        'player_name',
        'type',
        'minute',
        'added_time',
        'notes'
    ];

    // Relations (seulement avec game et team)
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
