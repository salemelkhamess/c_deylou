@extends('fronts.base')

@section('content')
    <div class="container-fluid mt-4" >
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Résultats: {{ $question->question_text }}</h4>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Statistiques</h5>
                                <div class="stats-box p-3 bg-light rounded">
                                    <p><strong>Total des votes:</strong> {{ $question->options->sum('votes_count') }}</p>
                                    <p><strong>Nombre d'options:</strong> {{ $question->options->count() }}</p>
                                    <p><strong>Statut:</strong>
                                        <span class="badge bg-{{ $question->is_active ? 'success' : 'danger' }}">
                                        {{ $question->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4">Détail des votes par option</h5>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Nombre de votes</th>
                                    <th>Pourcentage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($question->options as $option)
                                    <tr>
                                        <td>{{ $option->option_text }}</td>
                                        <td>{{ $option->votes_count }}</td>
                                        <td>
                                            @php
                                                $total = $question->options->sum('votes_count');
                                                $percentage = $total > 0 ? ($option->votes_count / $total) * 100 : 0;
                                            @endphp
                                            {{ number_format($percentage, 2) }}%
                                            <div class="progress mt-1" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar"
                                                     style="width: {{ $percentage }}%;"
                                                     aria-valuenow="{{ $percentage }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <h5>Graphique des résultats</h5>
                            <canvas id="resultsChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('resultsChart').getContext('2d');
            const options = @json($question->options->pluck('option_text'));
            const votes = @json($question->options->pluck('votes_count'));

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: options,
                    datasets: [{
                        label: 'Nombre de votes',
                        data: votes,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                            'rgba(255, 159, 64, 0.7)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
