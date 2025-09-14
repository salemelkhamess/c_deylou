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

        .header-section {
            background: linear-gradient(135deg, var(--deep-blue) 0%, var(--medium-blue) 100%);
            color: var(--white);
            padding: 40px 0;
            margin-bottom: 30px;
            border-bottom: 4px solid var(--gold);
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 20px var(--shadow);
        }

        .header-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
            font-family: 'Playfair Display', serif;
        }

        .header-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto;
            font-family: 'Roboto', sans-serif;
        }

        /* Map container */
        .map-container {
            width: 100%;
            max-width: 1500px;
            height: 750px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 40px var(--shadow);
            margin: 40px auto;
            position: relative;
            background: var(--light-gray);
            transition: all 0.3s ease;
        }

        #map {
            width: 100% !important;
            height: 100% !important;
            z-index: 0;
            cursor: pointer !important;
            background: #e0e7ff;
            transition: transform 0.3s ease;
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
            min-width: 300px; /* Agrandi la largeur du tooltip */
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

        /* Current wilaya display */
        .current-wilaya-display {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            padding: 12px 25px;
            border-radius: 10px;
            box-shadow: 0 3px 15px var(--shadow);
            font-weight: 700;
            color: var(--deep-blue);
            text-align: center;
            min-width: 280px;
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .current-wilaya-display:hover {
            transform: translateX(-50%) translateY(-5px);
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

    <!-- Interactive Map of Mauritania -->
    <section class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="elegant-card">
                    <div class="elegant-card-header text-center">
                        <i class="fas fa-map-marked-alt me-2"></i>
                        Carte Interactive des Résultats
                    </div>
                    <div class="elegant-card-body p-0 position-relative">
                        <div class="map-container">
                            <div id="map"></div>

                            <div class="progress-indicator" id="progressIndicator">
                                Wilaya 1 sur {{ count($wilayas) }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Voting Section -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h1 class="text-center mb-5">Questions de Vote</h1>

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

                    // Ajouter le lien vers les détails des Moughataa
                    if (wilayaId && moughataasByWilaya[wilayaId]) {
                        tooltipContent += `
                            <div style="text-align: center; margin-top: 10px;">
                                <button onclick="window.openWilayaDetails(${wilayaId})"
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

                // Rendre le tooltip cliquable
                const tooltipElement = currentTooltip.getElement();
                if (tooltipElement) {
                    tooltipElement.style.pointerEvents = 'auto';

                    // Ajouter un gestionnaire d'événements pour les clics sur les boutons
                    const buttons = tooltipElement.querySelectorAll('button');
                    buttons.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.stopPropagation(); // Empêcher la propagation du événement
                            const wilayaId = this.getAttribute('onclick').match(/\d+/)[0];
                            window.openWilayaDetails(wilayaId);
                        });
                    });
                }

                document.getElementById('progressIndicator').textContent =
                    `Wilaya ${allLayers.indexOf(layer) + 1} sur ${allLayers.length}`;
            }

            // Fonction globale pour ouvrir les détails de la wilaya
            window.openWilayaDetails = function(wilayaId) {
                window.location.href = `${baseUrl}/wilaya/${wilayaId}/moughataas`;
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
