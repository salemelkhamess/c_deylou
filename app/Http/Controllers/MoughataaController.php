<?php

namespace App\Http\Controllers;

use App\Models\Moughataa;
use App\Models\Wilaya;
use Illuminate\Http\Request;

class MoughataaController extends Controller
{
    public function index()
    {
        $moughataas = Moughataa::with('wilaya')->get();
        return view('moughataas.index', compact('moughataas'));
    }

    public function create()
    {
        $wilayas = Wilaya::all();
        return view('moughataas.create', compact('wilayas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_fr' => 'required|string|max:255',
            'nom_ar' => 'required|string|max:255',
            'nom_en' => 'required|string|max:255',
            'code' => 'required|string|unique:moughataas',
            'wilaya_id' => 'required|exists:wilayas,id',
            'population' => 'nullable|integer|min:0'
        ]);

        Moughataa::create($request->all());

        return redirect()->route('moughataas.index')
            ->with('success', 'Moughataa créée avec succès.');
    }

    public function show(Moughataa $moughataa)
    {
        return view('moughataas.show', compact('moughataa'));
    }

    public function edit(Moughataa $moughataa)
    {
        $wilayas = Wilaya::all();
        return view('moughataas.edit', compact('moughataa', 'wilayas'));
    }

    public function update(Request $request, Moughataa $moughataa)
    {
        $request->validate([
            'nom_fr' => 'required|string|max:255',
            'nom_ar' => 'required|string|max:255',
            'nom_en' => 'required|string|max:255',
            'code' => 'required|string|unique:moughataas,code,' . $moughataa->id,
            'wilaya_id' => 'required|exists:wilayas,id',
            'population' => 'nullable|integer|min:0'
        ]);

        $moughataa->update($request->all());

        return redirect()->route('moughataas.index')
            ->with('success', 'Moughataa mise à jour avec succès.');
    }

    public function destroy(Moughataa $moughataa)
    {
        $moughataa->delete();

        return redirect()->route('moughataas.index')
            ->with('success', 'Moughataa supprimée avec succès.');
    }


    public function byWilaya(Wilaya $wilaya)
    {
        // Charger les moughataas avec leurs événements
        $moughataas = Moughataa::where('id', $wilaya->id)
            ->with('evenements') // eager load
            ->orderBy('nom_fr')
            ->get();


        return view('moughataas.by_wilaya', compact('wilaya', 'moughataas'));
    }


    public function eventByMoughataa($id)
    {
        // Charger UNE seule moughataa avec ses événements
        $moughataa = Moughataa::with('evenements')
            ->findOrFail($id);

        return view('moughataas.by_wilaya', compact('moughataa'));
    }


    public function getByWilayaApi(Wilaya $wilaya)
    {
        $moughataas = Moughataa::where('wilaya_id', $wilaya->id)
            ->orderBy('nom_fr')
            ->get()
            ->map(function ($moughataa) {
                // Comme il n'y a pas de relation directe entre Moughataa et Participant,
                // nous devons calculer manuellement le nombre de participants
                // Note: Cette approche peut être inefficace pour de grandes quantités de données
                $participantsCount = 0;

                return [
                    'id' => $moughataa->id,
                    'nom_fr' => $moughataa->nom_fr,
                    'nom_ar' => $moughataa->nom_ar,
                    'code' => $moughataa->code,
                    'population' => $moughataa->population,
                    'participants_count' => $participantsCount,
                    'participation_rate' => $moughataa->population > 0 ?
                        ($participantsCount / $moughataa->population) * 100 : 0
                ];
            });

        return response()->json([
            'wilaya' => [
                'id' => $wilaya->id,
                'nom_fr' => $wilaya->nom_fr,
                'nom_ar' => $wilaya->nom_ar
            ],
            'moughataas' => $moughataas
        ]);
    }

}
