<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ViewRanking extends Model
{
    // Nom de la vue SQL
    protected $table = 'view_rankings';

    // Pas de clé primaire auto-incrémentée
    public $incrementing = false;

    // Pas de timestamps
    public $timestamps = false;

    // Si besoin, préciser la clé primaire (optionnel selon tes requêtes)
    protected $primaryKey = null;

    public function teams()
    {
        return $this->belongsTo(Team::class);
    }
}
