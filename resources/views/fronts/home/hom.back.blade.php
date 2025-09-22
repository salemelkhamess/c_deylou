@extends('fronts.base')

@section('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        :root {
            --deep-blue: #1a2a44;
            --medium-blue: #0d1b2e;
            --white: #ffffff;
            --gold: #ffd700;
            --dark: #2d3748;
            --light-gray: #f1f5f9;
            --shadow: rgba(0, 0, 0, 0.15);
        }

        /* Map styles */
        #map {
            width: 100%;
            height: 750px;
            margin: 40px auto;
            position: relative;
            background: white;
            transition: all 0.3s ease;
            z-index: 0;
            cursor: pointer !important;
        }

        #map:hover {
            transform: scale(1.01);
        }

        /* Disable zoom controls */
        .leaflet-control-zoom {
            display: none !important;
        }

        /* Custom tooltip - NO SQUARE BORDER */
        .leaflet-tooltip.custom-tooltip {
            background: transparent;
            border: none !important;
            box-shadow: none !important;
            padding: 0;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            font-size: 15px;
            white-space: normal;
            transition: opacity 0.3s ease;
        }

        .custom-tooltip-content {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(12px);
            color: var(--dark);
            border-radius: 12px;
            box-shadow: 0 6px 25px var(--shadow);
            padding: 20px;
            border-left: 5px solid var(--gold);
            font-family: 'Roboto', sans-serif;
            font-size: 15px;
            white-space: normal;
            transition: opacity 0.3s ease, transform 0.3s ease;
            min-width: 300px;
        }

        .custom-tooltip h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 18px;
            margin: 0 0 12px 0;
            color: var(--deep-blue);
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .custom-tooltip b {
            color: var(--medium-blue);
            font-weight: 600;
        }

        /* Legend */
        .legend {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(8px);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 25px var(--shadow);
            line-height: 1.7;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
            max-width: 220px;
            transition: transform 0.3s ease;
        }

        .legend:hover {
            transform: translateY(-5px);
        }

        .legend h4 {
            margin: 0 0 15px;
            font-size: 17px;
            color: var(--deep-blue);
            font-weight: 700;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            font-family: 'Playfair Display', serif;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .legend-color {
            width: 24px;
            height: 24px;
            margin-right: 12px;
            border-radius: 6px;
            box-shadow: 0 2px 6px var(--shadow);
            transition: transform 0.2s ease;
        }

        .legend-item:hover .legend-color {
            transform: scale(1.1);
        }

        /* Wilaya labels */
        .wilaya-label {
            background: transparent;
            border: none;
            box-shadow: none;
            font-weight: 700;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.95);
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
            pointer-events: none;
            font-family: 'Roboto', sans-serif;
            letter-spacing: 0.6px;
            transition: opacity 0.3s ease;
        }

        /* Progress indicator */
        .progress-indicator {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            padding: 10px 20px;
            border-radius: 25px;
            box-shadow: 0 3px 15px var(--shadow);
            font-size: 14px;
            color: var(--dark);
            font-family: 'Roboto', sans-serif;
            transition: transform 0.3s ease;
        }

        .progress-indicator:hover {
            transform: translateX(-50%) translateY(-5px);
        }

        /* Pause indicator */
        .pause-indicator {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1001;
            background: rgba(255, 255, 255, 0.95);
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 6px 25px var(--shadow);
            font-weight: bold;
            color: var(--deep-blue);
            text-align: center;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            display: none;
        }

        /* Nouveaux styles pour le panneau des Moughataas */
        .moughataas-circle {
            width: 400px;
            height: 400px;
            border-radius: 50%;
            position: relative;
            margin: 60px auto 0 auto;
            background:
                radial-gradient(circle at 30% 30%, rgba(255,255,255,0.1) 0%, transparent 50%),
                linear-gradient(135deg, #dc2626 0%, #b91c1c 30%, #991b1b 70%, #7f1d1d 100%);
            display: none;
            overflow: visible;
            box-shadow:
                0 0 50px rgba(220, 38, 38, 0.4),
                0 8px 32px rgba(0,0,0,0.6),
                inset 0 2px 4px rgba(255,255,255,0.1),
                inset 0 -2px 4px rgba(0,0,0,0.3);
            border: 2px solid transparent;
            background-clip: padding-box;
            position: relative;
        }

        .moughataas-circle.show {
            display: block;
            animation: fadeInScale 0.6s ease-out;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Les pseudo-éléments seront créés dynamiquement par JavaScript */

        .moughataas-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 5;
            color: white;
            font-weight: 700;
            text-align: center;
            font-size: 16px;
            text-shadow:
                0 2px 4px rgba(0,0,0,0.8),
                0 0 10px rgba(255,255,255,0.3);
            background:
                linear-gradient(135deg,
                rgba(255,255,255,0.25) 0%,
                rgba(255,255,255,0.1) 50%,
                rgba(255,255,255,0.05) 100%
                );
            padding: 16px 20px;
            border-radius: 20px;
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255,255,255,0.4);
            box-shadow:
                0 8px 32px rgba(0,0,0,0.4),
                inset 0 1px 0 rgba(255,255,255,0.5),
                0 0 20px rgba(255,255,255,0.1);
            min-width: 120px;
        }

        .moughataas-center strong {
            font-size: 28px;
            display: block;
            margin-bottom: 6px;
            background: linear-gradient(45deg, #ffffff, #f0f9ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));
        }

        .moughataas-center .shape-name {
            font-size: 11px;
            letter-spacing: 2px;
            opacity: 0.9;
            font-weight: 500;
            text-transform: uppercase;
        }

        /* Labels élégants collés aux bordures avec inclinaison */
        .moughataa-label.elegant-border {
            position: absolute;
            text-align: center;
            font-weight: 600;
            color: white;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-shadow: 0 2px 8px rgba(0,0,0,0.9);
            user-select: none;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            animation: elegantSlideIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            opacity: 0;
        }

        @keyframes elegantSlideIn {
            0% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.3) rotate(0deg);
                filter: blur(10px);
            }
            60% {
                opacity: 0.8;
                transform: translate(-50%, -50%) scale(1.1) rotate(var(--rotation, 0deg));
                filter: blur(2px);
            }
            100% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1) rotate(var(--rotation, 0deg));
                filter: blur(0);
            }
        }

        /* Effet de brillance au survol */
        .moughataa-label.elegant-border::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            border-radius: inherit;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .moughataa-label.elegant-border:hover::before {
            opacity: 1;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }/* Styles spéciaux pour les labels inclinés (gauche/droite) */
        .moughataa-label.elegant-border[style*="rotate(90deg)"],
        .moughataa-label.elegant-border[style*="rotate(-90deg)"] {
            writing-mode: vertical-rl; /* Mode d'écriture vertical pour les navigateurs qui le supportent */
            text-orientation: mixed;
            background: linear-gradient(45deg, rgba(99, 102, 241, 0.95), rgba(79, 70, 229, 0.95)) !important;
            border: 2px solid rgba(99, 102, 241, 0.9) !important;
            box-shadow:
                0 6px 25px rgba(99, 102, 241, 0.4),
                inset 0 2px 0 rgba(255,255,255,0.3),
                0 0 15px rgba(99, 102, 241, 0.3) !important;
        }

        /* Effet spécial pour les labels verticaux au hover */
        .moughataa-label.elegant-border[style*="rotate(90deg)"]:hover,
        .moughataa-label.elegant-border[style*="rotate(-90deg)"]:hover {
            background: linear-gradient(45deg, rgba(99, 102, 241, 1), rgba(139, 92, 246, 1)) !important;
            box-shadow:
                0 8px 35px rgba(99, 102, 241, 0.6),
                inset 0 2px 0 rgba(255,255,255,0.4),
                0 0 0 3px rgba(99, 102, 241, 0.8),
                0 0 25px rgba(99, 102, 241, 0.5) !important;
            transform: translate(-50%, -50%) rotate(var(--rotation, 0deg)) scale(1.2) !important;
        }
        .moughataa-label.elegant-border:nth-child(3) { animation-delay: 0.2s; }
        .moughataa-label.elegant-border:nth-child(4) { animation-delay: 0.35s; }
        .moughataa-label.elegant-border:nth-child(5) { animation-delay: 0.5s; }
        .moughataa-label.elegant-border:nth-child(6) { animation-delay: 0.65s; }
        .moughataa-label.elegant-border:nth-child(7) { animation-delay: 0.8s; }
        .moughataa-label.elegant-border:nth-child(8) { animation-delay: 0.95s; }
        .moughataa-label.elegant-border:nth-child(9) { animation-delay: 1.1s; }
        .moughataa-label.elegant-border:nth-child(10) { animation-delay: 1.25s; }

        /* Rotation ultra-douce du polygone de fond */
        .moughataas-circle:hover::before {
            animation: ultraSmoothRotate 60s linear infinite;
        }

        @keyframes ultraSmoothRotate {
            from {
                transform: rotate(0deg);
                filter: brightness(1) saturate(1);
            }
            50% {
                filter: brightness(1.1) saturate(1.2);
            }
            to {
                transform: rotate(360deg);
                filter: brightness(1) saturate(1);
            }
        }

        /* Effet de pulsation lumineuse du cercle principal */
        .moughataas-circle::after {
            animation: centerGlow 4s ease-in-out infinite;
        }

        @keyframes centerGlow {
            0%, 100% {
                box-shadow:
                    inset 0 2px 10px rgba(255,255,255,0.4),
                    inset 0 -2px 10px rgba(0,0,0,0.2),
                    0 0 30px rgba(255,255,255,0.1);
            }
            50% {
                box-shadow:
                    inset 0 2px 10px rgba(255,255,255,0.6),
                    inset 0 -2px 10px rgba(0,0,0,0.1),
                    0 0 50px rgba(255,255,255,0.2);
            }
        }

        .no-moughataas {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            z-index: 3;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        /* Effets visuels ultra-élégants pour les labels */
        .moughataa-label.elegant-border:hover {
            animation: elegantHover 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        @keyframes elegantHover {
            0% {
                transform: translate(-50%, -50%) rotate(var(--rotation, 0deg)) scale(1);
                filter: brightness(1);
            }
            30% {
                transform: translate(-50%, -50%) rotate(var(--rotation, 0deg)) scale(1.05);
                filter: brightness(1.2);
            }
            60% {
                transform: translate(-50%, -50%) rotate(var(--rotation, 0deg)) scale(1.18);
                filter: brightness(1.1);
            }
            100% {
                transform: translate(-50%, -50%) rotate(var(--rotation, 0deg)) scale(1.15);
                filter: brightness(1.15);
            }
        }

        /* Effet de flou en arrière-plan pendant le hover */
        .moughataas-circle:has(.moughataa-label:hover) .moughataa-label:not(:hover) {
            filter: blur(1px) brightness(0.7);
            transform-origin: center;
            transition: all 0.3s ease;
        }

        /* Responsive Design Ultra-Optimisé */
        @media (max-width: 768px) {
            .moughataas-circle {
                width: 320px;
                height: 320px;
                margin: 30px auto 0 auto;
            }

            .moughataa-label.elegant-border {
                font-size: 11px !important;
                padding: 6px 12px !important;
                min-width: 70px !important;
                max-width: 110px !important;
                border-radius: 18px !important;
            }

            .moughataas-center {
                font-size: 14px;
                padding: 12px 16px;
                min-width: 100px;
            }

            .moughataas-center strong {
                font-size: 22px;
            }

            .moughataas-center .shape-name {
                font-size: 9px;
                letter-spacing: 1px;
            }
        }

        @media (max-width: 480px) {
            .moughataas-circle {
                width: 280px;
                height: 280px;
                margin: 20px auto 0 auto;
            }

            .moughataa-label.elegant-border {
                font-size: 10px !important;
                padding: 5px 10px !important;
                min-width: 60px !important;
                max-width: 90px !important;
                border-radius: 15px !important;
            }

            .moughataas-center {
                font-size: 12px;
                padding: 10px 12px;
                min-width: 80px;
            }

            .moughataas-center strong {
                font-size: 18px;
            }

            .moughataas-center .shape-name {
                font-size: 8px;
                letter-spacing: 1px;
            }
        }

        /* Effets de lueur spécialisés selon le nombre de côtés */
        .moughataas-circle[data-sides="3"] {
            box-shadow:
                0 0 60px rgba(236, 72, 153, 0.4),
                0 8px 32px rgba(0,0,0,0.6),
                inset 0 2px 4px rgba(255,255,255,0.1);
        }

        .moughataas-circle[data-sides="4"] {
            box-shadow:
                0 0 60px rgba(168, 85, 247, 0.4),
                0 8px 32px rgba(0,0,0,0.6),
                inset 0 2px 4px rgba(255,255,255,0.1);
        }

        .moughataas-circle[data-sides="5"] {
            box-shadow:
                0 0 60px rgba(34, 197, 94, 0.4),
                0 8px 32px rgba(0,0,0,0.6),
                inset 0 2px 4px rgba(255,255,255,0.1);
        }

        .moughataas-circle[data-sides="6"] {
            box-shadow:
                0 0 60px rgba(59, 130, 246, 0.4),
                0 8px 32px rgba(0,0,0,0.6),
                inset 0 2px 4px rgba(255,255,255,0.1);
        }

        /* Animation de focus quand un label est sélectionné */
        .moughataa-label.elegant-border:active {
            animation: labelPressed 0.2s ease-out;
        }

        @keyframes labelPressed {
            0% {
                transform: translate(-50%, -50%) rotate(var(--rotation, 0deg)) scale(1.15);
            }
            50% {
                transform: translate(-50%, -50%) rotate(var(--rotation, 0deg)) scale(0.95);
            }
            100% {
                transform: translate(-50%, -50%) rotate(var(--rotation, 0deg)) scale(1.1);
            }
        }

        /* Amélioration de l'accessibilité */
        .moughataa-label.elegant-border:focus {
            outline: 3px solid rgba(255, 255, 255, 0.8);
            outline-offset: 3px;
        }

        /* Animation de chargement pour le conteneur */
        .moughataas-circle.show {
            animation: elegantReveal 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes elegantReveal {
            0% {
                opacity: 0;
                transform: scale(0.6) rotate(-10deg);
                filter: blur(20px);
            }
            60% {
                opacity: 0.8;
                transform: scale(1.05) rotate(2deg);
                filter: blur(5px);
            }
            100% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
                filter: blur(0);
            }
        }

    </style>
@endsection

@section('content')
    <!-- Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide hero-carousel" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach(\App\Models\Carousel::all() as $index => $slide)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach(\App\Models\Carousel::all() as $index => $slide)
                @php
                    $locale = app()->getLocale();
                    $titre = $locale === 'ar' ? $slide->title_ar : ($locale === 'en' ? $slide->title_en : $slide->title_fr);
                    $description = $locale === 'ar' ? $slide->description_ar : ($locale === 'en' ? $slide->description_en : $slide->description_fr);
                    $direction = $locale === 'ar' ? 'rtl' : 'ltr';
                    $textAlign = $locale === 'ar' ? 'right' : 'left';
                @endphp

                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="carousel-image" style="background-image: url('{{ asset('storage/' . $slide->image_path) }}');">
                        <div class="carousel-caption">
                            <h5 style="direction: {{ $direction }}; text-align: {{ $textAlign }};">{{ $titre }}</h5>
                            <p style="direction: {{ $direction }}; text-align: {{ $textAlign }};">{{ $description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('messages.previous') }}</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('messages.next') }}</span>
        </button>
    </div>

    <!-- Map and Moughataas Panel -->
    <div class="row mt-5">
        <div class="col-lg-8">
            <!-- Interactive Map of Mauritania -->
            <div id="map"></div>
            <div class="progress-indicator" id="progressIndicator">
                Wilaya 1 sur {{ count($wilayas) }}
            </div>
            <div class="pause-indicator" id="pauseIndicator">
                Animation Pausée
            </div>
        </div>

        <div class="col-lg-4">
            <div class="moughataas-circle" id="moughataasCircle"></div>


        </div>
    </div>

    <!-- Voting Section -->
    <div class="row mt-5">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                @forelse($questions as $question)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="vote-card card h-100">
                            <div class="card-header">
                                <h5 class="card-title">{{ $question->question_text }}</h5>
                                @if($question->start_date || $question->end_date)
                                    <div class="text-light small">
                                        @if($question->start_date)
                                            Début: {{ $question->start_date->format('d/m/Y H:i') }}
                                        @endif
                                        @if($question->end_date)
                                            <br>Fin: {{ $question->end_date->format('d/m/Y H:i') }}
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                @if($question->votes->count() > 0)
                                    <div class="alert alert-info">
                                        Vous avez déjà voté pour cette question.
                                        <a href="{{ route('votes.results', $question) }}" class="btn btn-blue btn-sm ms-2">
                                            Voir les résultats
                                        </a>
                                    </div>
                                @elseif(!$question->isActive())
                                    <div class="alert alert-warning">
                                        Cette question n'est plus active.
                                        <a href="{{ route('votes.results', $question) }}" class="btn btn-blue btn-sm ms-2">
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
                                        <button type="submit" class="btn btn-gold w-100">Voter</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <h4 class="text-muted">Aucune question de vote active pour le moment.</h4>
                            <p>Revenez plus tard pour participer aux votes.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <section class="stats-section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-5">
                    <h2>Statistiques Nationales</h2>
                    <p class="text-muted">Données agrégées sur l'ensemble du territoire</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-card animate-fade-in">
                        <div class="stat-number">@php echo number_format($wilayas->sum('population'), 0, ',', ' ') @endphp</div>
                        <div class="stat-label">Population Totale</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-card animate-fade-in" style="animation-delay: 0.2s;">
                        <div class="stat-number">@php echo number_format($wilayas->sum('participants'), 0, ',', ' ') @endphp</div>
                        <div class="stat-label">Participants</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-card animate-fade-in" style="animation-delay: 0.4s;">
                        <div class="stat-number">@php echo $wilayas->sum('population') ? number_format(($wilayas->sum('participants') / $wilayas->sum('population')) * 100, 1) : 0 @endphp%</div>
                        <div class="stat-label">Taux de Participation</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-card animate-fade-in" style="animation-delay: 0.6s;">
                        <div class="stat-number">{{ count($wilayas) }}</div>
                        <div class="stat-label">Régions</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map', {
                center: [20.0, -10.5],
                zoom: 6,
                minZoom: 6,
                maxZoom: 6,
                zoomControl: false,
                dragging: false,
                doubleClickZoom: false,
                scrollWheelZoom: false,
                attributionControl: false
            });

            const wilayasData = @json($wilayas);
            const moughataasByWilaya = @json($moughataasByWilaya);
            const baseUrl = '{{ url("/") }}';
            let allLayers = [];
            let currentLayerIndex = 0;
            let animationInterval;
            let currentTooltip = null;
            let isAnimationPaused = false;
            let moughataaLayers = [];

            const moughataaColors = [
                '#ff6b6b', '#4ecdc4', '#45b7d1', '#96c93d',
                '#ff9f43', '#d64161', '#6c5ce7', '#00b894',
                '#e84393', '#0984e3', '#a29bfe', '#fdcb6e'
            ];

            function getColorByRate(rate) {
                return rate > 50 ? '#38a169' :
                    rate > 30 ? '#ecc94b' :
                        rate > 10 ? '#ed8936' : '#e53e3e';
            }

            function normalizeName(name) {
                return name.toLowerCase()
                    .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                    .replace(/[^a-z0-9\s]/g, '')
                    .replace(/\s+/g, ' ')
                    .trim();
            }

            function clearPreviousAnimation() {
                if (currentTooltip) {
                    map.closeTooltip(currentTooltip);
                    currentTooltip = null;
                }

                allLayers.forEach(l => {
                    const wilayaName = l.feature.properties.name;
                    const normalizedWilayaName = normalizeName(wilayaName);
                    const wilayaStats = wilayasData.find(w => normalizeName(w.nom) === normalizedWilayaName);

                    let fillColor = '#a0aec0';
                    if (wilayaStats) {
                        const rate = wilayaStats.population > 0 ?
                            (wilayaStats.participants / wilayaStats.population) * 100 : 0;
                        fillColor = getColorByRate(rate);
                    }

                    l.setStyle({
                        fillColor: fillColor,
                        weight: 2,
                        opacity: 1,
                        color: 'white',
                        fillOpacity: 0.7
                    });
                });

                moughataaLayers.forEach(layer => map.removeLayer(layer));
                moughataaLayers = [];
            }

            function highlightWilaya(layer) {
                clearPreviousAnimation();

                layer.setStyle({
                    weight: 4,
                    color: '#2c5282',
                    fillOpacity: 0.8
                });
                layer.bringToFront();

                const wilayaName = layer.feature.properties.name;
                const normalizedWilayaName = normalizeName(wilayaName);
                const wilayaStats = wilayasData.find(w => normalizeName(w.nom) === normalizedWilayaName);
                const wilayaId = wilayaStats ? wilayaStats.id : null;

                let tooltipContent = `<div class="custom-tooltip-content"><h6>${wilayaName}</h6>`;
                if (wilayaStats) {
                    const rate = wilayaStats.population > 0 ?
                        ((wilayaStats.participants / wilayaStats.population) * 100).toFixed(2) : 0;
                    tooltipContent += `
                <b>Population:</b> ${Number(wilayaStats.population).toLocaleString()}<br>
                <b>Participants:</b> ${Number(wilayaStats.participants).toLocaleString()}<br>
                <b>Taux:</b> ${rate}%<br><br>
            `;

                    if (wilayaId) {
                        tooltipContent += `
                    <div style="text-align: center; margin-top: 10px;">
                        <button onclick="window.openMoughataasPanel(${wilayaId})"
                           class="btn btn-primary btn-sm"
                           style="background-color: var(--deep-blue); border: none; padding: 5px 15px; border-radius: 5px; color: white; cursor: pointer;">
                            Voir les Moughataa
                        </button>
                    </div>
                `;
                    }
                } else {
                    tooltipContent += `<i>Aucune donnée disponible</i>`;
                }
                tooltipContent += `</div>`;

                currentTooltip = L.tooltip({
                    permanent: true,
                    direction: 'auto',
                    className: 'custom-tooltip'
                }).setContent(tooltipContent).setLatLng(layer.getBounds().getCenter()).addTo(map);

                const tooltipElement = currentTooltip.getElement();
                if (tooltipElement) {
                    tooltipElement.style.pointerEvents = 'auto';
                    const buttons = tooltipElement.querySelectorAll('button');
                    buttons.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.stopPropagation();
                            const wilayaId = this.getAttribute('onclick').match(/\d+/)[0];
                            window.openMoughataasPanel(wilayaId);
                        });
                    });
                }

                document.getElementById('progressIndicator').textContent =
                    `Wilaya ${allLayers.indexOf(layer) + 1} sur ${allLayers.length}`;
            }

            function loadMoughataas(wilayaId) {
                fetch(`${baseUrl}/api/wilaya/${wilayaId}/moughataas`)
                    .then(res => res.json())
                    .then(data => {
                        console.log('Données reçues:', data);

                        const container = document.getElementById('moughataasCircle');

                        if (!data.moughataas || data.moughataas.length === 0) {
                            container.innerHTML = '<p class="no-moughataas">Aucune Moughataa disponible</p>';
                            container.classList.add('show');
                            return;
                        }

                        // Vider le conteneur
                        container.innerHTML = '';

                        const totalMoughataas = data.moughataas.length;
                        const containerSize = 400;
                        const center = containerSize / 2;

                        // Ajouter l'attribut data-sides pour les effets CSS
                        container.setAttribute('data-sides', totalMoughataas);

                        // Créer le polygone de base selon le nombre de moughataas
                        createPolygonBackground(container, totalMoughataas);

                        // Ajouter la zone centrale avec le nombre de moughataas
                        /*          const centerDiv = document.createElement('div');
                                  centerDiv.className = 'moughataas-center';
                                  centerDiv.innerHTML = `<strong>${totalMoughataas}</strong><br><span class="shape-name">${getPolygonName(totalMoughataas).toUpperCase()}</span>`;
                                  container.appendChild(centerDiv);*/

                        // Calculer les points du polygone pour positionner les labels
                        const polygonPoints = calculatePolygonPointsForLabels(totalMoughataas, center, containerSize);

                        // Créer et positionner les labels aux bordures avec inclinaison
                        data.moughataas.forEach((moughataa, index) => {
                            const point = polygonPoints[index];

                            // Calculer l'angle d'inclinaison pour ce label AVANT de l'utiliser
                            const angle = point.angle;
                            const rotation = calculateLabelRotation(angle, totalMoughataas);

                            const label = document.createElement('div');
                            label.className = 'moughataa-label elegant-border';

                            // Ajouter une classe spéciale pour les labels inclinés
                            if (Math.abs(rotation) === 90) {
                                label.classList.add('inclined-label');
                            }

                            // Style dynamique pour la position et l'inclinaison
                            label.style.position = 'absolute';
                            label.style.left = `${point.x}px`;
                            label.style.top = `${point.y}px`;
                            label.style.transform = `translate(-50%, -50%) rotate(${rotation}deg)`;
                            label.style.setProperty('--rotation', `${rotation}deg`); // Variable CSS pour les animations
                            label.style.transformOrigin = 'center';
                            label.style.zIndex = '15';
                            label.style.padding = '10px 20px';
                            label.style.borderRadius = '25px';
                            label.style.color = 'white';
                            label.style.fontSize = '13px';
                            label.style.fontWeight = '600';
                            label.style.textAlign = 'center';
                            label.style.minWidth = '100px';
                            label.style.maxWidth = '160px';
                            label.style.transition = 'all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                            label.style.backdropFilter = 'blur(10px)';
                            label.style.whiteSpace = 'nowrap';
                            label.style.overflow = 'hidden';
                            label.style.textOverflow = 'ellipsis';
                            label.style.boxShadow = '0 4px 20px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.2)';
                            label.style.letterSpacing = '0.5px';
                            label.style.textShadow = '0 1px 3px rgba(0,0,0,0.8)';
                            label.style.border = '1px solid rgba(255,255,255,0.3)';

                            // Ajustements spéciaux pour les labels inclinés (gauche/droite)
                            if (Math.abs(rotation) === 90) {
                                label.style.minWidth = '120px'; // Plus large pour les labels verticaux
                                label.style.maxWidth = '180px';
                                label.style.padding = '12px 16px'; // Padding ajusté pour la lecture verticale
                                label.style.fontSize = '12px'; // Légèrement plus petit pour l'inclinaison
                                label.style.letterSpacing = '1px'; // Plus d'espacement pour la lisibilité
                            }

                            // Couleurs élégantes selon la position
                            const colors = getElegantColors(totalMoughataas);
                            const color = colors[index % colors.length];
                            label.style.background = `linear-gradient(135deg, ${color.primary} 0%, ${color.secondary} 100%)`;

                            // Ajouter une bordure dégradée
                            label.style.boxShadow = `0 4px 20px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.2), 0 0 0 2px ${color.border}`;

                            // Utiliser le vrai nom de la moughataa
                            const displayName = moughataa.nom_fr ||
                                moughataa.nom_ar ||
                                moughataa.nom_en ||
                                moughataa.name ||
                                moughataa.nom ||
                                `Moughataa ${index + 1}`;

                            label.textContent = displayName;
                            label.title = displayName;

                            // Ajouter l'événement click si l'ID existe
                            if (moughataa.id) {
                                label.addEventListener('click', () => {
                                    const moughataaRoute = @json(route('moughataas.events', ['id' => ':id']));
                                    const url = moughataaRoute.replace(':id', moughataa.id);
                                    window.location.href = url;
                                });
                                label.style.cursor = 'pointer';

                                // Effets hover ultra-élégants
                                label.addEventListener('mouseenter', function() {
                                    this.style.transform = `translate(-50%, -50%) rotate(${rotation}deg) scale(1.15)`;
                                    this.style.zIndex = '25';
                                    this.style.background = `linear-gradient(135deg, ${color.hover} 0%, ${color.hoverSecondary} 100%)`;
                                    this.style.boxShadow = `0 8px 35px rgba(0,0,0,0.6), inset 0 2px 0 rgba(255,255,255,0.4), 0 0 0 3px ${color.border}, 0 0 20px ${color.glow}`;
                                    this.style.letterSpacing = '1px';
                                });

                                label.addEventListener('mouseleave', function() {
                                    this.style.transform = `translate(-50%, -50%) rotate(${rotation}deg) scale(1)`;
                                    this.style.zIndex = '15';
                                    this.style.background = `linear-gradient(135deg, ${color.primary} 0%, ${color.secondary} 100%)`;
                                    this.style.boxShadow = `0 4px 20px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.2), 0 0 0 2px ${color.border}`;
                                    this.style.letterSpacing = '0.5px';
                                });
                            }

                            // Animation d'entrée retardée
                            label.style.opacity = '0';
                            label.style.transform = `translate(-50%, -50%) rotate(${rotation}deg) scale(0.3)`;

                            setTimeout(() => {
                                label.style.opacity = '1';
                                label.style.transform = `translate(-50%, -50%) rotate(${rotation}deg) scale(1)`;
                            }, 200 + (index * 150));

                            container.appendChild(label);
                        });

                        container.classList.add('show');
                        console.log(`${totalMoughataas} moughataas affichées en ${getPolygonName(totalMoughataas)} élégant avec inclinaison`);
                    })
                    .catch(error => {
                        console.error('Erreur lors du chargement des moughataas:', error);
                        const container = document.getElementById('moughataasCircle');
                        container.innerHTML = '<p class="no-moughataas">Erreur de chargement</p>';
                        container.classList.add('show');
                    });
            }

// Fonction pour calculer les points du polygone avec positionnement aux bordures
            function calculatePolygonPointsForLabels(sides, centerX, containerSize) {
                const points = [];
                const angleStep = (2 * Math.PI) / sides;
                const startAngle = -Math.PI / 2; // Commencer en haut
                const radius = containerSize * 0.42; // Plus proche des bordures

                for (let i = 0; i < sides; i++) {
                    const angle = startAngle + (i * angleStep);
                    const x = centerX + radius * Math.cos(angle);
                    const y = centerX + radius * Math.sin(angle);

                    points.push({
                        x,
                        y,
                        angle: angle * (180 / Math.PI) // Convertir en degrés pour la rotation
                    });
                }

                return points;
            }

// Fonction pour calculer la rotation optimale du label selon son angle
            function calculateLabelRotation(angle, sides) {
                // Normaliser l'angle entre 0 et 360
                let normalizedAngle = ((angle % 360) + 360) % 360;

                // Pour les polygones réguliers, définir les inclinaisons selon la position
                if (sides === 4) {
                    // Pour un carré, comme dans votre image de référence
                    if (normalizedAngle > 315 || normalizedAngle <= 45) return 0;      // Haut - horizontal
                    if (normalizedAngle > 45 && normalizedAngle <= 135) return 90;     // Droite - vertical (incliné)
                    if (normalizedAngle > 135 && normalizedAngle <= 225) return 0;     // Bas - horizontal
                    if (normalizedAngle > 225 && normalizedAngle <= 315) return -90;   // Gauche - vertical (incliné)
                }

                // Pour triangle (3 côtés)
                if (sides === 3) {
                    if (normalizedAngle > 330 || normalizedAngle <= 30) return 0;      // Haut - horizontal
                    if (normalizedAngle > 30 && normalizedAngle <= 150) return 60;     // Droite - incliné
                    if (normalizedAngle > 150 && normalizedAngle <= 270) return -60;   // Gauche - incliné
                }

                // Pour pentagone (5 côtés)
                if (sides === 5) {
                    if (normalizedAngle > 342 || normalizedAngle <= 18) return 0;      // Haut
                    if (normalizedAngle > 18 && normalizedAngle <= 90) return 72;      // Haut-droite
                    if (normalizedAngle > 90 && normalizedAngle <= 162) return 90;     // Droite (vertical)
                    if (normalizedAngle > 162 && normalizedAngle <= 234) return -72;   // Bas-gauche
                    if (normalizedAngle > 234 && normalizedAngle <= 306) return -90;   // Gauche (vertical)
                }

                // Pour hexagone (6 côtés)
                if (sides === 6) {
                    if (normalizedAngle > 330 || normalizedAngle <= 30) return 0;      // Haut
                    if (normalizedAngle > 30 && normalizedAngle <= 90) return 60;      // Haut-droite
                    if (normalizedAngle > 90 && normalizedAngle <= 150) return 90;     // Droite (vertical)
                    if (normalizedAngle > 150 && normalizedAngle <= 210) return 0;     // Bas
                    if (normalizedAngle > 210 && normalizedAngle <= 270) return -90;   // Gauche (vertical)
                    if (normalizedAngle > 270 && normalizedAngle <= 330) return -60;   // Haut-gauche
                }

                // Pour les autres formes (7+ côtés), utiliser une logique générale
                // Les côtés gauche et droite sont inclinés à 90° et -90°
                const sectorSize = 360 / sides;
                const sectorIndex = Math.floor(normalizedAngle / sectorSize);
                const sectorAngle = sectorIndex * sectorSize;

                // Déterminer si c'est un côté gauche ou droite pour l'incliner
                const isLeftSide = (normalizedAngle > 180 - sectorSize/2) && (normalizedAngle < 270 + sectorSize/2);
                const isRightSide = (normalizedAngle > 90 - sectorSize/2) && (normalizedAngle < 180 + sectorSize/2);

                if (isLeftSide) return -90;  // Côté gauche - incliné verticalement
                if (isRightSide) return 90;  // Côté droite - incliné verticalement

                // Pour le haut et bas, rester horizontal
                return 0;
            }

// Fonction pour créer le fond polygonal élégant
            function createPolygonBackground(container, sides) {
                const existingStyle = document.getElementById('polygon-style');
                if (existingStyle) {
                    existingStyle.remove();
                }

                const style = document.createElement('style');
                style.id = 'polygon-style';

                const points = calculatePolygonPoints(sides, 50, 45);
                const clipPath = points.map(p => `${p.x}% ${p.y}%`).join(', ');

                const gradientColors = getElegantPolygonGradient(sides);

                style.textContent = `
        .moughataas-circle::before {
            content: '';
            position: absolute;
            top: 8%;
            left: 8%;
            width: 84%;
            height: 84%;
            background: ${gradientColors};
            clip-path: polygon(${clipPath});
            z-index: 1;
            filter: drop-shadow(0 0 20px rgba(0,0,0,0.5));
            animation: elegantRotate 30s linear infinite;
        }

        .moughataas-circle::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 35%;
            height: 35%;
            background: linear-gradient(135deg,
                rgba(255,255,255,0.15) 0%,
                rgba(255,255,255,0.05) 50%,
                rgba(0,0,0,0.1) 100%
            );
            border-radius: 20px;
            transform: translate(-50%, -50%);
            z-index: 2;
            box-shadow:
                inset 0 2px 10px rgba(255,255,255,0.4),
                inset 0 -2px 10px rgba(0,0,0,0.2),
                0 0 30px rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.3);
        }

        @keyframes elegantRotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    `;

                document.head.appendChild(style);
            }

// Fonction pour calculer les points d'un polygone régulier (pour le clip-path)
            function calculatePolygonPoints(sides, centerX, radius) {
                const points = [];
                const angleStep = (2 * Math.PI) / sides;
                const startAngle = -Math.PI / 2;

                for (let i = 0; i < sides; i++) {
                    const angle = startAngle + (i * angleStep);
                    const x = centerX + radius * Math.cos(angle);
                    const y = centerX + radius * Math.sin(angle);
                    points.push({ x, y });
                }

                return points;
            }

// Couleurs élégantes et sophistiquées
            function getElegantColors(sides) {
                const elegantSets = {
                    3: [
                        {
                            primary: 'rgba(236, 72, 153, 0.9)', secondary: 'rgba(219, 39, 119, 0.9)',
                            hover: 'rgba(236, 72, 153, 1)', hoverSecondary: 'rgba(219, 39, 119, 1)',
                            border: 'rgba(236, 72, 153, 0.8)', glow: 'rgba(236, 72, 153, 0.6)'
                        },
                        {
                            primary: 'rgba(168, 85, 247, 0.9)', secondary: 'rgba(147, 51, 234, 0.9)',
                            hover: 'rgba(168, 85, 247, 1)', hoverSecondary: 'rgba(147, 51, 234, 1)',
                            border: 'rgba(168, 85, 247, 0.8)', glow: 'rgba(168, 85, 247, 0.6)'
                        },
                        {
                            primary: 'rgba(59, 130, 246, 0.9)', secondary: 'rgba(37, 99, 235, 0.9)',
                            hover: 'rgba(59, 130, 246, 1)', hoverSecondary: 'rgba(37, 99, 235, 1)',
                            border: 'rgba(59, 130, 246, 0.8)', glow: 'rgba(59, 130, 246, 0.6)'
                        }
                    ],
                    4: [
                        {
                            primary: 'rgba(168, 85, 247, 0.9)', secondary: 'rgba(147, 51, 234, 0.9)',
                            hover: 'rgba(168, 85, 247, 1)', hoverSecondary: 'rgba(147, 51, 234, 1)',
                            border: 'rgba(168, 85, 247, 0.8)', glow: 'rgba(168, 85, 247, 0.6)'
                        },
                        {
                            primary: 'rgba(99, 102, 241, 0.9)', secondary: 'rgba(79, 70, 229, 0.9)',
                            hover: 'rgba(99, 102, 241, 1)', hoverSecondary: 'rgba(79, 70, 229, 1)',
                            border: 'rgba(99, 102, 241, 0.8)', glow: 'rgba(99, 102, 241, 0.6)'
                        },
                        {
                            primary: 'rgba(59, 130, 246, 0.9)', secondary: 'rgba(37, 99, 235, 0.9)',
                            hover: 'rgba(59, 130, 246, 1)', hoverSecondary: 'rgba(37, 99, 235, 1)',
                            border: 'rgba(59, 130, 246, 0.8)', glow: 'rgba(59, 130, 246, 0.6)'
                        },
                        {
                            primary: 'rgba(168, 85, 247, 0.9)', secondary: 'rgba(147, 51, 234, 0.9)',
                            hover: 'rgba(168, 85, 247, 1)', hoverSecondary: 'rgba(147, 51, 234, 1)',
                            border: 'rgba(168, 85, 247, 0.8)', glow: 'rgba(168, 85, 247, 0.6)'
                        }
                    ],
                    5: [
                        { primary: 'rgba(239, 68, 68, 0.9)', secondary: 'rgba(220, 38, 38, 0.9)', hover: 'rgba(239, 68, 68, 1)', hoverSecondary: 'rgba(220, 38, 38, 1)', border: 'rgba(239, 68, 68, 0.8)', glow: 'rgba(239, 68, 68, 0.6)' },
                        { primary: 'rgba(245, 158, 11, 0.9)', secondary: 'rgba(217, 119, 6, 0.9)', hover: 'rgba(245, 158, 11, 1)', hoverSecondary: 'rgba(217, 119, 6, 1)', border: 'rgba(245, 158, 11, 0.8)', glow: 'rgba(245, 158, 11, 0.6)' },
                        { primary: 'rgba(34, 197, 94, 0.9)', secondary: 'rgba(22, 163, 74, 0.9)', hover: 'rgba(34, 197, 94, 1)', hoverSecondary: 'rgba(22, 163, 74, 1)', border: 'rgba(34, 197, 94, 0.8)', glow: 'rgba(34, 197, 94, 0.6)' },
                        { primary: 'rgba(20, 184, 166, 0.9)', secondary: 'rgba(13, 148, 136, 0.9)', hover: 'rgba(20, 184, 166, 1)', hoverSecondary: 'rgba(13, 148, 136, 1)', border: 'rgba(20, 184, 166, 0.8)', glow: 'rgba(20, 184, 166, 0.6)' },
                        { primary: 'rgba(168, 85, 247, 0.9)', secondary: 'rgba(147, 51, 234, 0.9)', hover: 'rgba(168, 85, 247, 1)', hoverSecondary: 'rgba(147, 51, 234, 1)', border: 'rgba(168, 85, 247, 0.8)', glow: 'rgba(168, 85, 247, 0.6)' }
                    ]
                };

                if (sides > 5) {
                    const colors = [];
                    for (let i = 0; i < sides; i++) {
                        const hue = (360 / sides) * i;
                        const primary = `hsla(${hue}, 75%, 60%, 0.9)`;
                        const secondary = `hsla(${hue}, 75%, 50%, 0.9)`;
                        const hover = `hsla(${hue}, 75%, 65%, 1)`;
                        const hoverSecondary = `hsla(${hue}, 75%, 55%, 1)`;
                        const border = `hsla(${hue}, 75%, 55%, 0.8)`;
                        const glow = `hsla(${hue}, 75%, 60%, 0.6)`;

                        colors.push({ primary, secondary, hover, hoverSecondary, border, glow });
                    }
                    return colors;
                }

                return elegantSets[sides] || elegantSets[4];
            }

// Dégradés élégants pour le fond
            function getElegantPolygonGradient(sides) {
                const elegantGradients = {
                    3: 'conic-gradient(from 0deg, #ec4899 0deg 120deg, #a855f7 120deg 240deg, #3b82f6 240deg 360deg)',
                    4: 'conic-gradient(from 0deg, #a855f7 0deg 90deg, #6366f1 90deg 180deg, #3b82f6 180deg 270deg, #a855f7 270deg 360deg)',
                    5: 'conic-gradient(from 0deg, #ef4444 0deg 72deg, #f59e0b 72deg 144deg, #22c55e 144deg 216deg, #14b8a6 216deg 288deg, #a855f7 288deg 360deg)',
                    6: 'conic-gradient(from 0deg, #ef4444 0deg 60deg, #f59e0b 60deg 120deg, #eab308 120deg 180deg, #22c55e 180deg 240deg, #3b82f6 240deg 300deg, #a855f7 300deg 360deg)'
                };

                return elegantGradients[sides] || `conic-gradient(from 0deg, ${Array.from({length: sides}, (_, i) => {
                    const hue = (360 / sides) * i;
                    return `hsl(${hue}, 75%, 55%) ${(360/sides)*i}deg ${(360/sides)*(i+1)}deg`;
                }).join(', ')})`;
            }

            function getPolygonName(sides) {
                const names = {
                    3: 'triangle',
                    4: 'carré',
                    5: 'pentagone',
                    6: 'hexagone',
                    7: 'heptagone',
                    8: 'octogone',
                    9: 'ennéagone',
                    10: 'décagone'
                };
                return names[sides] || `${sides}-gone`;
            }

// Fonction pour calculer les points du polygone avec positionnement aux bordures
            function calculatePolygonPointsForLabels(sides, centerX, containerSize) {
                const points = [];
                const angleStep = (2 * Math.PI) / sides;
                const startAngle = -Math.PI / 2; // Commencer en haut
                const radius = containerSize * 0.42; // Plus proche des bordures

                for (let i = 0; i < sides; i++) {
                    const angle = startAngle + (i * angleStep);
                    const x = centerX + radius * Math.cos(angle);
                    const y = centerX + radius * Math.sin(angle);

                    points.push({
                        x,
                        y,
                        angle: angle * (180 / Math.PI) // Convertir en degrés pour la rotation
                    });
                }

                return points;
            }

// Fonction pour calculer la rotation optimale du label selon son angle
            function calculateLabelRotation(angle, sides) {
                // Normaliser l'angle entre 0 et 360
                let normalizedAngle = ((angle % 360) + 360) % 360;

                // Pour les polygones réguliers, définir les inclinaisons selon la position
                if (sides === 4) {
                    // Pour un carré, comme dans votre image de référence
                    if (normalizedAngle > 315 || normalizedAngle <= 45) return 0;      // Haut - horizontal
                    if (normalizedAngle > 45 && normalizedAngle <= 135) return 90;     // Droite - vertical (incliné)
                    if (normalizedAngle > 135 && normalizedAngle <= 225) return 0;     // Bas - horizontal
                    if (normalizedAngle > 225 && normalizedAngle <= 315) return -90;   // Gauche - vertical (incliné)
                }

                // Pour triangle (3 côtés)
                if (sides === 3) {
                    if (normalizedAngle > 330 || normalizedAngle <= 30) return 0;      // Haut - horizontal
                    if (normalizedAngle > 30 && normalizedAngle <= 150) return 60;     // Droite - incliné
                    if (normalizedAngle > 150 && normalizedAngle <= 270) return -60;   // Gauche - incliné
                }

                // Pour pentagone (5 côtés)
                if (sides === 5) {
                    if (normalizedAngle > 342 || normalizedAngle <= 18) return 0;      // Haut
                    if (normalizedAngle > 18 && normalizedAngle <= 90) return 72;      // Haut-droite
                    if (normalizedAngle > 90 && normalizedAngle <= 162) return 90;     // Droite (vertical)
                    if (normalizedAngle > 162 && normalizedAngle <= 234) return -72;   // Bas-gauche
                    if (normalizedAngle > 234 && normalizedAngle <= 306) return -90;   // Gauche (vertical)
                }

                // Pour hexagone (6 côtés)
                if (sides === 6) {
                    if (normalizedAngle > 330 || normalizedAngle <= 30) return 0;      // Haut
                    if (normalizedAngle > 30 && normalizedAngle <= 90) return 60;      // Haut-droite
                    if (normalizedAngle > 90 && normalizedAngle <= 150) return 90;     // Droite (vertical)
                    if (normalizedAngle > 150 && normalizedAngle <= 210) return 0;     // Bas
                    if (normalizedAngle > 210 && normalizedAngle <= 270) return -90;   // Gauche (vertical)
                    if (normalizedAngle > 270 && normalizedAngle <= 330) return -60;   // Haut-gauche
                }

                // Pour les autres formes (7+ côtés), utiliser une logique générale
                // Les côtés gauche et droite sont inclinés à 90° et -90°
                const sectorSize = 360 / sides;
                const sectorIndex = Math.floor(normalizedAngle / sectorSize);
                const sectorAngle = sectorIndex * sectorSize;

                // Déterminer si c'est un côté gauche ou droite pour l'incliner
                const isLeftSide = (normalizedAngle > 180 - sectorSize/2) && (normalizedAngle < 270 + sectorSize/2);
                const isRightSide = (normalizedAngle > 90 - sectorSize/2) && (normalizedAngle < 180 + sectorSize/2);

                if (isLeftSide) return -90;  // Côté gauche - incliné verticalement
                if (isRightSide) return 90;  // Côté droite - incliné verticalement

                // Pour le haut et bas, rester horizontal
                return 0;
            }

// Fonction pour créer le fond polygonal élégant
            function createPolygonBackground(container, sides) {
                const existingStyle = document.getElementById('polygon-style');
                if (existingStyle) {
                    existingStyle.remove();
                }

                const style = document.createElement('style');
                style.id = 'polygon-style';

                const points = calculatePolygonPoints(sides, 50, 45);
                const clipPath = points.map(p => `${p.x}% ${p.y}%`).join(', ');

                const gradientColors = getElegantPolygonGradient(sides);

                style.textContent = `
        .moughataas-circle::before {
            content: '';
            position: absolute;
            top: 8%;
            left: 8%;
            width: 84%;
            height: 84%;
            background: ${gradientColors};
            clip-path: polygon(${clipPath});
            z-index: 1;
            filter: drop-shadow(0 0 20px rgba(0,0,0,0.5));
            animation: elegantRotate 30s linear infinite;
        }

        .moughataas-circle::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 35%;
            height: 35%;
            background: linear-gradient(135deg,
                rgba(255,255,255,0.15) 0%,
                rgba(255,255,255,0.05) 50%,
                rgba(0,0,0,0.1) 100%
            );
            border-radius: 20px;
            transform: translate(-50%, -50%);
            z-index: 2;
            box-shadow:
                inset 0 2px 10px rgba(255,255,255,0.4),
                inset 0 -2px 10px rgba(0,0,0,0.2),
                0 0 30px rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.3);
        }

        @keyframes elegantRotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    `;

                document.head.appendChild(style);
            }

// Fonction pour calculer les points d'un polygone régulier (pour le clip-path)
            function calculatePolygonPoints(sides, centerX, radius) {
                const points = [];
                const angleStep = (2 * Math.PI) / sides;
                const startAngle = -Math.PI / 2;

                for (let i = 0; i < sides; i++) {
                    const angle = startAngle + (i * angleStep);
                    const x = centerX + radius * Math.cos(angle);
                    const y = centerX + radius * Math.sin(angle);
                    points.push({ x, y });
                }

                return points;
            }

// Couleurs élégantes et sophistiquées
            function getElegantColors(sides) {
                const elegantSets = {
                    3: [
                        {
                            primary: 'rgba(236, 72, 153, 0.9)', secondary: 'rgba(219, 39, 119, 0.9)',
                            hover: 'rgba(236, 72, 153, 1)', hoverSecondary: 'rgba(219, 39, 119, 1)',
                            border: 'rgba(236, 72, 153, 0.8)', glow: 'rgba(236, 72, 153, 0.6)'
                        },
                        {
                            primary: 'rgba(168, 85, 247, 0.9)', secondary: 'rgba(147, 51, 234, 0.9)',
                            hover: 'rgba(168, 85, 247, 1)', hoverSecondary: 'rgba(147, 51, 234, 1)',
                            border: 'rgba(168, 85, 247, 0.8)', glow: 'rgba(168, 85, 247, 0.6)'
                        },
                        {
                            primary: 'rgba(59, 130, 246, 0.9)', secondary: 'rgba(37, 99, 235, 0.9)',
                            hover: 'rgba(59, 130, 246, 1)', hoverSecondary: 'rgba(37, 99, 235, 1)',
                            border: 'rgba(59, 130, 246, 0.8)', glow: 'rgba(59, 130, 246, 0.6)'
                        }
                    ],
                    4: [
                        {
                            primary: 'rgba(168, 85, 247, 0.9)', secondary: 'rgba(147, 51, 234, 0.9)',
                            hover: 'rgba(168, 85, 247, 1)', hoverSecondary: 'rgba(147, 51, 234, 1)',
                            border: 'rgba(168, 85, 247, 0.8)', glow: 'rgba(168, 85, 247, 0.6)'
                        },
                        {
                            primary: 'rgba(99, 102, 241, 0.9)', secondary: 'rgba(79, 70, 229, 0.9)',
                            hover: 'rgba(99, 102, 241, 1)', hoverSecondary: 'rgba(79, 70, 229, 1)',
                            border: 'rgba(99, 102, 241, 0.8)', glow: 'rgba(99, 102, 241, 0.6)'
                        },
                        {
                            primary: 'rgba(59, 130, 246, 0.9)', secondary: 'rgba(37, 99, 235, 0.9)',
                            hover: 'rgba(59, 130, 246, 1)', hoverSecondary: 'rgba(37, 99, 235, 1)',
                            border: 'rgba(59, 130, 246, 0.8)', glow: 'rgba(59, 130, 246, 0.6)'
                        },
                        {
                            primary: 'rgba(168, 85, 247, 0.9)', secondary: 'rgba(147, 51, 234, 0.9)',
                            hover: 'rgba(168, 85, 247, 1)', hoverSecondary: 'rgba(147, 51, 234, 1)',
                            border: 'rgba(168, 85, 247, 0.8)', glow: 'rgba(168, 85, 247, 0.6)'
                        }
                    ],
                    5: [
                        { primary: 'rgba(239, 68, 68, 0.9)', secondary: 'rgba(220, 38, 38, 0.9)', hover: 'rgba(239, 68, 68, 1)', hoverSecondary: 'rgba(220, 38, 38, 1)', border: 'rgba(239, 68, 68, 0.8)', glow: 'rgba(239, 68, 68, 0.6)' },
                        { primary: 'rgba(245, 158, 11, 0.9)', secondary: 'rgba(217, 119, 6, 0.9)', hover: 'rgba(245, 158, 11, 1)', hoverSecondary: 'rgba(217, 119, 6, 1)', border: 'rgba(245, 158, 11, 0.8)', glow: 'rgba(245, 158, 11, 0.6)' },
                        { primary: 'rgba(34, 197, 94, 0.9)', secondary: 'rgba(22, 163, 74, 0.9)', hover: 'rgba(34, 197, 94, 1)', hoverSecondary: 'rgba(22, 163, 74, 1)', border: 'rgba(34, 197, 94, 0.8)', glow: 'rgba(34, 197, 94, 0.6)' },
                        { primary: 'rgba(20, 184, 166, 0.9)', secondary: 'rgba(13, 148, 136, 0.9)', hover: 'rgba(20, 184, 166, 1)', hoverSecondary: 'rgba(13, 148, 136, 1)', border: 'rgba(20, 184, 166, 0.8)', glow: 'rgba(20, 184, 166, 0.6)' },
                        { primary: 'rgba(168, 85, 247, 0.9)', secondary: 'rgba(147, 51, 234, 0.9)', hover: 'rgba(168, 85, 247, 1)', hoverSecondary: 'rgba(147, 51, 234, 1)', border: 'rgba(168, 85, 247, 0.8)', glow: 'rgba(168, 85, 247, 0.6)' }
                    ]
                };

                if (sides > 5) {
                    const colors = [];
                    for (let i = 0; i < sides; i++) {
                        const hue = (360 / sides) * i;
                        const primary = `hsla(${hue}, 75%, 60%, 0.9)`;
                        const secondary = `hsla(${hue}, 75%, 50%, 0.9)`;
                        const hover = `hsla(${hue}, 75%, 65%, 1)`;
                        const hoverSecondary = `hsla(${hue}, 75%, 55%, 1)`;
                        const border = `hsla(${hue}, 75%, 55%, 0.8)`;
                        const glow = `hsla(${hue}, 75%, 60%, 0.6)`;

                        colors.push({ primary, secondary, hover, hoverSecondary, border, glow });
                    }
                    return colors;
                }

                return elegantSets[sides] || elegantSets[4];
            }

// Dégradés élégants pour le fond
            function getElegantPolygonGradient(sides) {
                const elegantGradients = {
                    3: 'conic-gradient(from 0deg, #ec4899 0deg 120deg, #a855f7 120deg 240deg, #3b82f6 240deg 360deg)',
                    4: 'conic-gradient(from 0deg, #a855f7 0deg 90deg, #6366f1 90deg 180deg, #3b82f6 180deg 270deg, #a855f7 270deg 360deg)',
                    5: 'conic-gradient(from 0deg, #ef4444 0deg 72deg, #f59e0b 72deg 144deg, #22c55e 144deg 216deg, #14b8a6 216deg 288deg, #a855f7 288deg 360deg)',
                    6: 'conic-gradient(from 0deg, #ef4444 0deg 60deg, #f59e0b 60deg 120deg, #eab308 120deg 180deg, #22c55e 180deg 240deg, #3b82f6 240deg 300deg, #a855f7 300deg 360deg)'
                };

                return elegantGradients[sides] || `conic-gradient(from 0deg, ${Array.from({length: sides}, (_, i) => {
                    const hue = (360 / sides) * i;
                    return `hsl(${hue}, 75%, 55%) ${(360/sides)*i}deg ${(360/sides)*(i+1)}deg`;
                }).join(', ')})`;
            }

            function getPolygonName(sides) {
                const names = {
                    3: 'triangle',
                    4: 'carré',
                    5: 'pentagone',
                    6: 'hexagone',
                    7: 'heptagone',
                    8: 'octogone',
                    9: 'ennéagone',
                    10: 'décagone'
                };
                return names[sides] || `${sides}-gone`;
            }
// Fonction pour calculer les points du polygone avec positionnement aux bordures
            function calculatePolygonPointsForLabels(sides, centerX, containerSize) {
                const points = [];
                const angleStep = (2 * Math.PI) / sides;
                const startAngle = -Math.PI / 2; // Commencer en haut
                const radius = containerSize * 0.42; // Plus proche des bordures

                for (let i = 0; i < sides; i++) {
                    const angle = startAngle + (i * angleStep);
                    const x = centerX + radius * Math.cos(angle);
                    const y = centerX + radius * Math.sin(angle);

                    points.push({
                        x,
                        y,
                        angle: angle * (180 / Math.PI) // Convertir en degrés pour la rotation
                    });
                }

                return points;
            }

// Fonction pour calculer la rotation optimale du label selon son angle
            function calculateLabelRotation(angle, sides) {
                // Normaliser l'angle entre 0 et 360
                let normalizedAngle = ((angle % 360) + 360) % 360;

                // Pour les polygones réguliers, aligner avec les côtés
                if (sides === 4) {
                    // Pour un carré, les labels sont horizontaux/verticaux
                    if (normalizedAngle > 315 || normalizedAngle <= 45) return 0;      // Haut
                    if (normalizedAngle > 45 && normalizedAngle <= 135) return 90;     // Droite
                    if (normalizedAngle > 135 && normalizedAngle <= 225) return 180;   // Bas
                    if (normalizedAngle > 225 && normalizedAngle <= 315) return -90;   // Gauche
                }

                // Pour les autres formes, inclinaison suivant la tangente au polygone
                let rotation = normalizedAngle + 90; // Tangente au cercle

                // Éviter les rotations trop verticales (difficiles à lire)
                if (rotation > 90 && rotation < 270) {
                    rotation += 180; // Retourner le texte pour qu'il reste lisible
                }

                // Normaliser entre -180 et 180
                if (rotation > 180) rotation -= 360;
                if (rotation < -180) rotation += 360;

                return Math.round(rotation);
            }

// Fonction pour créer le fond polygonal élégant
            function createPolygonBackground(container, sides) {
                const existingStyle = document.getElementById('polygon-style');
                if (existingStyle) {
                    existingStyle.remove();
                }

                const style = document.createElement('style');
                style.id = 'polygon-style';

                const points = calculatePolygonPoints(sides, 50, 45);
                const clipPath = points.map(p => `${p.x}% ${p.y}%`).join(', ');

                const gradientColors = getElegantPolygonGradient(sides);

                style.textContent = `
        .moughataas-circle::before {
            content: '';
            position: absolute;
            top: 8%;
            left: 8%;
            width: 84%;
            height: 84%;
            background: ${gradientColors};
            clip-path: polygon(${clipPath});
            z-index: 1;
            filter: drop-shadow(0 0 20px rgba(0,0,0,0.5));
            animation: elegantRotate 30s linear infinite;
        }

        .moughataas-circle::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 35%;
            height: 35%;
            background: linear-gradient(135deg,
                rgba(255,255,255,0.15) 0%,
                rgba(255,255,255,0.05) 50%,
                rgba(0,0,0,0.1) 100%
            );
            border-radius: 20px;
            transform: translate(-50%, -50%);
            z-index: 2;
            box-shadow:
                inset 0 2px 10px rgba(255,255,255,0.4),
                inset 0 -2px 10px rgba(0,0,0,0.2),
                0 0 30px rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.3);
        }

        @keyframes elegantRotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    `;

                document.head.appendChild(style);
            }

// Fonction pour calculer les points d'un polygone régulier (pour le clip-path)
            function calculatePolygonPoints(sides, centerX, radius) {
                const points = [];
                const angleStep = (2 * Math.PI) / sides;
                const startAngle = -Math.PI / 2;

                for (let i = 0; i < sides; i++) {
                    const angle = startAngle + (i * angleStep);
                    const x = centerX + radius * Math.cos(angle);
                    const y = centerX + radius * Math.sin(angle);
                    points.push({ x, y });
                }

                return points;
            }

// Couleurs élégantes et sophistiquées
            function getElegantColors(sides) {
                const elegantSets = {
                    3: [
                        {
                            primary: 'rgba(236, 72, 153, 0.9)', secondary: 'rgba(219, 39, 119, 0.9)',
                            hover: 'rgba(236, 72, 153, 1)', hoverSecondary: 'rgba(219, 39, 119, 1)',
                            border: 'rgba(236, 72, 153, 0.8)', glow: 'rgba(236, 72, 153, 0.6)'
                        },
                        {
                            primary: 'rgba(168, 85, 247, 0.9)', secondary: 'rgba(147, 51, 234, 0.9)',
                            hover: 'rgba(168, 85, 247, 1)', hoverSecondary: 'rgba(147, 51, 234, 1)',
                            border: 'rgba(168, 85, 247, 0.8)', glow: 'rgba(168, 85, 247, 0.6)'
                        },
                        {
                            primary: 'rgba(59, 130, 246, 0.9)', secondary: 'rgba(37, 99, 235, 0.9)',
                            hover: 'rgba(59, 130, 246, 1)', hoverSecondary: 'rgba(37, 99, 235, 1)',
                            border: 'rgba(59, 130, 246, 0.8)', glow: 'rgba(59, 130, 246, 0.6)'
                        }
                    ],
                    4: [
                        {
                            primary: 'rgba(168, 85, 247, 0.9)', secondary: 'rgba(147, 51, 234, 0.9)',
                            hover: 'rgba(168, 85, 247, 1)', hoverSecondary: 'rgba(147, 51, 234, 1)',
                            border: 'rgba(168, 85, 247, 0.8)', glow: 'rgba(168, 85, 247, 0.6)'
                        },
                        {
                            primary: 'rgba(99, 102, 241, 0.9)', secondary: 'rgba(79, 70, 229, 0.9)',
                            hover: 'rgba(99, 102, 241, 1)', hoverSecondary: 'rgba(79, 70, 229, 1)',
                            border: 'rgba(99, 102, 241, 0.8)', glow: 'rgba(99, 102, 241, 0.6)'
                        },
                        {
                            primary: 'rgba(59, 130, 246, 0.9)', secondary: 'rgba(37, 99, 235, 0.9)',
                            hover: 'rgba(59, 130, 246, 1)', hoverSecondary: 'rgba(37, 99, 235, 1)',
                            border: 'rgba(59, 130, 246, 0.8)', glow: 'rgba(59, 130, 246, 0.6)'
                        },
                        {
                            primary: 'rgba(168, 85, 247, 0.9)', secondary: 'rgba(147, 51, 234, 0.9)',
                            hover: 'rgba(168, 85, 247, 1)', hoverSecondary: 'rgba(147, 51, 234, 1)',
                            border: 'rgba(168, 85, 247, 0.8)', glow: 'rgba(168, 85, 247, 0.6)'
                        }
                    ],
                    5: [
                        { primary: 'rgba(239, 68, 68, 0.9)', secondary: 'rgba(220, 38, 38, 0.9)', hover: 'rgba(239, 68, 68, 1)', hoverSecondary: 'rgba(220, 38, 38, 1)', border: 'rgba(239, 68, 68, 0.8)', glow: 'rgba(239, 68, 68, 0.6)' },
                        { primary: 'rgba(245, 158, 11, 0.9)', secondary: 'rgba(217, 119, 6, 0.9)', hover: 'rgba(245, 158, 11, 1)', hoverSecondary: 'rgba(217, 119, 6, 1)', border: 'rgba(245, 158, 11, 0.8)', glow: 'rgba(245, 158, 11, 0.6)' },
                        { primary: 'rgba(34, 197, 94, 0.9)', secondary: 'rgba(22, 163, 74, 0.9)', hover: 'rgba(34, 197, 94, 1)', hoverSecondary: 'rgba(22, 163, 74, 1)', border: 'rgba(34, 197, 94, 0.8)', glow: 'rgba(34, 197, 94, 0.6)' },
                        { primary: 'rgba(20, 184, 166, 0.9)', secondary: 'rgba(13, 148, 136, 0.9)', hover: 'rgba(20, 184, 166, 1)', hoverSecondary: 'rgba(13, 148, 136, 1)', border: 'rgba(20, 184, 166, 0.8)', glow: 'rgba(20, 184, 166, 0.6)' },
                        { primary: 'rgba(168, 85, 247, 0.9)', secondary: 'rgba(147, 51, 234, 0.9)', hover: 'rgba(168, 85, 247, 1)', hoverSecondary: 'rgba(147, 51, 234, 1)', border: 'rgba(168, 85, 247, 0.8)', glow: 'rgba(168, 85, 247, 0.6)' }
                    ]
                };

                if (sides > 5) {
                    const colors = [];
                    for (let i = 0; i < sides; i++) {
                        const hue = (360 / sides) * i;
                        const primary = `hsla(${hue}, 75%, 60%, 0.9)`;
                        const secondary = `hsla(${hue}, 75%, 50%, 0.9)`;
                        const hover = `hsla(${hue}, 75%, 65%, 1)`;
                        const hoverSecondary = `hsla(${hue}, 75%, 55%, 1)`;
                        const border = `hsla(${hue}, 75%, 55%, 0.8)`;
                        const glow = `hsla(${hue}, 75%, 60%, 0.6)`;

                        colors.push({ primary, secondary, hover, hoverSecondary, border, glow });
                    }
                    return colors;
                }

                return elegantSets[sides] || elegantSets[4];
            }

// Dégradés élégants pour le fond
            function getElegantPolygonGradient(sides) {
                const elegantGradients = {
                    3: 'conic-gradient(from 0deg, #ec4899 0deg 120deg, #a855f7 120deg 240deg, #3b82f6 240deg 360deg)',
                    4: 'conic-gradient(from 0deg, #a855f7 0deg 90deg, #6366f1 90deg 180deg, #3b82f6 180deg 270deg, #a855f7 270deg 360deg)',
                    5: 'conic-gradient(from 0deg, #ef4444 0deg 72deg, #f59e0b 72deg 144deg, #22c55e 144deg 216deg, #14b8a6 216deg 288deg, #a855f7 288deg 360deg)',
                    6: 'conic-gradient(from 0deg, #ef4444 0deg 60deg, #f59e0b 60deg 120deg, #eab308 120deg 180deg, #22c55e 180deg 240deg, #3b82f6 240deg 300deg, #a855f7 300deg 360deg)'
                };

                return elegantGradients[sides] || `conic-gradient(from 0deg, ${Array.from({length: sides}, (_, i) => {
                    const hue = (360 / sides) * i;
                    return `hsl(${hue}, 75%, 55%) ${(360/sides)*i}deg ${(360/sides)*(i+1)}deg`;
                }).join(', ')})`;
            }

            function getPolygonName(sides) {
                const names = {
                    3: 'triangle',
                    4: 'carré',
                    5: 'pentagone',
                    6: 'hexagone',
                    7: 'heptagone',
                    8: 'octogone',
                    9: 'ennéagone',
                    10: 'décagone'
                };
                return names[sides] || `${sides}-gone`;
            }


// Fonction pour calculer les points d'un polygone régulier
            function calculatePolygonPoints(sides, centerX, radius) {
                const points = [];
                const angleStep = (2 * Math.PI) / sides;
                const startAngle = -Math.PI / 2; // Commencer en haut

                for (let i = 0; i < sides; i++) {
                    const angle = startAngle + (i * angleStep);
                    const x = centerX + radius * Math.cos(angle);
                    const y = centerX + radius * Math.sin(angle); // centerX car le container est carré
                    points.push({ x, y });
                }

                return points;
            }

// Fonction pour créer le fond polygonal
            function createPolygonBackground(container, sides) {
                // Nettoyer les anciens styles
                const existingStyle = document.getElementById('polygon-style');
                if (existingStyle) {
                    existingStyle.remove();
                }

                // Créer un nouveau style pour ce polygone
                const style = document.createElement('style');
                style.id = 'polygon-style';

                const points = calculatePolygonPoints(sides, 50, 45); // Points en pourcentage
                const clipPath = points.map(p => `${p.x}% ${p.y}%`).join(', ');

                // Créer un dégradé selon le nombre de côtés
                const gradientColors = getPolygonGradient(sides);

                style.textContent = `
        .moughataas-circle::before {
            content: '';
            position: absolute;
            top: 10%;
            left: 10%;
            width: 80%;
            height: 80%;
            background: ${gradientColors};
            clip-path: polygon(${clipPath});
            z-index: 1;
        }

        .moughataas-circle::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 45%;
            height: 45%;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border-radius: 15px;
            transform: translate(-50%, -50%);
            z-index: 2;
            box-shadow: inset 0 2px 8px rgba(255,255,255,0.3);
        }
    `;

                document.head.appendChild(style);
            }

// Fonction pour obtenir les couleurs du polygone
            function getPolygonColors(sides) {
                const colorSets = {
                    3: [ // Triangle
                        { background: 'rgba(108, 92, 231, 0.9)', border: '#6c5ce7', hover: 'rgba(108, 92, 231, 1)' },
                        { background: 'rgba(90, 103, 216, 0.9)', border: '#5a67d8', hover: 'rgba(90, 103, 216, 1)' },
                        { background: 'rgba(66, 153, 225, 0.9)', border: '#4299e1', hover: 'rgba(66, 153, 225, 1)' }
                    ],
                    4: [ // Carré (comme dans votre image)
                        { background: 'rgba(108, 92, 231, 0.9)', border: '#6c5ce7', hover: 'rgba(108, 92, 231, 1)' },
                        { background: 'rgba(90, 103, 216, 0.9)', border: '#5a67d8', hover: 'rgba(90, 103, 216, 1)' },
                        { background: 'rgba(66, 153, 225, 0.9)', border: '#4299e1', hover: 'rgba(66, 153, 225, 1)' },
                        { background: 'rgba(108, 92, 231, 0.9)', border: '#6c5ce7', hover: 'rgba(108, 92, 231, 1)' }
                    ],
                    5: [ // Pentagone
                        { background: 'rgba(231, 76, 60, 0.9)', border: '#e74c3c', hover: 'rgba(231, 76, 60, 1)' },
                        { background: 'rgba(155, 89, 182, 0.9)', border: '#9b59b6', hover: 'rgba(155, 89, 182, 1)' },
                        { background: 'rgba(52, 152, 219, 0.9)', border: '#3498db', hover: 'rgba(52, 152, 219, 1)' },
                        { background: 'rgba(26, 188, 156, 0.9)', border: '#1abc9c', hover: 'rgba(26, 188, 156, 1)' },
                        { background: 'rgba(241, 196, 15, 0.9)', border: '#f1c40f', hover: 'rgba(241, 196, 15, 1)' }
                    ]
                };

                // Pour plus de 5 côtés, générer des couleurs dynamiquement
                if (sides > 5) {
                    const colors = [];
                    for (let i = 0; i < sides; i++) {
                        const hue = (360 / sides) * i;
                        colors.push({
                            background: `hsla(${hue}, 70%, 55%, 0.9)`,
                            border: `hsl(${hue}, 70%, 45%)`,
                            hover: `hsla(${hue}, 70%, 65%, 1)`
                        });
                    }
                    return colors;
                }

                return colorSets[sides] || colorSets[4];
            }

// Fonction pour obtenir le dégradé du polygone
            function getPolygonGradient(sides) {
                const gradients = {
                    3: 'conic-gradient(from 0deg, #e74c3c 0deg 120deg, #9b59b6 120deg 240deg, #3498db 240deg 360deg)',
                    4: 'conic-gradient(from 0deg, #6c5ce7 0deg 90deg, #5a67d8 90deg 180deg, #4299e1 180deg 270deg, #6c5ce7 270deg 360deg)',
                    5: 'conic-gradient(from 0deg, #e74c3c 0deg 72deg, #9b59b6 72deg 144deg, #3498db 144deg 216deg, #1abc9c 216deg 288deg, #f1c40f 288deg 360deg)',
                    6: 'conic-gradient(from 0deg, #e74c3c 0deg 60deg, #f39c12 60deg 120deg, #f1c40f 120deg 180deg, #2ecc71 180deg 240deg, #3498db 240deg 300deg, #9b59b6 300deg 360deg)'
                };

                return gradients[sides] || `conic-gradient(from 0deg, ${Array.from({length: sides}, (_, i) => {
                    const hue = (360 / sides) * i;
                    const nextHue = (360 / sides) * (i + 1);
                    return `hsl(${hue}, 70%, 55%) ${(360/sides)*i}deg ${(360/sides)*(i+1)}deg`;
                }).join(', ')})`;
            }

// Fonction pour obtenir le nom du polygone
            function getPolygonName(sides) {
                const names = {
                    3: 'triangle',
                    4: 'carré',
                    5: 'pentagone',
                    6: 'hexagone',
                    7: 'heptagone',
                    8: 'octogone',
                    9: 'ennéagone',
                    10: 'décagone'
                };
                return names[sides] || `polygone à ${sides} côtés`;
            }

            window.openMoughataasPanel = function(wilayaId) {
                loadMoughataas(wilayaId);
            };

            function nextWilaya() {
                if (isAnimationPaused || allLayers.length === 0) return;

                currentLayerIndex = (currentLayerIndex + 1) % allLayers.length;
                highlightWilaya(allLayers[currentLayerIndex]);
            }

            function startAnimation() {
                if (animationInterval) clearInterval(animationInterval);
                animationInterval = setInterval(nextWilaya, 5000);
            }

            function pauseAnimation() {
                if (isAnimationPaused) return;

                isAnimationPaused = true;
                clearInterval(animationInterval);

                const pauseIndicator = document.getElementById('pauseIndicator');
                if (pauseIndicator) {
                    pauseIndicator.style.display = 'block';
                    setTimeout(() => {
                        pauseIndicator.style.display = 'none';
                        isAnimationPaused = false;
                        startAnimation();
                    }, 3000);
                }
            }

            fetch("{{ asset('assets/geojson/mauritania-wilayas.json') }}")
                .then(response => response.json())
                .then(geojsonData => {
                    const geojsonLayer = L.geoJSON(geojsonData, {
                        style: function(feature) {
                            const wilayaName = feature.properties.name;
                            const normalizedWilayaName = normalizeName(wilayaName);
                            const wilayaStats = wilayasData.find(w => normalizeName(w.nom) === normalizedWilayaName);

                            let fillColor = '#a0aec0';
                            if (wilayaStats) {
                                const rate = wilayaStats.population > 0 ?
                                    (wilayaStats.participants / wilayaStats.population) * 100 : 0;
                                fillColor = getColorByRate(rate);
                            }

                            return {
                                fillColor: fillColor,
                                weight: 2,
                                opacity: 1,
                                color: 'white',
                                fillOpacity: 0.7
                            };
                        },
                        onEachFeature: function(feature, layer) {
                            allLayers.push(layer);

                            const center = layer.getBounds().getCenter();
                            L.tooltip({
                                permanent: true,
                                direction: "center",
                                className: "wilaya-label"
                            })
                                .setContent(feature.properties.name)
                                .setLatLng(center)
                                .addTo(map);

                            layer.on('click', function(e) {
                                clearInterval(animationInterval);
                                currentLayerIndex = allLayers.indexOf(layer);
                                highlightWilaya(layer);
                                const wilayaName = feature.properties.name;
                                const normalizedWilayaName = normalizeName(wilayaName);
                                const wilayaStats = wilayasData.find(w => normalizeName(w.nom) === normalizedWilayaName);
                                if (wilayaStats && wilayaStats.id) {
                                    loadMoughataas(wilayaStats.id);
                                }
                                pauseAnimation();
                            });
                        }
                    }).addTo(map);

                    const legend = L.control({position: 'bottomleft'});
                    legend.onAdd = function(map) {
                        const div = L.DomUtil.create('div', 'legend');
                        div.innerHTML = `
                    <h4>Taux de Participation</h4>
                    <div class="legend-item"><div class="legend-color" style="background-color:#38a169"></div> > 50%</div>
                    <div class="legend-item"><div class="legend-color" style="background-color:#ecc94b"></div> 30% - 50%</div>
                    <div class="legend-item"><div class="legend-color" style="background-color:#ed8936"></div> 10% - 30%</div>
                    <div class="legend-item"><div class="legend-color" style="background-color:#e53e3e"></div> < 10%</div>
                `;
                        return div;
                    };
                    legend.addTo(map);

                    if (allLayers.length > 0) {
                        highlightWilaya(allLayers[0]);
                        startAnimation();
                    }
                })
                .catch(error => {
                    console.error('Erreur de chargement du GeoJSON:', error);
                });
        });
    </script>
@endsection
