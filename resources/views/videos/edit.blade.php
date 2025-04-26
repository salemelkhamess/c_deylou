@extends('base')

@section('content')
    <div class="container">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Modifier la vidéo</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Accueil</a></li>
                        <li class="breadcrumb-item active">Modifier la vidéo</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->


    @if($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('videos.update', $video) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Titre</label>
                <input type="text" name="titre" class="form-control" value="{{ old('titre', $video->titre) }}" required>
            </div>

            <div class="form-group">
                <label>Type</label>
                <select name="type" class="form-control" required onchange="toggleInput(this.value)">
                    <option value="upload" {{ $video->type == 'upload' ? 'selected' : '' }}>Fichier local</option>
                    <option value="youtube" {{ $video->type == 'youtube' ? 'selected' : '' }}>YouTube</option>
                </select>
            </div>

            <div class="form-group" id="youtubeInput" style="display: {{ $video->type == 'youtube' ? 'block' : 'none' }};">
                <label>Lien YouTube</label>
                <input type="text" name="video_path" class="form-control"
                       value="{{ old('video_path', $video->type == 'youtube' ? $video->video_path : '') }}">
            </div>

            <div class="form-group" id="uploadInput" style="display: {{ $video->type == 'upload' ? 'block' : 'none' }};">
                <label>Changer la vidéo (laisser vide pour conserver l'actuelle)</label>
                <input type="file" name="video_path" class="form-control-file">
                <p class="mt-2">
                    <strong>Vidéo actuelle :</strong><br>
                    <video width="300" controls>
                        <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                        Non supporté
                    </video>
                </p>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ old('description', $video->description) }}</textarea>
            </div>

            <button class="btn btn-success">Mettre à jour</button>
            <a href="{{ route('videos.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

    <script>
        function toggleInput(value) {
            document.getElementById('uploadInput').style.display = (value === 'upload') ? 'block' : 'none';
            document.getElementById('youtubeInput').style.display = (value === 'youtube') ? 'block' : 'none';
        }
    </script>
@endsection
