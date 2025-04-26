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
								<h3 class="page-title">Centres</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="">Accueil</a></li>
									<li class="breadcrumb-item active">Centres</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

<p class="text-right">
    <a href="{{ route('centres.create') }}" class="btn btn-primary">Ajouter un centre</a><br>

</p>
                    @if(session('success'))
                        <div class="alert alert-success mt-2">{{ session('success') }}</div>
                    @endif

		<div class="card mb-0">
								<div class="card-header">
                                    <h1>Centres</h1>
                                    <p class="card-text">
									</p>
								</div>
								<div class="card-body">
                                <div class="table-responsive">


                                    <table class="table mt-3">
                                        <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                            <th>Adrresse</th>

                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($centres as $centre)
                                            <tr>
                                                <td>{{ $centre->nom }}</td>
                                                <td>{{ $centre->email }}</td>
                                                <td>{{ $centre->telephone }}</td>
                                                <td>{{ $centre->adresse }}</td>

                                                <td>
                                                    <a href="{{ route('centres.edit', $centre) }}" class="btn btn-info btn-sm">Éditer</a>
                                                    <form action="{{ route('centres.destroy', $centre) }}" method="POST" style="display:inline;">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce centre ?')">Supprimer</button>
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
