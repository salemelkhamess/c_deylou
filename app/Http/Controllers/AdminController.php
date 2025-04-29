<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Evenement;
use App\Models\Galerie;
use App\Models\Video;
use App\Models\Carousel;
use App\Models\SocialLink;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $centres = Centre::all();
        $evenements = Evenement::all();
        $galeries = Galerie::all();
        $videos = Video::all();
        $carousels = Carousel::all();
        $socialLinks = SocialLink::all();
        $users = User::all();

        return view('dashboard', compact(
            'centres', 'evenements', 'galeries', 'videos', 'carousels', 'socialLinks', 'users'
        ));
    }
}
