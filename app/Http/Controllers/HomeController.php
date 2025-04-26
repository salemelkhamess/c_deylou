<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Evenement;
use App\Models\Galerie;
use App\Models\Video;

class HomeController extends Controller
{
    public function index()
    {
        $centre = Centre::first();
        $evenements = Evenement::latest()->take(5)->get();
        $galeries = Galerie::latest()->take(3)->get();
        $videos = Video::latest()->take(4)->get();

        return view('fronts.home.home', compact('centre', 'evenements', 'galeries', 'videos'));
    }
}
