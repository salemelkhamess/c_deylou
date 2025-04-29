@extends('base')

@section('styles')

@endsection

@section('content')
		<!-- Page Wrapper -->
                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Carousels</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="">Accueil</a></li>
									<li class="breadcrumb-item active">Carousels</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

<p class="text-right">
    <a href="{{ route('carousel.create') }}" class="btn btn-primary mb-4">Ajouter un Carousel</a>

</p>
                    @if(session('success'))
                        <div class="alert alert-success mt-2">{{ session('success') }}</div>
                    @endif
                    <div class="card mb-0">
                        <div class="card-header">
                            <h1 class="my-4">Carrousels</h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carousels as $carousel)
                                        <tr>
                                            <td>{{ $carousel->title_fr }}</td>
                                            <td title="{{ $carousel->description_fr }}">
                                                {{ \Illuminate\Support\Str::limit($carousel->description_fr, 100) }} <!-- Limite la description à 100 caractères -->
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/'.$carousel->image_path) }}" alt="Image" class="img-fluid" style="max-width: 150px; height: auto;">
                                            </td>
                                            <td>
                                                <a href="{{ route('carousel.edit', $carousel->id) }}" class="btn btn-warning btn-sm">Éditer</a>
                                                <form action="{{ route('carousel.destroy', $carousel->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

@endsection


@section('scripts')


    <script>
        $(document).ready(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });

        })


    </script>

    @endsection
