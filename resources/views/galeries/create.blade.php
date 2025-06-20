@extends('base')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a>Accueil</a></li>
                        <li class="breadcrumb-item active">Ajouter une image</li>
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
                <h1>Ajouter une image</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('galeries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('galeries.form')
                    <button class="btn btn-success">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
