@extends('fronts.base')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-5">Questions de Vote</h1>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @forelse($questions as $question)
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3>{{ $question->question_text }}</h3>
                            @if($question->start_date || $question->end_date)
                                <div class="text-muted small">
                                    @if($question->start_date)
                                        Début: {{ $question->start_date->format('d/m/Y H:i') }}
                                    @endif
                                    @if($question->end_date)
                                        - Fin: {{ $question->end_date->format('d/m/Y H:i') }}
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($question->votes->count() > 0)
                                <div class="alert alert-info">
                                    Vous avez déjà voté pour cette question.
                                    <a href="{{ route('votes.results', $question) }}" class="btn btn-sm btn-outline-primary ms-2">
                                        Voir les résultats
                                    </a>
                                </div>
                            @elseif(!$question->isActive())
                                <div class="alert alert-warning">
                                    Cette question n'est plus active.
                                    <a href="{{ route('votes.results', $question) }}" class="btn btn-sm btn-outline-primary ms-2">
                                        Voir les résultats
                                    </a>
                                </div>
                            @else
                                <form action="{{ route('votes.vote', $question) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        @foreach($question->options as $option)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio"
                                                       name="option_id" id="option_{{ $option->id }}"
                                                       value="{{ $option->id }}" required>
                                                <label class="form-check-label" for="option_{{ $option->id }}">
                                                    {{ $option->option_text }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary">Voter</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <h4 class="text-muted">Aucune question de vote active pour le moment.</h4>
                        <p>Revenez plus tard pour participer aux votes.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
