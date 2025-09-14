<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $fillable = ['dirigeant_id', 'nom', 'niveau'];

    public function dirigeant()
    {
        return $this->belongsTo(Dirigeant::class);
    }
}
