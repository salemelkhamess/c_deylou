@extends('base')

@section('content')
    <div class="container">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Ajouter une vidéo</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Accueil</a></li>
                        <li class="breadcrumb-item active">Ajouter une vidéo</li>
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

        <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Titre</label>
                <input type="text" name="titre" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Type</label>
                <select name="type" class="form-control" required onchange="toggleInput(this.value)">
                    <option value="">Choisir...</option>
                    <option value="upload">Fichier local</option>
                    <option value="youtube">YouTube</option>
                </select>
            </div>

            <div class="form-group" id="youtubeInput" style="display:none;">
                <label>Lien YouTube</label>
                <input type="text" name="video_path" class="form-control">
            </div>

            <div class="form-group" id="uploadInput" style="display:none;">
                <label>Fichier vidéo</label>
                <input type="file" name="video_path" class="form-control-file">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Enregistrer</button>
        </form>
    </div>

    <script>
        function toggleInput(value) {
            if (value === 'upload') {
                document.getElementById('uploadInput').style.display = 'block';
                document.getElementById('youtubeInput').style.display = 'none';
            } else if (value === 'youtube') {
                document.getElementById('uploadInput').style.display = 'none';
                document.getElementById('youtubeInput').style.display = 'block';
            } else {
                document.getElementById('uploadInput').style.display = 'none';
                document.getElementById('youtubeInput').style.display = 'none';
            }
        }
    </script>
@endsection
