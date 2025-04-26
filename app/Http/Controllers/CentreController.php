<?php
namespace App\Http\Controllers;

use App\Models\Centre;
use Illuminate\Http\Request;

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
        ]);

        Centre::create($request->all());

        return redirect()->route('centres.index')->with('success', 'Centre créé avec succès.');
    }

    public function show(Centre $centre)
    {
        return view('centres.show', compact('centre'));
    }

    public function edit(Centre $centre)
    {
        return view('centres.edit', compact('centre'));
    }

    public function update(Request $request, Centre $centre)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'adresse' => 'nullable|string',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string|max:20',
        ]);

        $centre->update($request->all());

        return redirect()->route('centres.index')->with('success', 'Centre mis à jour.');
    }

    public function destroy(Centre $centre)
    {
        $centre->delete();
        return redirect()->route('centres.index')->with('success', 'Centre supprimé.');
    }
}
