<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path', 'title_ar', 'description_ar', 'title_fr', 'description_fr', 'title_en', 'description_en'
    ];

}
