@extends('base')

@section('content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a >Accueil</a></li>
                        <li class="breadcrumb-item active">Liste des utilisateurs</li>
                    </ul>
                </div>
            </div>
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

        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Ajouter un role</h4>
                <p class="card-text">
                </p>
            </div>
            <div class="card-body">
                <h1>Créer un utilisateur</h1>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name">Nom :</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div>
                        <label for="email">Email :</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div>
                        <label for="password">Mot de passe :</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div>
                        <label for="password_confirmation">Confirmer le mot de passe :</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                    </div>
                    <div>
                        <label for="role">Rôle :</label>
                        <select name="role" id="role" class="form-control mb-4" required>
                            <option value="admin">Admin</option>
                            <option value="vendeur">Vendeur</option>
                            <option value="client">Client</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>


            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#role_id').select2();

    </script>
@endsection
