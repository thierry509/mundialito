<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'content', 'news_id', 'game_id', 'created_at'];

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

}

