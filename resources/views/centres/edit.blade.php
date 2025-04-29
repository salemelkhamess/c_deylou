@extends('base')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <h1>Modifier le centre</h1>
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
        <form action="{{ route('centres.update', $centre) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('centres.form')
            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>

    </div>
@endsection

@section('scripts')
    <script>
        $('#role_id').select2();

    </script>
@endsection
