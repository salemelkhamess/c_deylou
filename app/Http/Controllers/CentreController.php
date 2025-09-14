<?php
namespace App\Http\Controllers;

use App\Models\Centre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CentreController extends Controller
{
    public function index()
    {
        $centres = Centre::all();
        return view('centres.index', compact('centres'));
    }

    public function create()
    {
        return view('centres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'adresse' => 'nullable|string',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string|max:20',
            'nom_ar' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'adresse_ar' => 'nullable|string',
            'nom_en' => 'required|string|max:255',  // Validation ajoutée pour l'anglais
            'description_en' => 'nullable|string',  // Validation ajoutée pour l'anglais
            'adresse_en' => 'nullable|string',      // Validation ajoutée pour l'anglais
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $logoPath;
        }

        Centre::create($data);

        return redirect()->route('centres.index')->with('success', 'Centre créé avec succès.');
    }

    public function update(Request $request, Centre $centre)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'adresse' => 'nullable|string',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string|max:20',
            'nom_ar' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'adresse_ar' => 'nullable|string',
            'nom_en' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'adresse_en' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gestion du logo
        if ($request->hasFile('logo')) {
            // Suppression de l'ancien logo
            if ($centre->logo && Storage::disk('public')->exists($centre->logo)) {
                Storage::disk('public')->delete($centre->logo);
            }

            // Stockage du nouveau logo avec un nom unique
            $logoName = 'centre_'.$centre->id.'_'.time().'.'.$request->file('logo')->extension();
            $logoPath = $request->file('logo')->storeAs('logos', $logoName, 'public');
            $validatedData['logo'] = $logoPath;
        }

        $centre->update($validatedData);

        return redirect()->route('centres.index')->with('success', 'Centre mis à jour.');
    }

    public function show(Centre $centre)
    {
        return view('centres.show', compact('centre'));
    }

    public function edit(Centre $centre)
    {
        return view('centres.edit', compact('centre'));
    }



    public function destroy(Centre $centre)
    {
        $centre->delete();
        return redirect()->route('centres.index')->with('success', 'Centre supprimé.');
    }
}
