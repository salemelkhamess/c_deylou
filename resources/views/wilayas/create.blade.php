@extends('base')

@section('content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a >Accueil</a></li>
                        <li class="breadcrumb-item active">Ajouter un centre</li>
                    </ul>
                </div>
            </div>
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Il y a eu des problèmes avec votre saisie.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card mb-0">
            <div class="card-header">
                <h2>Ajouter une Wilaya</h2>
                <p class="card-text">
                </p>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>


                    <form action="{{ route('wilayas.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nom_ar">Nom Arabe:</label>
                                    <input type="text" class="form-control" id="nom_ar" name="nom_ar" placeholder="Nom en arabe">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nom_fr">Nom Français:</label>
                                    <input type="text" class="form-control" id="nom_fr" name="nom_fr" placeholder="Nom en français">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">Code:</label>
                                    <input type="text" class="form-control" id="code" name="code" placeholder="Code unique">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="population">Population:</label>
                                    <input type="number" class="form-control" id="population" name="population"
                                           value="{{ isset($wilaya) ? $wilaya->population : old('population') }}"
                                           placeholder="Nombre d'habitants" min="0">
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Soumettre</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

