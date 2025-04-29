@extends('base')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <h1>Éditer le lien</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h1>Éditer le lien</h1>

            </div>
            <div class="card-body">
                <form action="{{ route('social-links.update', $link->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Choisir un Réseau Social</label>
                        <select class="form-control"  name="title" id="title" required style="width: 100%">
                            <option value="facebook" {{ $link->title == 'facebook' ? 'selected' : '' }}>Facebook</option>
                            <option value="twitter" {{ $link->title == 'twitter' ? 'selected' : '' }}>Twitter</option>
                            <option value="instagram" {{ $link->title == 'instagram' ? 'selected' : '' }}>Instagram</option>
                            <option value="youtube" {{ $link->title == 'youtube' ? 'selected' : '' }}>YouTube</option>
                            <option value="linkedin" {{ $link->title == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                            <option value="pinterest" {{ $link->title == 'pinterest' ? 'selected' : '' }}>Pinterest</option>
                            <option value="tiktok" {{ $link->title == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="link" class="form-label">Lien</label>
                        <input type="url" class="form-control" name="link" id="link" value="{{ $link->link }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#title').select2();

    </script>
@endsection
