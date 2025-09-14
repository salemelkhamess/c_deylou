<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    use HasFactory;

    protected $fillable = [
        'dirigeant_id', 'titre', 'etablissement',
        'annee_obtention', 'fichier'
    ];

    public function dirigeant()
    {
        return $this->belongsTo(Dirigeant::class);
    }
}
