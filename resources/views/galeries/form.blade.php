<!-- views/galeries/form.blade.php -->
<div class="form-group">
    <label for="titre">Titre</label>
    <input type="text" name="titre" class="form-control" value="{{ old('titre', $galery->titre ?? '') }}">
</div>

<div class="form-group">
    <label for="image_path">Image</label>
    <input type="file" name="image_path" class="form-control">
    @if(isset($galery))
        <img src="{{ asset('storage/' . $galery->image_path) }}" width="100" class="mt-2">
    @endif
</div>
