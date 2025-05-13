<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'championship_id'];

    public function championship()
    {
        return $this->belongsTo(Championship::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'group_participations');
    }
}

