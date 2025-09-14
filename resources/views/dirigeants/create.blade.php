@extends('base')

@section('content')
    <div class="container">
        <h1>Ajouter un Dirigeant</h1>

        <form action="{{ route('dirigeants.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Informations de base -->
            <div class="card mb-4">
                <div class="card-header">Informations personnelles</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom *</label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prénom *</label>
                                <input type="text" name="prenom" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date de naissance *</label>
                                <input type="date" name="date_naissance" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Téléphone *</label>
                                <input type="text" name="telephone" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="photo" class="form-control-file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Adresse *</label>
                        <textarea name="adresse" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
            </div>

            <!-- Diplômes -->
            <div class="card mb-4">
                <div class="card-header">Diplômes</div>
                <div class="card-body" id="diplomes-container">
                    <div class="diplome-form mb-3 border p-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Titre du diplôme *</label>
                                    <input type="text" name="diplomes[0][titre]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Établissement</label>
                                    <input type="text" name="diplomes[0][etablissement]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Année d'obtention *</label>
                                    <input type="number" name="diplomes[0][annee_obtention]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Fichier *</label>
                                    <input type="file" name="diplomes[0][fichier]" class="form-control-file" required>
                                </div>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-line" disabled>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary" id="add-diplome">
                        <i class="fas fa-plus"></i> Ajouter un diplôme
                    </button>
                </div>
            </div>

            <!-- Compétences -->
            <div class="card mb-4">
                <div class="card-header">Compétences</div>
                <div class="card-body" id="competences-container">
                    <div class="competence-form mb-3 border p-3">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nom de la compétence *</label>
                                    <input type="text" name="competences[0][nom]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Niveau (1-5) *</label>
                                    <input type="number" name="competences[0][niveau]" class="form-control" min="1" max="5" required>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-line" disabled>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary" id="add-competence">
                        <i class="fas fa-plus"></i> Ajouter une compétence
                    </button>
                </div>
            </div>

            <!-- Expériences -->
            <div class="card mb-4">
                <div class="card-header">Expériences professionnelles</div>
                <div class="card-body" id="experiences-container">
                    <div class="experience-form mb-3 border p-3">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Poste *</label>
                                    <input type="text" name="experiences[0][poste]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Entreprise *</label>
                                    <input type="text" name="experiences[0][entreprise]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date début *</label>
                                    <input type="date" name="experiences[0][date_debut]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date fin</label>
                                    <input type="date" name="experiences[0][date_fin]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-line" disabled>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="experiences[0][description]" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary" id="add-experience">
                        <i class="fas fa-plus"></i> Ajouter une expérience
                    </button>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
                <a href="{{ route('dirigeants.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        $(document).ready(function() {
            // Diplômes
            let diplomeIndex = 1;
            $('#add-diplome').click(function() {
                let newForm = $('.diplome-form').first().clone();
                newForm.find('input').val('');
                newForm.find('input[type="file"]').val('');
                newForm.find('input').each(function() {
                    let name = $(this).attr('name').replace('[0]', `[${diplomeIndex}]`);
                    $(this).attr('name', name);
                });
                newForm.find('.remove-line').removeAttr('disabled');
                $('#diplomes-container').append(newForm);
                diplomeIndex++;
            });

            // Compétences
            let competenceIndex = 1;
            $('#add-competence').click(function() {
                let newForm = $('.competence-form').first().clone();
                newForm.find('input').val('');
                newForm.find('input').each(function() {
                    let name = $(this).attr('name').replace('[0]', `[${competenceIndex}]`);
                    $(this).attr('name', name);
                });
                newForm.find('.remove-line').removeAttr('disabled');
                $('#competences-container').append(newForm);
                competenceIndex++;
            });

            // Expériences
            let experienceIndex = 1;
            $('#add-experience').click(function() {
                let newForm = $('.experience-form').first().clone();
                newForm.find('input, textarea').val('');
                newForm.find('input, textarea').each(function() {
                    let name = $(this).attr('name').replace('[0]', `[${experienceIndex}]`);
                    $(this).attr('name', name);
                });
                newForm.find('.remove-line').removeAttr('disabled');
                $('#experiences-container').append(newForm);
                experienceIndex++;
            });

            // Suppression des lignes
            $(document).on('click', '.remove-line', function() {
                // Ne pas supprimer la première ligne
                if ($(this).closest('.diplome-form, .competence-form, .experience-form').siblings().length > 0) {
                    $(this).closest('.diplome-form, .competence-form, .experience-form').remove();
                }
            });
        });
    </script>
@endsection
