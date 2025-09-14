@extends('fronts.base')

@section('styles')
    <style>
        .wilaya-header {
            background: linear-gradient(135deg, #1a2a44 0%, #0d1b2e 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 40px;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .wilaya-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
        }

        .wilaya-subtitle {
            opacity: 0.9;
            font-size: 1.2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
            border-left: 4px solid #1a2a44;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .stat-number {
            font-size: 2.8rem;
            font-weight: bold;
            color: #1a2a44;
            margin-bottom: 8px;
            font-family: 'Playfair Display', serif;
        }

        .stat-label {
            color: #6c757d;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .moughataa-table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .table-header {
            background: linear-gradient(135deg, #1a2a44 0%, #0d1b2e 100%);
            color: white;
            padding: 20px 25px;
        }

        .table-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .moughataa-table {
            margin: 0;
            width: 100%;
        }

        .moughataa-table th {
            background-color: #2d3748;
            color: white;
            padding: 15px 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .moughataa-table td {
            padding: 15px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .moughataa-table tr:last-child td {
            border-bottom: none;
        }

        .moughataa-table tr:hover {
            background-color: #f8fafc;
        }

        .code-badge {
            background: #e2e8f0;
            color: #4a5568;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .back-btn {
            background: linear-gradient(135deg, #1a2a44 0%, #0d1b2e 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(26, 42, 68, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(26, 42, 68, 0.3);
            color: white;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 40px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-number {
                font-size: 2.2rem;
            }

            .moughataa-table th,
            .moughataa-table td {
                padding: 12px 15px;
            }

            .wilaya-header {
                padding: 30px 0;
            }
        }
    </style>
@endsection

@section('content')
    <div class="wilaya-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="wilaya-title mb-3">Moughataas de la Wilaya de {{ $wilaya->nom_fr }}</h1>
                    <p class="wilaya-subtitle">Liste des subdivisions administratives de la région</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Cartes de statistiques -->
        <div class="stats-grid">
            <div class="stat-card animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="stat-number">{{ number_format($wilaya->population, 0, ',', ' ') }}</div>
                <div class="stat-label">Population Totale</div>
            </div>

            <div class="stat-card animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="stat-number">{{ $moughataas->count() }}</div>
                <div class="stat-label">Nombre de Moughataas</div>
            </div>

            <div class="stat-card animate-fade-in-up" style="animation-delay: 0.3s;">
                @php
                    $avgPopulation = $moughataas->count() > 0 ? $wilaya->population / $moughataas->count() : 0;
                @endphp
                <div class="stat-number">{{ number_format($avgPopulation, 0, ',', ' ') }}</div>
                <div class="stat-label">Population Moyenne par Moughataa</div>
            </div>
        </div>

        <!-- Tableau des Moughataa -->
        <div class="moughataa-table-container animate-fade-in">
            <div class="table-header">
                <h4><i class="fas fa-list me-2"></i>Liste des Moughataas</h4>
            </div>

            <div class="table-responsive">
                <table class="table moughataa-table">
                    <thead>
                    <tr>
                        <th>Nom du Moughataa</th>
                        <th>Code</th>
                        <th>Population</th>
                        <th>Densité</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($moughataas as $moughataa)
                        @php
                            // Calcul simple de densité (juste pour l'exemple)
                            $density = $moughataa->population > 0 ? number_format($moughataa->population / 100, 1) : 0;
                        @endphp
                        <tr>
                            <td>
                                <strong>{{ $moughataa->nom_fr }}</strong>
                                @if($moughataa->nom_ar)
                                    <br>
                                    <small class="text-muted">{{ $moughataa->nom_ar }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="code-badge">{{ $moughataa->code }}</span>
                            </td>
                            <td>
                                {{ number_format($moughataa->population, 0, ',', ' ') }}
                                <div class="progress mt-2" style="height: 6px;">
                                    @php
                                        $percentage = $wilaya->population > 0 ?
                                            ($moughataa->population / $wilaya->population) * 100 : 0;
                                    @endphp
                                    <div class="progress-bar bg-primary"
                                         role="progressbar"
                                         style="width: {{ $percentage }}%"
                                         aria-valuenow="{{ $percentage }}"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $density }} hab/km²
                                <div class="progress mt-2" style="height: 6px;">
                                    <div class="progress-bar bg-info"
                                         role="progressbar"
                                         style="width: {{ min($density * 2, 100) }}%"
                                         aria-valuenow="{{ $density }}"
                                         aria-valuemin="0"
                                         aria-valuemax="50">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bouton de retour -->
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Retour à la carte
            </a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des éléments
            const animatedElements = document.querySelectorAll('.animate-fade-in-up, .animate-fade-in');
            animatedElements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });

            // Effet de survol sur les cartes
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-8px)';
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
@endsection
