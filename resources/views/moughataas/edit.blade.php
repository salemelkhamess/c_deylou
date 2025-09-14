@extends('base')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a>Accueil</a></li>
                        <li class="breadcrumb-item active">Modifier une Moughataa</li>
                    </ul>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="card mb-0">
            <div class="card-header">
                <h1>Modifier la Moughataa: {{ $moughataa->nom_fr }}</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('moughataas.update', $moughataa) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('moughataas.form')
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
@endsection
