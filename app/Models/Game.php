<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time',
        'location',
        'type',
        'stage',
        'status',
        'position',
        'championship_id',
        'team_a_id',
        'team_b_id',
        'team_a_goals',
        'team_b_goals',
        'team_a_yellow_cards',
        'team_b_yellow_cards',
        'team_a_red_cards',
        'team_b_red_cards',
        'shootout_score_a',
        'shootout_score_b',
        'team_a_scorers',
        'team_b_scorers'
    ];

    public function championship()
    {
        return $this->belongsTo(Championship::class);
    }

    public function teamA()
    {
        return $this->belongsTo(Team::class, 'team_a_id');
    }

    public function teamB()
    {
        return $this->belongsTo(Team::class, 'team_b_id');
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id')->with('user', 'replies');
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
