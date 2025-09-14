@extends('base')
@section('content')
    <div class="container">
        <h2>Liste des Participants</h2>
        <a href="{{ route('participants.create') }}" class="btn btn-primary mb-3">Ajouter Participant</a>

        <table class="table table-bordered">
            <thead>
            <tr>

                <th>Wilaya</th>
                <th>Nombre Participants</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($participants as $participant)
                <tr>
                    <td>{{ $participant->wilaya->nom_fr }}</td>
                    <td>{{ $participant->nombre_participants }}</td>
                    <td>
                        <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('participants.destroy', $participant->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
