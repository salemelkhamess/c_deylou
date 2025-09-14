@extends('base')

@section('content')
    <div class="container">
        <h2>Modifier Participant</h2>

        <form action="{{ route('participants.update', $participant->id) }}" method="POST">
            @csrf
            @method('PUT')




            <div class="form-group">
                <label for="wilaya_id">Wilaya:</label>
                <select class="form-control" id="wilaya_id" name="wilaya_id" required>
                    @foreach($wilayas as $wilaya)
                        <option value="{{ $wilaya->id }}" {{ $participant->wilaya_id == $wilaya->id ? 'selected' : '' }}>
                            {{ $wilaya->nom_fr }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nombre_participants">Nombre de Participants:</label>
                <input type="number" class="form-control" id="nombre_participants" name="nombre_participants"
                       value="{{ $participant->nombre_participants }}" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
