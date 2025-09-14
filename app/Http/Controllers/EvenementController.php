<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Moughataa;
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
        $moughataas = Moughataa::with('wilaya')->get();

        return view('evenements.create' , compact('moughataas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'titre_ar' => 'nullable|string|max:255',
            'titre_en' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
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
    public function update(Request $request, Evenement $evenement)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'titre_ar' => 'nullable|string|max:255',
            'titre_en' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
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

    public function edit(Evenement $evenement)
    {

        $moughataas = Moughataa::with('wilaya')->get();

        return view('evenements.edit', compact('evenement' , 'moughataas'));
    }

    public function show($id)
    {
        $event = Evenement::findOrFail($id);
        return view('fronts.events.show', compact('event'));
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
