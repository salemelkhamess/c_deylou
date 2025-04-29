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

      <div class="card">
          <div class="card-body">
              <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group">
                      <label>Titre (Français)</label>
                      <input type="text" name="titre" class="form-control" value="{{ old('titre') }}" required>
                  </div>

                  <div class="form-group">
                      <label>Titre (Arabe)</label>
                      <input type="text" name="titre_ar" class="form-control" value="{{ old('titre_ar') }}">
                  </div>

                  <div class="form-group">
                      <label>Titre (Anglais)</label>
                      <input type="text" name="titre_en" class="form-control" value="{{ old('titre_en') }}">
                  </div>



                  <div class="form-group">
                      <label>Type</label>
                      <select name="type" class="form-control" required onchange="toggleInput(this.value)">
                          <option value="">Choisir...</option>
                          <option value="upload" {{ old('type') == 'upload' ? 'selected' : '' }}>Fichier local</option>
                          <option value="youtube" {{ old('type') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                      </select>
                  </div>

                  <div class="form-group" id="youtubeInput" style="display:none;">
                      <label>Lien YouTube</label>
                      <input type="text" name="video_path" class="form-control" value="{{ old('video_path') }}">
                  </div>

                  <div class="form-group" id="uploadInput" style="display:none;">
                      <label>Fichier vidéo</label>
                      <input type="file" name="video_path" class="form-control-file">
                  </div>

                  <div class="form-group">
                      <label>Description (Français)</label>
                      <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                  </div>

                  <div class="form-group">
                      <label>Description (Arabe)</label>
                      <textarea name="description_ar" class="form-control">{{ old('description_ar') }}</textarea>
                  </div>

                  <div class="form-group">
                      <label>Description (Anglais)</label>
                      <textarea name="description_en" class="form-control">{{ old('description_en') }}</textarea>
                  </div>


                  <button type="submit" class="btn btn-success">Enregistrer</button>
              </form>

          </div>
      </div>

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
        document.addEventListener('DOMContentLoaded', function() {
            toggleInput("{{ old('type') }}");
        });
    </script>
@endsection
