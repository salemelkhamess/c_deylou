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
								<h3 class="page-title">Réseaux Sociaux</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="">Accueil</a></li>
									<li class="breadcrumb-item active">Réseaux Sociaux</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

<p class="text-right">
    <a href="{{ route('social-links.create') }}" class="btn btn-primary mb-3">Ajouter un lien</a>

</p>
                    @if(session('success'))
                        <div class="alert alert-success mt-2">{{ session('success') }}</div>
                    @endif
                    <div class="card mb-0">
                        <div class="card-header">
                            <h1>Réseaux Sociaux</h1>
                        </div>
                        <div class="card-body">
                            <!-- Tableau des liens sociaux -->
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Titre</th>
                                    <th scope="col">Lien</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($links as $link)
                                    <tr>
                                        <td>{{ $link->title }}</td>
                                        <td><a href="{{ $link->link }}" target="_blank">{{ $link->link }}</a></td>
                                        <td>
                                            <!-- Bouton Éditer -->
                                            <a href="{{ route('social-links.edit', $link->id) }}" class="btn btn-warning btn-sm">Éditer</a>

                                            <!-- Bouton Supprimer -->
                                            <form action="{{ route('social-links.destroy', $link->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce lien ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
