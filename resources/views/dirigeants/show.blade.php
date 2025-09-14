@extends('base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- Carte d'information personnelle -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Informations Personnelles</h5>
                    </div>
                    <div class="card-body text-center">
                        @if($dirigeant->photo)
                            <img src="{{ asset('storage/'.$dirigeant->photo) }}"
                                 class="img-fluid rounded-circle mb-3"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                 style="width: 150px; height: 150px; margin: 0 auto;">
                                <i class="fas fa-user fa-3x text-muted"></i>
                            </div>
                        @endif

                        <h4>{{ $dirigeant->prenom }} {{ $dirigeant->nom }}</h4>
                        <p class="text-muted mb-1">
                            <i class="fas fa-birthday-cake mr-2"></i>
                            {{ $dirigeant->date_naissance->format('d/m/Y') }}
                            ({{ now()->diffInYears($dirigeant->date_naissance) }} ans)
                        </p>

                        <hr>

                        <p>
                            <i class="fas fa-envelope mr-2"></i>
                            <a href="mailto:{{ $dirigeant->email }}">{{ $dirigeant->email }}</a>
                        </p>

                        <p>
                            <i class="fas fa-phone mr-2"></i>
                            {{ $dirigeant->telephone }}
                        </p>

                        <p>
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $dirigeant->adresse }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <!-- Section Diplômes -->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Diplômes</h5>
                    </div>
                    <div class="card-body">
                        @if($dirigeant->diplomes->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Établissement</th>
                                        <th>Année</th>
                                        <th>Document</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dirigeant->diplomes as $diplome)
                                        <tr>
                                            <td>{{ $diplome->titre }}</td>
                                            <td>{{ $diplome->etablissement ?? 'Non spécifié' }}</td>
                                            <td>{{ $diplome->annee_obtention }}</td>
                                            <td>
                                                <a href="{{ asset('storage/'.$diplome->fichier) }}"
                                                   target="_blank"
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-download"></i> Télécharger
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                Aucun diplôme enregistré pour ce dirigeant.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Section Compétences -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Compétences</h5>
                    </div>
                    <div class="card-body">
                        @if($dirigeant->competences->count() > 0)
                            <div class="row">
                                @foreach($dirigeant->competences as $competence)
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <strong>{{ $competence->nom }}</strong>
                                            <span>{{ $competence->niveau }}/5</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-info"
                                                 role="progressbar"
                                                 style="width: {{ ($competence->niveau / 5) * 100 }}%"
                                                 aria-valuenow="{{ $competence->niveau }}"
                                                 aria-valuemin="1"
                                                 aria-valuemax="5">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                Aucune compétence enregistrée pour ce dirigeant.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Section Expériences -->
                <div class="card mb-4">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">Expériences Professionnelles</h5>
                    </div>
                    <div class="card-body">
                        @if($dirigeant->experiences->count() > 0)
                            <div class="timeline">
                                @foreach($dirigeant->experiences as $experience)
                                    <div class="timeline-item">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h5 class="timeline-title">{{ $experience->poste }}</h5>
                                                <h6 class="text-muted">{{ $experience->entreprise }}</h6>
                                                <p class="mb-1">
                                                    <small class="text-muted">
                                                        {{ $experience->date_debut->format('m/Y') }} -
                                                        @if($experience->date_fin)
                                                            {{ $experience->date_fin->format('m/Y') }}
                                                            ({{ $experience->date_debut->diffInMonths($experience->date_fin) }} mois)
                                                        @else
                                                            En cours
                                                        @endif
                                                    </small>
                                                </p>
                                            </div>
                                            @if($experience->description)
                                                <div class="timeline-body">
                                                    <p>{{ $experience->description }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                Aucune expérience professionnelle enregistrée pour ce dirigeant.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('dirigeants.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                    <div>
                        <a href="{{ route('dirigeants.edit', $dirigeant->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('dirigeants.destroy', $dirigeant->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce dirigeant ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Style pour la timeline des expériences */
        .timeline {
            position: relative;
            padding-left: 50px;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }
        .timeline-badge {
            position: absolute;
            left: -25px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #ffc107;
            border: 3px solid #fff;
        }
        .timeline-panel {
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .timeline-title {
            margin-top: 0;
            color: #343a40;
        }
    </style>
@endsection
