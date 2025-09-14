@extends('base')



    @section('content')
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2>Liste des Wilayas</h2>
                    <a href="{{ route('wilayas.create') }}" class="btn btn-success">Ajouter une Wilaya</a>
                </div>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>Nom Arabe</th>
                    <th>Nom Français</th>
                    <th>Code</th>
                    <th>Population</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($wilayas as $wilaya)
                    <tr>
                        <td>{{ $wilaya->nom_ar }}</td>
                        <td>{{ $wilaya->nom_fr }}</td>
                        <td>{{ $wilaya->code }}</td>
                        <td>{{ $wilaya->population ?? 'N/A' }}</td>
                        <td>
                            <form action="{{ route('wilayas.destroy',$wilaya->id) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('wilayas.edit',$wilaya->id) }}">Modifier</a>
                                @csrf
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endsection
