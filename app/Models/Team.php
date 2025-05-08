<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location'];

    public function matchesAsTeamA()
    {
        return $this->hasMany(Game::class, 'team_a_id');
    }

    public function matchesAsTeamB()
    {
        return $this->hasMany(Game::class, 'team_b_id');
    }

    public function groupParticipations()
    {
        return $this->hasMany(GroupParticipation::class);
    }
}
