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
        'championship_id',
        'team_a_id',
        'team_b_id',
        'team_a_goals',
        'team_b_goals'
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
        return $this->hasMany(Comment::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
