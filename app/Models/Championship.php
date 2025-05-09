<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Championship extends Model
{
    use HasFactory;

    protected $fillable = ['year'];

    public function matches()
    {
        return $this->hasMany(Game::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'championship_id');
    }
}
