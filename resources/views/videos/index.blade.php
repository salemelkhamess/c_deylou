@extends('base')

@section('content')
    <div class=" container-fluid">
        <!-- Page Wrapper -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Liste des vidéos</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Accueil</a></li>
                            <li class="breadcrumb-item active">Liste des vidéos</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

        <h2></h2>
        <a href="{{ route('videos.create') }}" class="btn btn-primary mb-3">Ajouter une vidéo</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @foreach($videos as $video)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>{{ $video->titre }}</h5>

                            @if($video->type === 'youtube')
                                <iframe width="100%" height="315"
                                        src="{{ $video->video_path }}"
                                        frameborder="0" allowfullscreen>
                                </iframe>
                            @else
                                <video width="100%" height="315" controls>
                                    <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                                    Votre navigateur ne supporte pas la vidéo.
                                </video>
                            @endif

                            <p>{{ $video->description }}</p>

                            <a href="{{ route('videos.edit', $video) }}" class="btn btn-info btn-sm">Modifier</a>
                            <form action="{{ route('videos.destroy', $video) }}" method="POST" style="display:inline;">
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
