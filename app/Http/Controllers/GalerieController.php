<?php

namespace App\Http\Controllers;

use App\Models\Galerie;
use Illuminate\Http\Request;


class GalerieController extends Controller
{
    public function index()
    {
        $galeries = Galerie::latest()->get();
        return view('galeries.index', compact('galeries'));
    }

    public function create()
    {
        return view('galeries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'nullable|string|max:255',
            'image_path' => 'required|image|max:2048',
        ]);

        $image = $request->file('image_path')->store('galerie', 'public');

        Galerie::create([
            'titre' => $request->titre,
            'image_path' => $image,
        ]);

        return redirect()->route('galeries.index')->with('success', 'Image ajoutée avec succès');
    }

    public function edit(Galerie $galery)
    {
        return view('galeries.edit', compact('galery'));
    }

    public function update(Request $request, Galerie $galery)
    {
        $request->validate([
            'titre' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path')->store('galerie', 'public');
            $galery->image_path = $image;
        }

        $galery->titre = $request->titre;
        $galery->save();

        return redirect()->route('galeries.index')->with('success', 'Image mise à jour avec succès');
    }

    public function destroy(Galerie $galery)
    {
        $galery->delete();
        return redirect()->route('galeries.index')->with('success', 'Image supprimée');
    }
}
