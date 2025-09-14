<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'wilaya_id',
        'nombre_participants'
    ];

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class);
    }


}
