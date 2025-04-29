<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    // Affiche tous les liens
    public function index()
    {
        $links = SocialLink::all();

        return view('social-links.index', compact('links'));
    }

    // Formulaire pour créer un nouveau lien
    public function create()
    {
        return view('social-links.create');
    }

    // Enregistrer un nouveau lien
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required|url',
        ]);

        SocialLink::create($request->all());
        return redirect()->route('social-links.index');
    }

    // Formulaire pour éditer un lien existant
    public function edit($id)
    {
        $link = SocialLink::findOrFail($id);
        return view('social-links.edit', compact('link'));
    }

    // Mettre à jour un lien existant
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required|url',
        ]);

        $link = SocialLink::findOrFail($id);
        $link->update($request->all());
        return redirect()->route('social-links.index');
    }

    // Supprimer un lien
    public function destroy($id)
    {
        $link = SocialLink::findOrFail($id);
        $link->delete();
        return redirect()->route('social-links.index');
    }
}
