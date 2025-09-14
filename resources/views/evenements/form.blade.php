<!-- Dans evenements/form.blade.php -->
<div class="form-group">
    <label for="moughataa_id">Moughataa</label>
    <select name="moughataa_id" id="moughataa_id" class="form-control" required>
        <option value="">Sélectionner une Moughataa</option>
        @foreach($moughataas as $moughataa)
            <option value="{{ $moughataa->id }}" {{ (old('moughataa_id', $evenement->moughataa_id ?? '') == $moughataa->id) ? 'selected' : '' }}>
                {{ $moughataa->nom_fr }} ({{ $moughataa->wilaya->nom_fr }})
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="titre">Titre</label>
    <input type="text" name="titre" class="form-control" value="{{ old('titre', $evenement->titre ?? '') }}" required>
</div>

<div class="form-group">
    <label for="titre_ar">Titre en Arabe</label>
    <input type="text" name="titre_ar" class="form-control" value="{{ old('titre_ar', $evenement->titre_ar ?? '') }}">
</div>

<div class="form-group">
    <label for="titre_en">Titre en Anglais</label>
    <input type="text" name="titre_en" class="form-control" value="{{ old('titre_en', $evenement->titre_en ?? '') }}">
</div>


<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $evenement->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="description_ar">Description en Arabe</label>
    <textarea name="description_ar" class="form-control">{{ old('description_ar', $evenement->description_ar ?? '') }}</textarea>
</div>


<div class="form-group">
    <label for="description_en">Description en Anglais</label>
    <textarea name="description_en" class="form-control">{{ old('description_en', $evenement->description_en ?? '') }}</textarea>
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

