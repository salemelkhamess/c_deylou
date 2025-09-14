<?php

namespace App\Http\Controllers;

use App\Models\Wilaya;
use Illuminate\Http\Request;

class WilayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wilayas = Wilaya::all();
        return view('wilayas.index', compact('wilayas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wilayas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_ar' => 'required|string|max:255',
            'nom_fr' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:wilayas',
            'population' => 'nullable|integer|min:0', // Validation pour la population
        ]);

        Wilaya::create($request->all());

        return redirect()->route('wilayas.index')
            ->with('success', 'Wilaya créée avec succès.');
    }

    public function update(Request $request, Wilaya $wilaya)
    {
        $request->validate([
            'nom_ar' => 'required|string|max:255',
            'nom_fr' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:wilayas,code,'.$wilaya->id,
            'population' => 'nullable|integer|min:0', // Validation pour la population
        ]);

        $wilaya->update($request->all());

        return redirect()->route('wilayas.index')
            ->with('success', 'Wilaya mise à jour avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Wilaya $wilaya)
    {
        return view('wilayas.show', compact('wilaya'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wilaya $wilaya)
    {
        return view('wilayas.edit', compact('wilaya'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wilaya $wilaya)
    {
        $wilaya->delete();

        return redirect()->route('wilayas.index')
            ->with('success', 'Wilaya supprimée avec succès');
    }
}
