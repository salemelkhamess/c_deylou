<div class="form-group">
    <label for="nom_fr">Nom (Français)</label>
    <input type="text" name="nom_fr" id="nom_fr" class="form-control" value="{{ old('nom_fr', $moughataa->nom_fr ?? '') }}" required>
</div>

<div class="form-group">
    <label for="nom_ar">Nom (Arabe)</label>
    <input type="text" name="nom_ar" id="nom_ar" class="form-control" value="{{ old('nom_ar', $moughataa->nom_ar ?? '') }}" required>
</div>

<div class="form-group">
    <label for="nom_en">Nom (Anglais)</label>
    <input type="text" name="nom_en" id="nom_en" class="form-control" value="{{ old('nom_en', $moughataa->nom_en ?? '') }}" required>
</div>

<div class="form-group">
    <label for="code">Code</label>
    <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $moughataa->code ?? '') }}" required>
</div>

<div class="form-group">
    <label for="wilaya_id">Wilaya</label>
    <select name="wilaya_id" id="wilaya_id" class="form-control" required>
        <option value="">Sélectionner une Wilaya</option>
        @foreach($wilayas as $wilaya)
            <option value="{{ $wilaya->id }}" {{ (old('wilaya_id', $moughataa->wilaya_id ?? '') == $wilaya->id) ? 'selected' : '' }}>
                {{ $wilaya->nom_fr }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="population">Population</label>
    <input type="number" name="population" id="population" class="form-control" value="{{ old('population', $moughataa->population ?? 0) }}" min="0">
</div>
