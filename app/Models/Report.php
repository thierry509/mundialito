<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;



    // app/Models/Report.php
    protected $fillable = [
        'comment_id',
        'user_id',
        'reason',
        'status',
        'category' // Ajouter cette ligne
    ];

    // Ajouter les constantes pour les catégories
    const CATEGORIES = [
        'spam' => 'Spam',
        'hate_speech' => 'Discours haineux',
        'inappropriate' => 'Contenu inapproprié',
        'harassment' => 'Harcèlement',
        'other' => 'Autre'
    ];

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? 'Inconnu';
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
