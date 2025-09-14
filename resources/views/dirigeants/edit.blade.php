@extends('base')

@section('content')
    <div class="container">
        <h1>Modifier Dirigeant</h1>

        <form action="{{ route('dirigeants.update', $dirigeant->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Informations de base -->
            <div class="card mb-4">
                <div class="card-header">Informations personnelles</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom *</label>
                                <input type="text" name="nom" class="form-control" value="{{ old('nom', $dirigeant->nom) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prénom *</label>
                                <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $dirigeant->prenom) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Date de naissance *</label>
                        <input type="date" name="date_naissance" class="form-control"
                               value="{{ old('date_naissance', $dirigeant->date_naissance->format('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $dirigeant->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Téléphone *</label>
                        <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $dirigeant->telephone) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Adresse *</label>
                        <textarea name="adresse" class="form-control" rows="3" required>{{ old('adresse', $dirigeant->adresse) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Photo</label>
                        @if($dirigeant->photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$dirigeant->photo) }}" width="100" class="img-thumbnail">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="remove_photo" id="remove_photo">
                                    <label class="form-check-label" for="remove_photo">
                                        Supprimer la photo actuelle
                                    </label>
                                </div>
                            </div>
                        @endif
                        <input type="file" name="photo" class="form-control-file">
                    </div>
                </div>
            </div>

            <!-- Diplômes -->
            <div class="card mb-4">
                <div class="card-header">Diplômes</div>
                <div class="card-body" id="diplomes-container">
                    @foreach($dirigeant->diplomes as $index => $diplome)
                        <div class="diplome-form mb-3 border p-3">
                            <input type="hidden" name="diplomes[{{ $index }}][id]" value="{{ $diplome->id }}">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Titre du diplôme *</label>
                                        <input type="text" name="diplomes[{{ $index }}][titre]"
                                               value="{{ old("diplomes.$index.titre", $diplome->titre) }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Établissement</label>
                                        <input type="text" name="diplomes[{{ $index }}][etablissement]"
                                               value="{{ old("diplomes.$index.etablissement", $diplome->etablissement) }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Année d'obtention *</label>
                                        <input type="number" name="diplomes[{{ $index }}][annee_obtention]"
                                               value="{{ old("diplomes.$index.annee_obtention", $diplome->annee_obtention) }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Fichier</label>
                                        @if($diplome->fichier)
                                            <a href="{{ asset('storage/'.$diplome->fichier) }}" target="_blank" class="d-block mb-1">
                                                Voir le fichier actuel
                                            </a>
                                        @endif
                                        <input type="file" name="diplomes[{{ $index }}][fichier]" class="form-control-file">
                                        <input type="hidden" name="diplomes[{{ $index }}][fichier_existant]" value="{{ $diplome->fichier }}">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger remove-diplome">Supprimer</button>
                        </div>
                    @endforeach
                    <div id="new-diplomes-container"></div>
                    <button type="button" class="btn btn-sm btn-secondary" id="add-diplome">Ajouter un diplôme</button>
                </div>
            </div>

            <!-- Compétences -->
            <div class="card mb-4">
                <div class="card-header">Compétences</div>
                <div class="card-body" id="competences-container">
                    @foreach($dirigeant->competences as $index => $competence)
                        <div class="competence-form mb-3 border p-3">
                            <input type="hidden" name="competences[{{ $index }}][id]" value="{{ $competence->id }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nom de la compétence *</label>
                                        <input type="text" name="competences[{{ $index }}][nom]"
                                               value="{{ old("competences.$index.nom", $competence->nom) }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Niveau (1-5) *</label>
                                        <input type="number" name="competences[{{ $index }}][niveau]"
                                               value="{{ old("competences.$index.niveau", $competence->niveau) }}" min="1" max="5" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-sm btn-danger remove-competence" style="margin-top: 30px;">Supprimer</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div id="new-competences-container"></div>
                    <button type="button" class="btn btn-sm btn-secondary" id="add-competence">Ajouter une compétence</button>
                </div>
            </div>

            <!-- Expériences -->
            <div class="card mb-4">
                <div class="card-header">Expériences professionnelles</div>
                <div class="card-body" id="experiences-container">
                    @foreach($dirigeant->experiences as $index => $experience)
                        <div class="experience-form mb-3 border p-3">
                            <input type="hidden" name="experiences[{{ $index }}][id]" value="{{ $experience->id }}">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Poste *</label>
                                        <input type="text" name="experiences[{{ $index }}][poste]"
                                               value="{{ old("experiences.$index.poste", $experience->poste) }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Entreprise *</label>
                                        <input type="text" name="experiences[{{ $index }}][entreprise]"
                                               value="{{ old("experiences.$index.entreprise", $experience->entreprise) }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Date début *</label>
                                        <input type="date" name="experiences[{{ $index }}][date_debut]"
                                               value="{{ old("experiences.$index.date_debut", $experience->date_debut->format('Y-m-d')) }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Date fin</label>
                                        <input type="date" name="experiences[{{ $index }}][date_fin]"
                                               value="{{ old("experiences.$index.date_fin", $experience->date_fin ? $experience->date_fin->format('Y-m-d') : '') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="experiences[{{ $index }}][description]" class="form-control" rows="2">{{ old("experiences.$index.description", $experience->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger remove-experience">Supprimer</button>
                        </div>
                    @endforeach
                    <div id="new-experiences-container"></div>
                    <button type="button" class="btn btn-sm btn-secondary" id="add-experience">Ajouter une expérience</button>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('dirigeants.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>


@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Diplômes
            let diplomeIndex = {{ $dirigeant->diplomes->count() }};
            $('#add-diplome').click(function() {
                let newForm = `
        <div class="diplome-form mb-3 border p-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Titre du diplôme *</label>
                        <input type="text" name="diplomes[${diplomeIndex}][titre]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Établissement</label>
                        <input type="text" name="diplomes[${diplomeIndex}][etablissement]" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Année d'obtention *</label>
                        <input type="number" name="diplomes[${diplomeIndex}][annee_obtention]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Fichier *</label>
                        <input type="file" name="diplomes[${diplomeIndex}][fichier]" class="form-control-file" required>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-danger remove-diplome">Supprimer</button>
        </div>`;

                $('#new-diplomes-container').append(newForm);
                diplomeIndex++;
            });

            // Compétences
            let competenceIndex = {{ $dirigeant->competences->count() }};
            $('#add-competence').click(function() {
                let newForm = `
        <div class="competence-form mb-3 border p-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nom de la compétence *</label>
                        <input type="text" name="competences[${competenceIndex}][nom]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Niveau (1-5) *</label>
                        <input type="number" name="competences[${competenceIndex}][niveau]" min="1" max="5" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-sm btn-danger remove-competence" style="margin-top: 30px;">Supprimer</button>
                </div>
            </div>
        </div>`;

                $('#new-competences-container').append(newForm);
                competenceIndex++;
            });

            // Expériences
            let experienceIndex = {{ $dirigeant->experiences->count() }};
            $('#add-experience').click(function() {
                let newForm = `
        <div class="experience-form mb-3 border p-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Poste *</label>
                        <input type="text" name="experiences[${experienceIndex}][poste]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Entreprise *</label>
                        <input type="text" name="experiences[${experienceIndex}][entreprise]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Date début *</label>
                        <input type="date" name="experiences[${experienceIndex}][date_debut]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Date fin</label>
                        <input type="date" name="experiences[${experienceIndex}][date_fin]" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="experiences[${experienceIndex}][description]" class="form-control" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-danger remove-experience">Supprimer</button>
        </div>`;

                $('#new-experiences-container').append(newForm);
                experienceIndex++;
            });

            // Suppression des éléments
            $(document).on('click', '.remove-diplome, .remove-competence, .remove-experience', function() {
                $(this).closest('.diplome-form, .competence-form, .experience-form').remove();
            });
        });
    </script>
@endsection
