<div class="form-group">
    <label for="titre">Titre</label>
    <input type="text" name="titre" class="form-control" value="{{ old('titre', $video->titre ?? '') }}">
</div>

<div class="form-group">
    <label for="type">Type</label>
    <select name="type" class="form-control" onchange="toggleVideoInput(this.value)">
        <option value="upload" {{ (old('type', $video->type ?? '') == 'upload') ? 'selected' : '' }}>Upload</option>
        <option value="youtube" {{ (old('type', $video->type ?? '') == 'youtube') ? 'selected' : '' }}>YouTube</option>
    </select>
</div>

<div class="form-group" id="video_upload" style="display: none;">
    <label>Fichier Vidéo</label>
    <input type="file" name="video_path" class="form-control">
</div>

<div class="form-group" id="video_youtube" style="display: none;">
    <label>Lien YouTube</label>
    <input type="text" name="video_path" class="form-control" value="{{ old('video_path', $video->video_path ?? '') }}">
</div>

<div class="form-group">
    <label>Description</label>
    <textarea name="description" class="form-control">{{ old('description', $video->description ?? '') }}</textarea>
</div>

<script>
    function toggleVideoInput(type) {
        document.getElementById('video_upload').style.display = type === 'upload' ? 'block' : 'none';
        document.getElementById('video_youtube').style.display = type === 'youtube' ? 'block' : 'none';
    }
    document.addEventListener("DOMContentLoaded", function () {
        toggleVideoInput("{{ old('type', $video->type ?? 'upload') }}");
    });
</script>
