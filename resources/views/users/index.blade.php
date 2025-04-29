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
<p class="text-right">                    <a href="{{ route('users.create') }}" class="btn btn-primary">Créer un utilisateur</a>
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
                                <div class="table-responsive ">

                                    <table class="table table-hover table-center mb-0" id="example1">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Rôle</th>
                                            <th>Statut</th>

                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @foreach($user->roles as $role)
                                                        <span class="badge
                                                @switch($role->name)
                                                    @case('super admin') bg-danger @break
                                                    @case('admin') bg-warning text-dark @break
                                                    @case('caissier') bg-success @break
                                                    @case('comptable') bg-info @break
                                                    @default bg-secondary
                                                @endswitch
                                                me-1 mb-1">
                                                {{ $role->name }}
                                            </span>
                                                    @endforeach
                                                </td>

                                                <td>
                <span class="badge {{ $user->status ? 'bg-success' : 'bg-danger' }}">
                    {{ $user->status ? 'Actif' : 'Désactivé' }}
                </span>
                                                </td>

                                                <td>
                                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-secondary">Modifier</a>
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                                onclick="event.preventDefault();
                swal({
                    title: 'Êtes-vous sûr ?',
                    text: 'Cette action supprimera définitivement l\'utilisateur',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        this.closest('form').submit();
                    }
                });">
                                                           Supprimer</button>
                                                    </form>
                                                    <br><br>
                                                    <form action="{{ route('users.toggle-status', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="btn btn-sm {{ $user->status ? 'btn-warning' : 'btn-success' }}"
                                                                onclick="event.preventDefault();
                swal({
                    title: 'Êtes-vous sûr ?',
                    text: 'Cette action désactive définitivement l\'utilisateur',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        this.closest('form').submit();
                    }
                });">


                                                            {{ $user->status ? 'Désactiver' : 'Activer' }}
                                                        </button>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });

        })

        document.querySelectorAll('.toggle-status-form input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                this.form.submit();
            });
        });
    </script>

@endsection
