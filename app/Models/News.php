<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'excerpt', 'slug', 'date', 'image_id', 'user_id', 'category_id', 'video_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'new_id');
    }

    public function image(){
        return $this->belongsTo(Images::class, 'image_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

