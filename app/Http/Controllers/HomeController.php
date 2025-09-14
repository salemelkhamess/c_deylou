<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Evenement;
use App\Models\Galerie;
use App\Models\Question;
use App\Models\Video;
use App\Models\Wilaya;
use App\Models\Moughataa;
use App\Models\Participant;

class HomeController extends Controller
{
    public function index()
    {
        $centre = Centre::first();
        $evenements = Evenement::latest()->take(5)->get();
        $galeries = Galerie::latest()->take(3)->get();
        $videos = Video::latest()->take(4)->get();

        // Récupérer les wilayas avec leurs participants
        $wilayas = Wilaya::withCount(['participants as total_participants' => function($query) {
            $query->select(\DB::raw('sum(nombre_participants)'));
        }])
            ->orderBy('code')
            ->get()
            ->map(function($wilaya) {
                return [
                    'id' => $wilaya->id,
                    'nom' => app()->getLocale() == 'ar' ? $wilaya->nom_ar : $wilaya->nom_fr,
                    'code' => $wilaya->code,
                    'population' => $wilaya->population,
                    'participants' => $wilaya->total_participants ?? 0
                ];
            });

        // Récupérer les moughataas pour chaque wilaya
        $moughataasByWilaya = Moughataa::with(['wilaya'])
            ->get()
            ->groupBy('wilaya_id');

        $questions = Question::where('is_active', true)
            ->where(function($query) {
                $query->whereNull('start_date')
                    ->orWhere('start_date', '<=', now());
            })
            ->where(function($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            })
            ->with('options')
            ->get();

        // Récupérer le hash du votant depuis le cookie
        $voterHash = request()->cookie('voter_hash');

        return view('fronts.home.home', compact(
            'centre',
            'evenements',
            'galeries',
            'videos',
            'wilayas',
            'moughataasByWilaya',
            'questions',
            'voterHash'
        ));
    }


}
