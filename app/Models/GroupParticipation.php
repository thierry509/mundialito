<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupParticipation extends Model
{
    use HasFactory;

    protected $fillable = ['team_id', 'groupe_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'groupe_id');
    }
}
