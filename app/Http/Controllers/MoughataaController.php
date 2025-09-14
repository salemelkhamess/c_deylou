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
        // Récupérer simplement les moughataas de la wilaya sans les participants
        $moughataas = Moughataa::where('wilaya_id', $wilaya->id)
            ->orderBy('nom_fr')
            ->get();

        return view('moughataas.by_wilaya', compact('wilaya', 'moughataas'));
    }

}
