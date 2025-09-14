@extends('base')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Moughataas</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Accueil</a></li>
                        <li class="breadcrumb-item active">Moughataas</li>
                    </ul>
                </div>
            </div>
        </div>

        <p class="text-right">
            <a href="{{ route('moughataas.create') }}" class="btn btn-primary">Ajouter une Moughataa</a>
        </p>

        @if(session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif

        <div class="card mb-0">
            <div class="card-header">
                <h1>Liste des Moughataas</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mt-3">
                        <thead>
                        <tr>
                            <th>Nom (FR)</th>
                            <th>Nom (AR)</th>
                            <th>Code</th>
                            <th>Wilaya</th>
                            <th>Population</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($moughataas as $moughataa)
                            <tr>
                                <td>{{ $moughataa->nom_fr }}</td>
                                <td>{{ $moughataa->nom_ar }}</td>
                                <td>{{ $moughataa->code }}</td>
                                <td>{{ $moughataa->wilaya->nom_fr }}</td>
                                <td>{{ number_format($moughataa->population, 0, ',', ' ') }}</td>
                                <td>
                                    <a href="{{ route('moughataas.edit', $moughataa) }}" class="btn btn-info btn-sm">Éditer</a>
                                    <form action="{{ route('moughataas.destroy', $moughataa) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette Moughataa ?')">Supprimer</button>
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
