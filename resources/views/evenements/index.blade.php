@extends('base')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Événements</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Accueil</a></li>
                        <li class="breadcrumb-item active">Événements</li>
                    </ul>
                </div>
            </div>
        </div>

        <p class="text-right">
            <a href="{{ route('evenements.create') }}" class="btn btn-primary">Ajouter un événement</a>
        </p>

        @if(session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif

        <div class="card mb-0">
            <div class="card-header">
                <h1>Liste des événements</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mt-3">
                        <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($evenements as $evenement)
                            <tr>
                                <td>{{ $evenement->titre }}</td>
                                <td>{{ Str::limit($evenement->description, 50) }}</td>
                                <td>{{ $evenement->date_evenement }}</td>
                                <td>
                                    @if($evenement->image)
                                        <img src="{{ asset('storage/' . $evenement->image) }}" width="50">
                                    @else
                                        Aucune image
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('evenements.edit', $evenement) }}" class="btn btn-info btn-sm">Éditer</a>
                                    <form action="{{ route('evenements.destroy', $evenement) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet événement ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
