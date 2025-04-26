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
								<h3 class="page-title">Liste des utilisateurs</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="">Accueil</a></li>
									<li class="breadcrumb-item active">Liste des utilisateurs</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
<p>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Créer un utilisateur</a>
        </p>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
		<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Liste des utilisateur</h4>
									<p class="card-text">
									</p>
								</div>
								<div class="card-body">
                                <div class="table-responsive">

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Rôle</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    <a href="{{ route('users.show', $user) }}" class="btn btn-info">Voir</a>
                                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Modifier</a>
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
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
