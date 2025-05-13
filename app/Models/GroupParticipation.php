<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupParticipation extends Model
{
    use HasFactory;

    protected $fillable = ['team_id', 'group_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
