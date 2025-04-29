<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'adresse',
        'email',
        'telephone',
        'nom_ar',
        'description_ar',
        'adresse_ar',
        'nom_en',         // Ajouté pour l'anglais
        'description_en', // Ajouté pour l'anglais
        'adresse_en',     // Ajouté pour l'anglais
        'logo',
    ];

}
