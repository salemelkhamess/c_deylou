<div class="form-group">
    <label for="titre">Titre</label>
    <input type="text" name="titre" class="form-control" value="{{ old('titre', $evenement->titre ?? '') }}" required>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $evenement->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="date_evenement">Date de l'événement</label>
    <input type="date" name="date_evenement" class="form-control" value="{{ old('date_evenement', isset($evenement) ? $evenement->date_evenement->format('Y-m-d') : '') }}" required>
</div>

<div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image" class="form-control-file">
    @if(isset($evenement) && $evenement->image)
        <img src="{{ asset('storage/' . $evenement->image) }}" width="100" class="mt-2">
    @endif
</div>
