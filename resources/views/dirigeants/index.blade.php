@extends('base')

@section('content')
    <div class="container">
        <h1>Liste des Dirigeants</h1>
        <a href="{{ route('dirigeants.create') }}" class="btn btn-primary mb-3">Ajouter un Dirigeant</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Photo</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dirigeants as $dirigeant)
                <tr>
                    <td>
                        @if($dirigeant->photo)
                            <img src="{{ asset('storage/'.$dirigeant->photo) }}" width="50" height="50" class="rounded-circle">
                        @else
                            <span class="text-muted">Aucune photo</span>
                        @endif
                    </td>
                    <td>{{ $dirigeant->nom }}</td>
                    <td>{{ $dirigeant->prenom }}</td>
                    <td>{{ $dirigeant->email }}</td>
                    <td>{{ $dirigeant->telephone }}</td>
                    <td>
                        <a href="{{ route('dirigeants.show', $dirigeant->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('dirigeants.edit', $dirigeant->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('dirigeants.destroy', $dirigeant->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
