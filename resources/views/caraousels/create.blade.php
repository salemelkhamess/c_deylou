@extends('base')

@section('content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a >Accueil</a></li>
                        <li class="breadcrumb-item active">Ajouter un Carousel</li>
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
                <h1 class="my-4">Ajouter un Carousel</h1>
                <p class="card-text">
                </p>
            </div>
            <div class="card-body">

                <form action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="form-group">
                        <label for="title_fr">Titre Français</label>
                        <input type="text" class="form-control" id="title_fr" name="title_fr" required>
                    </div>
                    <div class="form-group">
                        <label for="title_ar">Titre Arabe</label>
                        <input type="text" class="form-control" id="title_ar" name="title_ar" required>
                    </div>


                    <div class="form-group">
                        <label for="title_en">Title (English)</label>
                        <input type="text" class="form-control" id="title_en" name="title_en" required>
                    </div>


                    <div class="form-group">
                        <label for="description_ar">Description Arabe</label>
                        <textarea class="form-control" id="description_ar" name="description_ar" required></textarea>
                    </div>



                    <div class="form-group">
                        <label for="description_fr">Description Français</label>
                        <textarea class="form-control" id="description_fr" name="description_fr" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="description_en">Description (English)</label>
                        <textarea class="form-control" id="description_en" name="description_en" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
                </form>


            </div>

            </div>
        </div>
    </div>
@endsection

