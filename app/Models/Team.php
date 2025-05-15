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

    public function group()
    {
        return $this->belongsToMany(Group::class, 'group_participations');
    }

    public function hasAnyRelations(): bool
    {
        return $this->matchesAsTeamA()->exists() ||
            $this->matchesAsTeamB()->exists() ||
            $this->groupParticipations()->exists();
    }
}
