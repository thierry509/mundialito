<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'parent_id'
    ];

    // Polymorphic relation
    public function commentable()
    {
        return $this->morphTo();
    }

    // Auteur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Replies (auto-chargées)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('user', 'replies');
    }

    // Parent
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
