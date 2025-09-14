<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dirigeant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'prenom', 'date_naissance', 'email',
        'telephone', 'adresse', 'photo'
    ];

    protected $casts = [
        'date_naissance' => 'date', // Cela convertira automatiquement la chaîne en objet Carbon
        // ... autres casts
    ];

    public function diplomes()
    {
        return $this->hasMany(Diplome::class);
    }

    public function competences()
    {
        return $this->hasMany(Competence::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
}
