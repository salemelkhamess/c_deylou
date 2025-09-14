<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_ar',
        'nom_fr',
        'code',
        'population'
    ];

    protected $guarded = [];

    // Ajoutez cette relation
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
