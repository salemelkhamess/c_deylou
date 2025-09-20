<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moughataa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_fr',
        'nom_ar',
        'nom_en',
        'code',
        'wilaya_id',
        'population'
    ];

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class);
    }

    public function evenements()
    {
        return $this->hasMany(Evenement::class);
    }



    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
