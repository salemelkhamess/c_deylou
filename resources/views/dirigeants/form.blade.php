<div class="mb-3">
    <label>Nom</label>
    <input type="text" name="nom" class="form-control" value="{{ old('nom', $centre->nom ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Nom (Arabe)</label>
    <input type="text" name="nom_ar" class="form-control" value="{{ old('nom_ar', $centre->nom_ar ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Nom (Anglais)</label>
    <input type="text" name="nom_en" class="form-control" value="{{ old('nom_en', $centre->nom_en ?? '') }}" required>
</div>






<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control">{{ old('description', $centre->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Description (Arabe)</label>
    <textarea name="description_ar" class="form-control">{{ old('description_ar', $centre->description_ar ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Description (Anglais)</label>
    <textarea name="description_en" class="form-control">{{ old('description_en', $centre->description_en ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Adresse</label>
    <input type="text" name="adresse" class="form-control" value="{{ old('adresse', $centre->adresse ?? '') }}">
</div>

<div class="mb-3">
    <label>Adresse (Arabe)</label>
    <input type="text" name="adresse_ar" class="form-control" value="{{ old('adresse_ar', $centre->adresse_ar ?? '') }}">
</div>

<div class="mb-3">
    <label>Adresse (Anglais)</label>
    <input type="text" name="adresse_en" class="form-control" value="{{ old('adresse_en', $centre->adresse_en ?? '') }}">
</div>

<div class="mb-3">
    <label>Emails</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $centre->email ?? '') }}">
</div>

<div class="mb-3">
    <label>Téléphone</label>
    <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $centre->telephone ?? '') }}">
</div>


<div class="mb-3">
    <label>Logo</label>
    <input type="file" name="logo" class="form-control">
    @if (!empty($centre->logo))
        <div class="mt-2">
            <img src="{{ asset('storage/' . $centre->logo) }}" alt="Logo" width="100">
        </div>
    @endif
</div>


