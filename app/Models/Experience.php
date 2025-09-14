<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'dirigeant_id', 'poste', 'entreprise',
        'date_debut', 'date_fin', 'description'
    ];

    protected $casts = [
        'date_debut' => 'date', // Cela convertira automatiquement la chaîne en objet Carbon
        'date_fin' => 'date', // Cela convertira automatiquement la chaîne en objet Carbon
    ];

    protected $dates = ['date_debut', 'date_fin'];

    public function dirigeant()
    {
        return $this->belongsTo(Dirigeant::class);
    }
}
