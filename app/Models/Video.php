<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'titre_ar',
        'titre_en',
        'type',
        'video_path',
        'description',
        'description_ar',
        'description_en',
    ];

}
