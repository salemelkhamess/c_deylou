@extends('base')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a>Accueil</a></li>
                        <li class="breadcrumb-item active">{{ isset($evenement) ? 'Modifier' : 'Ajouter' }} un événement</li>
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
                <h1>{{ isset($evenement) ? 'Modifier' : 'Ajouter' }} un événement</h1>
            </div>
            <div class="card-body">
                <form action="{{ isset($evenement) ? route('evenements.update', $evenement) : route('evenements.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($evenement)) @method('PUT') @endif

                    @include('evenements.form')

                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
