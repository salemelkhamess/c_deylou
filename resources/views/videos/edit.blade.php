@extends('base')

@section('content')
    <div class="">

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

      <div class="card">
          <div class="card-body">
              <form action="{{ route('videos.update', $video) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <div class="form-group">
                      <label>Titre (Français)</label>
                      <input type="text" name="titre" class="form-control" value="{{ old('titre', $video->titre) }}" required>
                  </div>

                  <div class="form-group">
                      <label>Titre (Arabe)</label>
                      <input type="text" name="titre_ar" class="form-control" value="{{ old('titre_ar', $video->titre_ar) }}">
                  </div>


                  <div class="form-group">
                      <label>Titre (Anglais)</label>
                      <input type="text" name="titre_en" class="form-control" value="{{ old('titre_en' , $video->titre_en) }}">
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
                      <label>Description (Français)</label>
                      <textarea name="description" class="form-control">{{ old('description', $video->description) }}</textarea>
                  </div>

                  <div class="form-group">
                      <label>Description (Arabe)</label>
                      <textarea name="description_ar" class="form-control">{{ old('description_ar', $video->description_ar) }}</textarea>
                  </div>




                  <div class="form-group">
                      <label>Description (Anglais)</label>
                      <textarea name="description_en" class="form-control">{{ old('description_en' , $video->description_en) }}</textarea>
                  </div>

                  <button class="btn btn-success">Mettre à jour</button>
                  <a href="{{ route('videos.index') }}" class="btn btn-secondary">Annuler</a>
              </form>

          </div>
      </div>
    </div>
    <script>
        function toggleInput(value) {
            document.getElementById('uploadInput').style.display = (value === 'upload') ? 'block' : 'none';
            document.getElementById('youtubeInput').style.display = (value === 'youtube') ? 'block' : 'none';
        }
        document.addEventListener('DOMContentLoaded', function() {
            toggleInput("{{ old('type', $video->type) }}");
        });
    </script>
@endsection
