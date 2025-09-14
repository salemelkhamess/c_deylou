@extends('base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Gestion des Questions</h4>
                        <a href="{{ route('questions.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Nouvelle Question
                        </a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Options</th>
                                    <th>Statut</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Votes</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($questions as $question)
                                    <tr>
                                        <td>{{ Str::limit($question->question_text, 100) }}</td>
                                        <td>{{ $question->options->count() }}</td>
                                        <td>
                                        <span class="badge bg-{{ $question->is_active ? 'success' : 'danger' }}">
                                            {{ $question->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                        </td>
                                        <td>{{ $question->start_date ? $question->start_date->format('d/m/Y H:i') : '-' }}</td>
                                        <td>{{ $question->end_date ? $question->end_date->format('d/m/Y H:i') : '-' }}</td>
                                        <td>{{ $question->votes->count() }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('questions.results', $question) }}"
                                                   class="btn btn-info btn-sm" title="Résultats">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('questions.edit', $question) }}"
                                                   class="btn btn-warning btn-sm" title="Modifier">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('questions.toggle-status', $question) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-{{ $question->is_active ? 'secondary' : 'success' }} btn-sm"
                                                            title="{{ $question->is_active ? 'Désactiver' : 'Activer' }}">
                                                        <i class="fa fa-{{ $question->is_active ? 'times' : 'check' }}"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('questions.destroy', $question) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?')"
                                                            title="Supprimer">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
