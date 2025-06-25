<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankingRule extends Model
{
    protected $fillable = ['code', 'label', 'order'];

    public function championships()
    {
        return $this->belongsToMany(Championship::class)
                    ->withPivot('position')
                    ->withTimestamps();
    }   }
