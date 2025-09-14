<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'titre_ar',
        'titre_en',
        'description',
        'description_ar',
        'description_en',
        'date_evenement',
        'image',
        'moughataa_id'
    ];

    protected $casts = [
        'date_evenement' => 'date',
    ];

    public function moughataa()
    {
        return $this->belongsTo(Moughataa::class);
    }
}
