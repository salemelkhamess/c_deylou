<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Wilaya;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Participant::with('wilaya')->get();
        return view('participants.index', compact('participants'));
    }

    public function create()
    {
        $wilayas = Wilaya::whereNotIn('id', Participant::pluck('wilaya_id'))->get();
        return view('participants.create', compact('wilayas'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'wilaya_id' => 'required|exists:wilayas,id|unique:participants,wilaya_id',
            'nombre_participants' => 'required|integer|min:1'
        ]);

        Participant::create($request->all());

        return redirect()->route('participants.index')
            ->with('success', 'Participant ajouté avec succès.');
    }

    public function show(Participant $participant)
    {
        return view('participants.show', compact('participant'));
    }

    public function edit(Participant $participant)
    {
        $wilayas = Wilaya::whereNotIn('id', Participant::where('id', '!=', $participant->id)->pluck('wilaya_id'))
            ->orWhere('id', $participant->wilaya_id)
            ->get();

        return view('participants.edit', compact('participant', 'wilayas'));
    }

    public function update(Request $request, Participant $participant)
    {
        $request->validate([
            'wilaya_id' => 'required|exists:wilayas,id|unique:participants,wilaya_id,'.$participant->id,
            'nombre_participants' => 'required|integer|min:1'
        ]);

        $participant->update($request->all());

        return redirect()->route('participants.index')
            ->with('success', 'Participant mis à jour avec succès.');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();

        return redirect()->route('participants.index')
            ->with('success', 'Participant supprimé avec succès.');
    }
}
