<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;



class EvenementController extends Controller
{
    public function index()
    {
        $evenements = Evenement::all();
        return view('evenements.index', compact('evenements'));
    }

    public function create()
    {
        return view('evenements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_evenement' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('evenements', 'public');
            $data['image'] = $image;
        }

        Evenement::create($data);

        return redirect()->route('evenements.index')->with('success', 'Événement ajouté avec succès.');
    }

    public function edit(Evenement $evenement)
    {
        return view('evenements.edit', compact('evenement'));
    }

    public function show($id)
    {
        $event = Evenement::findOrFail($id);
        return view('fronts.events.show', compact('event'));
    }


    public function update(Request $request, Evenement $evenement)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_evenement' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('evenements', 'public');
            $data['image'] = $image;
        }

        $evenement->update($data);

        return redirect()->route('evenements.index')->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy(Evenement $evenement)
    {
        $evenement->delete();
        return back()->with('success', 'Événement supprimé.');
    }



    public function allEvent()
    {
        $evenements = Evenement::latest()->paginate(9);
        return view('fronts.events.index', compact('evenements'));
    }
}
