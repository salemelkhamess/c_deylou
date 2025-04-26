@extends('base')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <h1>Modifier l'utilisateur</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Nom :</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" required>
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" required>
            </div>
            <div>
                <label for="password">Nouveau mot de passe :</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div>
                <label for="password_confirmation">Confirmer le mot de passe :</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
            </div>
            <div>
                <label for="role">Rôle :</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="vendeur" {{ $user->role === 'vendeur' ? 'selected' : '' }}>Vendeur</option>
                    <option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Client</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-4">Mettre à jour</button>
        </form>

    </div>
@endsection

@section('scripts')
    <script>
        $('#role_id').select2();

    </script>
@endsection
