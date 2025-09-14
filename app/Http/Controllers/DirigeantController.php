<?php
namespace App\Http\Controllers;

use App\Models\Dirigeant;
use App\Models\Diplome;
use App\Models\Competence;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DirigeantController extends Controller
{
    public function index()
    {
        $dirigeants = Dirigeant::withCount(['diplomes', 'competences', 'experiences'])->get();
        return view('dirigeants.index', compact('dirigeants'));
    }

    public function create()
    {
        return view('dirigeants.create');
    }

    public function edit(Dirigeant $dirigeant)
    {
        // Charger les relations nécessaires
        $dirigeant->load(['diplomes', 'competences', 'experiences']);

        return view('dirigeants.edit', compact('dirigeant'));
    }
    public function show(Dirigeant $dirigeant)
    {
        // Charger toutes les relations nécessaires
        $dirigeant->load(['diplomes', 'competences', 'experiences']);

        return view('dirigeants.show', compact('dirigeant'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'date_naissance' => 'required|date',
            'email' => 'required|email|unique:dirigeants',
            'telephone' => 'required',
            'adresse' => 'required',
            'photo' => 'nullable|image|max:2048',

            'diplomes.*.titre' => 'required',
            'diplomes.*.fichier' => 'required|file|mimes:pdf,doc,docx|max:5120',

            'competences.*.nom' => 'required',
            'competences.*.niveau' => 'required|integer|between:1,5',

            'experiences.*.poste' => 'required',
            'experiences.*.entreprise' => 'required',
            'experiences.*.date_debut' => 'required|date',
        ]);

        // Début de la transaction
        DB::beginTransaction();

        try {
            // Création du dirigeant
            $dirigeant = Dirigeant::create($request->only([
                'nom', 'prenom', 'date_naissance', 'email',
                'telephone', 'adresse'
            ]));

            // Gestion de la photo
            if ($request->hasFile('photo')) {
                $dirigeant->photo = $request->file('photo')->store('dirigeants/photos', 'public');
                $dirigeant->save();
            }

            // Ajout des diplômes
            if ($request->has('diplomes')) {
                foreach ($request->diplomes as $diplomeData) {
                    $fichier = $diplomeData['fichier']->store('dirigeants/diplomes', 'public');

                    $dirigeant->diplomes()->create([
                        'titre' => $diplomeData['titre'],
                        'etablissement' => $diplomeData['etablissement'] ?? null,
                        'annee_obtention' => $diplomeData['annee_obtention'],
                        'fichier' => $fichier
                    ]);
                }
            }

            // Ajout des compétences
            if ($request->has('competences')) {
                $dirigeant->competences()->createMany($request->competences);
            }

            // Ajout des expériences
            if ($request->has('experiences')) {
                $dirigeant->experiences()->createMany($request->experiences);
            }

            // Tout s'est bien passé, on valide la transaction
            DB::commit();

            return redirect()->route('dirigeants.index')
                ->with('success', 'Dirigeant créé avec succès');

        } catch (\Exception $e) {
            // Une erreur est survenue, on annule la transaction
            DB::rollBack();

            // Suppression des fichiers éventuellement uploadés
            if (isset($dirigeant) && $dirigeant->photo) {
                Storage::disk('public')->delete($dirigeant->photo);
            }
            if (isset($fichier)) {
                Storage::disk('public')->delete($fichier);
            }

            return back()->withInput()
                ->with('error', 'Une erreur est survenue: '.$e->getMessage());
        }
    }

    public function update(Request $request, Dirigeant $dirigeant)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'date_naissance' => 'required|date',
            'email' => 'required|email|unique:dirigeants,email,'.$dirigeant->id,
            'telephone' => 'required',
            'adresse' => 'required',
            'photo' => 'nullable|image|max:2048',

            'diplomes.*.titre' => 'required',
            'diplomes.*.fichier' => 'sometimes|file|mimes:pdf,doc,docx|max:5120',

            'competences.*.nom' => 'required',
            'competences.*.niveau' => 'required|integer|between:1,5',

            'experiences.*.poste' => 'required',
            'experiences.*.entreprise' => 'required',
            'experiences.*.date_debut' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            // Mise à jour du dirigeant
            $dirigeant->update($request->only([
                'nom', 'prenom', 'date_naissance', 'email',
                'telephone', 'adresse'
            ]));

            // Gestion de la photo
            if ($request->hasFile('photo')) {
                if ($dirigeant->photo) {
                    Storage::disk('public')->delete($dirigeant->photo);
                }
                $dirigeant->photo = $request->file('photo')->store('dirigeants/photos', 'public');
                $dirigeant->save();
            }

            // Gestion des diplômes
            if ($request->has('diplomes')) {
                // Récupérer les IDs des diplômes existants
                $existingDiplomeIds = collect($request->diplomes)
                    ->filter(fn($d) => isset($d['id']))
                    ->pluck('id')
                    ->toArray();

                // Supprimer les diplômes qui ne sont plus dans la requête
                $dirigeant->diplomes()
                    ->whereNotIn('id', $existingDiplomeIds)
                    ->delete();

                foreach ($request->diplomes as $diplomeData) {
                    if (isset($diplomeData['id'])) {
                        // Mise à jour du diplôme existant
                        $diplome = Diplome::find($diplomeData['id']);

                        // Gestion du fichier
                        $fichier = $diplome->fichier;
                        if (isset($diplomeData['fichier'])) {
                            // Supprimer l'ancien fichier si existe
                            if ($fichier) {
                                Storage::disk('public')->delete($fichier);
                            }
                            $fichier = $diplomeData['fichier']->store('dirigeants/diplomes', 'public');
                        }

                        $diplome->update([
                            'titre' => $diplomeData['titre'],
                            'etablissement' => $diplomeData['etablissement'] ?? null,
                            'annee_obtention' => $diplomeData['annee_obtention'],
                            'fichier' => $fichier
                        ]);
                    } else {
                        // Création d'un nouveau diplôme
                        $fichier = $diplomeData['fichier']->store('dirigeants/diplomes', 'public');
                        $dirigeant->diplomes()->create([
                            'titre' => $diplomeData['titre'],
                            'etablissement' => $diplomeData['etablissement'] ?? null,
                            'annee_obtention' => $diplomeData['annee_obtention'],
                            'fichier' => $fichier
                        ]);
                    }
                }
            }

            // Gestion des compétences (même logique)
            if ($request->has('competences')) {
                $existingCompetenceIds = collect($request->competences)
                    ->filter(fn($c) => isset($c['id']))
                    ->pluck('id')
                    ->toArray();

                $dirigeant->competences()
                    ->whereNotIn('id', $existingCompetenceIds)
                    ->delete();

                foreach ($request->competences as $competenceData) {
                    if (isset($competenceData['id'])) {
                        $dirigeant->competences()
                            ->find($competenceData['id'])
                            ->update($competenceData);
                    } else {
                        $dirigeant->competences()->create($competenceData);
                    }
                }
            }

            // Gestion des expériences (même logique)
            if ($request->has('experiences')) {
                $existingExperienceIds = collect($request->experiences)
                    ->filter(fn($e) => isset($e['id']))
                    ->pluck('id')
                    ->toArray();

                $dirigeant->experiences()
                    ->whereNotIn('id', $existingExperienceIds)
                    ->delete();

                foreach ($request->experiences as $experienceData) {
                    if (isset($experienceData['id'])) {
                        $dirigeant->experiences()
                            ->find($experienceData['id'])
                            ->update($experienceData);
                    } else {
                        $dirigeant->experiences()->create($experienceData);
                    }
                }
            }

            DB::commit();

            return redirect()->route('dirigeants.index')
                ->with('success', 'Dirigeant mis à jour avec succès');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Une erreur est survenue: '.$e->getMessage());
        }
    }


    public function destroy(Dirigeant $dirigeant)
    {
        DB::beginTransaction();

        try {
            // Suppression des fichiers
            if ($dirigeant->photo) {
                Storage::disk('public')->delete($dirigeant->photo);
            }

            // Suppression des fichiers des diplômes
            foreach ($dirigeant->diplomes as $diplome) {
                Storage::disk('public')->delete($diplome->fichier);
            }

            // Suppression des enregistrements liés
            $dirigeant->diplomes()->delete();
            $dirigeant->competences()->delete();
            $dirigeant->experiences()->delete();

            // Suppression du dirigeant
            $dirigeant->delete();

            DB::commit();

            return redirect()->route('dirigeants.index')
                ->with('success', 'Dirigeant supprimé avec succès');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Une erreur est survenue lors de la suppression');
        }
    }


    public function listeDirigeants()
    {
        $dirigeants = Dirigeant::withCount(['diplomes', 'competences', 'experiences'])
            ->orderBy('nom')
            ->get();

        return view('fronts.dirigeants.liste', compact('dirigeants'));
    }

    public function afficherDirigeant($id)
    {
        $dirigeant = Dirigeant::with(['diplomes', 'competences', 'experiences'])
            ->findOrFail($id);

        return view('fronts.dirigeants.details', compact('dirigeant'));
    }
}
