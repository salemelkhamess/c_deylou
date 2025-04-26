@extends('base')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <h3 class="page-title">Galerie</h3>
            <p class="text-right mb-4">
                <a href="{{ route('galeries.create') }}" class="btn btn-primary float-right">Ajouter une image</a>

            </p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @foreach($galeries as $galery)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $galery->image_path) }}" class="card-img-top" alt="Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $galery->titre }}</h5>
                            <a href="{{ route('galeries.edit', $galery) }}" class="btn btn-info btn-sm">Modifier</a>
                            <form action="{{ route('galeries.destroy', $galery) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
