<div class="mb-3">
    <label>Nom</label>
    <input type="text" name="nom" class="form-control" value="{{ old('nom', $centre->nom ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control">{{ old('description', $centre->description ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label>Adresse</label>
    <input type="text" name="adresse" class="form-control" value="{{ old('adresse', $centre->adresse ?? '') }}">
</div>
<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $centre->email ?? '') }}">
</div>
<div class="mb-3">
    <label>Téléphone</label>
    <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $centre->telephone ?? '') }}">
</div>
