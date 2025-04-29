@extends('base')

@section('content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a >Accueil</a></li>
                        <li class="breadcrumb-item active">Ajouter un lien</li>
                    </ul>
                </div>
            </div>
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

        <div class="card mb-0">
            <div class="card-header">
                <h1>Ajouter un lien</h1>
                <p class="card-text">
                </p>
            </div>
            <div class="card-body">
                <form action="{{ route('social-links.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Choisir un Réseau Social</label>
                        <select class="form-control"  name="title" id="title" style="width: 100%" required>
                            <option value="facebook">Facebook</option>
                            <option value="twitter">Twitter</option>
                            <option value="instagram">Instagram</option>
                            <option value="youtube">YouTube</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="pinterest">Pinterest</option>
                            <option value="tiktok">TikTok</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="link" class="form-label">Lien</label>
                        <input type="url" class="form-control" name="link" id="link" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Ajouter</button>
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

