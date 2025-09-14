@extends('base')

@section('content')
    <div class="container">
        <h2>Ajouter un Participant</h2>

        <form action="{{ route('participants.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="wilaya_id">Wilaya:</label>
                <select class="form-control" id="wilaya_id" name="wilaya_id" required>
                    <option value="">Sélectionnez une wilaya</option>
                    @foreach($wilayas as $wilaya)
                        <option value="{{ $wilaya->id }}">{{ $wilaya->nom_fr }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nombre_participants">Nombre de Participants:</label>
                <input type="number" class="form-control" id="nombre_participants" name="nombre_participants" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
@endsection
