@extends('base')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <h1>Éditer Carousel</h1>
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
                <h1 class="my-4">Éditer Carousel</h1>

            </div>
            <div class="card-body">

                <form action="{{ route('carousel.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if ($carousel->image_path)
                            <img src="{{ asset('storage/'.$carousel->image_path) }}" class="img-thumbnail mt-2" width="150" alt="Image actuelle">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="title_ar">Titre Arabe</label>
                        <input type="text" class="form-control" id="title_ar" name="title_ar" value="{{ old('title_ar', $carousel->title_ar) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="title_en">Title (English)</label>
                        <input type="text" class="form-control" id="title_en" name="title_en" value="{{ old('title_en', $carousel->title_en) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description_ar">Description Arabe</label>
                        <textarea class="form-control" id="description_ar" name="description_ar" required>{{ old('description_ar', $carousel->description_ar) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="title_fr">Titre Français</label>
                        <input type="text" class="form-control" id="title_fr" name="title_fr" value="{{ old('title_fr', $carousel->title_fr) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description_fr">Description Français</label>
                        <textarea class="form-control" id="description_fr" name="description_fr" required>{{ old('description_fr', $carousel->description_fr) }}</textarea>
                    </div>



                    <div class="form-group">
                        <label for="description_en">Description (English)</label>
                        <textarea class="form-control" id="description_en" name="description_en" required>{{ old('description_en', $carousel->description_en) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#role_id').select2();

    </script>
@endsection
