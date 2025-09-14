@extends('base')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Modifier la Wilaya</h2>
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

        <form action="{{ route('wilayas.update',$wilaya->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nom_ar">Nom Arabe:</label>
                        <input type="text" class="form-control" id="nom_ar" name="nom_ar" value="{{ $wilaya->nom_ar }}" placeholder="Nom en arabe">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nom_fr">Nom Français:</label>
                        <input type="text" class="form-control" id="nom_fr" name="nom_fr" value="{{ $wilaya->nom_fr }}" placeholder="Nom en français">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="code">Code:</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ $wilaya->code }}" placeholder="Code unique">
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
@endsection
