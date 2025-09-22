@extends('fronts.base')

@section('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    :root {
        --green: #22c55e; /* Vert vif */
        --red: #ef4444; /* Rouge vibrant */
        --yellow: #facc15; /* Jaune éclatant */
        --dark: #1f2937; /* Gris foncé pour contraste */
        --light-gray: #f1f5f9; /* Gris clair conservé */
        --shadow: rgba(0, 0, 0, 0.15); /* Ombre conservée */
    }

    html[dir="rtl"] {
        font-family: 'Tajawal', sans-serif;
    }

    html[dir="rtl"] .wilaya-label {
        font-family: 'Tajawal', sans-serif;
        direction: rtl;
        text-align: center;
        font-size: 14px;
        line-height: 1.5;
    }

    html[dir="rtl"] .custom-tooltip-content {
        font-family: 'Tajawal', sans-serif;
        direction: rtl;
        text-align: right;
        border-left: none;
        border-right: 5px solid var(--yellow);
        padding: 15px 20px;
        line-height: 1.6;
    }

    html[dir="rtl"] .custom-tooltip-content h6 {
        font-family: 'Tajawal', sans-serif;
        text-align: right;
    }

    html[dir="rtl"] .custom-tooltip-content button {
        font-family: 'Tajawal', sans-serif;
    }

    html[dir="rtl"] .moughataa-label.elegant-border {
        font-family: 'Tajawal', sans-serif;
        direction: rtl;
        text-align: center;
        font-size: 14px;
        line-height: 1.5;
    }

    html[dir="rtl"] .moughataa-label.elegant-border[style*="rotate(90deg)"],
    html[dir="rtl"] .moughataa-label.elegant-border[style*="rotate(-90deg)"] {
        writing-mode: vertical-rl;
        text-orientation: mixed;
        font-size: 13px;
        padding: 12px 16px;
        transform: translate(-50%, -50%) rotate(var(--rotation, 0deg)) !important;
    }

    html[dir="rtl"] .legend {
        right: auto;
        left: 20px;
        text-align: right;
    }

    html[dir="rtl"] .legend h4,
    html[dir="rtl"] .legend-item {
        font-family: 'Tajawal', sans-serif;
    }

    html[dir="rtl"] .progress-indicator,
    html[dir="rtl"] .pause-indicator {
        font-family: 'Tajawal', sans-serif;
        direction: rtl;
    }

    html[dir="rtl"] .moughataas-center,
    html[dir="rtl"] .moughataas-center strong,
    html[dir="rtl"] .moughataas-center .shape-name,
    html[dir="rtl"] .no-moughataas {
        font-family: 'Tajawal', sans-serif;
        direction: rtl;
        text-align: center;
    }


    /* Carousel RTL Support */
    html[lang="ar"] .carousel-caption {
        direction: rtl;
        text-align: right;
    }

    html[lang="ar"] .carousel-control-prev {
        right: 0;
        left: auto;
    }

    html[lang="ar"] .carousel-control-next {
        left: 0;
        right: auto;
    }



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

    .leaflet-control-zoom {
        display: none !important;
    }

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
        z-index: 2000;
        position: absolute;
    }

    .custom-tooltip-content {
        background: rgba(255, 255, 255, 0.97);
        backdrop-filter: blur(12px);
        color: var(--dark);
        border-radius: 12px;
        box-shadow: 0 6px 25px var(--shadow);
        padding: 20px;
        border-left: 5px solid var(--yellow);
        font-family: 'Roboto', sans-serif;
        font-size: 15px;
        white-space: normal;
        transition: opacity 0.3s ease, transform 0.3s ease;
        min-width: 300px;
        z-index: 2001;
        position: relative;
    }

    .custom-tooltip h6 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 18px;
        margin: 0 0 12px 0;
        color: var(--green);
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    .custom-tooltip b {
        color: var(--red);
        font-weight: 600;
    }

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
        color: var(--green);
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

    .wilaya-label {
        background: transparent;
        border: none;
        box-shadow: none;
        font-family: 'Roboto', sans-serif;
        font-weight: 700;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.95);
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
        pointer-events: none;
        letter-spacing: 0.6px;
        transition: opacity 0.3s ease;
        text-align: center;
        padding: 2px 5px;
        transform: translate(-50%, -50%);
        z-index: 1500;
    }

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
        color: var(--green);
        text-align: center;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        display: none;
    }

    .moughataas-circle {
        width: 400px;
        height: 400px;
        border-radius: 50%;
        position: relative;
        margin: 60px auto 0 auto;
        background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.1) 0%, transparent 50%),
        linear-gradient(135deg, var(--red) 0%, #b91c1c 30%, #991b1b 70%, #7f1d1d 100%);
        display: none;
        overflow: visible;
        box-shadow: 0 0 50px rgba(239, 68, 68, 0.4),
        0 8px 32px rgba(0,0,0,0.6),
        inset 0 2px 4px rgba(255,255,255,0.1),
        inset 0 -2px 4px rgba(0,0,0,0.3);
        border: 2px solid transparent;
        background-clip: padding-box;
        z-index: 1000;
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
        text-shadow: 0 2px 4px rgba(0,0,0,0.8),
        0 0 10px rgba(255,255,255,0.3);
        background: linear-gradient(135deg, rgba(255,255,255,0.25) 0%, rgba(255,255,255,0.1) 50%, rgba(255,255,255,0.05) 100%);
        padding: 16px 20px;
        border-radius: 20px;
        backdrop-filter: blur(20px);
        border: 2px solid rgba(255,255,255,0.4);
        box-shadow: 0 8px 32px rgba(0,0,0,0.4),
        inset 0 1px 0 rgba(255,255,255,0.5),
        0 0 20px rgba(255,255,255,0.1);
        min-width: 120px;
    }

    .moughataas-center strong {
        font-size: 28px;
        display: block;
        margin-bottom: 6px;
        background: linear-gradient(45deg, var(--yellow), #fef9c3);
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
    }

    .moughataa-label.elegant-border[style*="rotate(90deg)"],
    .moughataa-label.elegant-border[style*="rotate(-90deg)"] {
        writing-mode: vertical-rl;
        text-orientation: mixed;
        background: linear-gradient(45deg, var(--green), #16a34a) !important;
        border: 2px solid var(--green) !important;
        box-shadow: 0 6px 25px rgba(34, 197, 94, 0.4),
        inset 0 2px 0 rgba(255,255,255,0.3),
        0 0 15px rgba(34, 197, 94, 0.3) !important;
    }

    .moughataa-label.elegant-border[style*="rotate(90deg)"]:hover,
    .moughataa-label.elegant-border[style*="rotate(-90deg)"]:hover {
        background: linear-gradient(45deg, var(--green), #22d3ee) !important;
        box-shadow: 0 8px 35px rgba(34, 197, 94, 0.6),
        inset 0 2px 0 rgba(255,255,255,0.4),
        0 0 0 3px rgba(34, 197, 94, 0.8),
        0 0 25px rgba(34, 197, 94, 0.5) !important;
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

    .moughataas-circle::after {
        animation: centerGlow 4s ease-in-out infinite;
    }

    @keyframes centerGlow {
        0%, 100% {
            box-shadow: inset 0 2px 10px rgba(255,255,255,0.4),
            inset 0 -2px 10px rgba(0,0,0,0.2),
            0 0 30px rgba(255,255,255,0.1);
        }
        50% {
            box-shadow: inset 0 2px 10px rgba(255,255,255,0.6),
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

    .moughataas-circle:has(.moughataa-label:hover) .moughataa-label:not(:hover) {
        filter: blur(1px) brightness(0.7);
        transform-origin: center;
        transition: all 0.3s ease;
    }

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

    .moughataas-circle[data-sides="3"] {
        box-shadow: 0 0 60px rgba(34, 197, 94, 0.4),
        0 8px 32px rgba(0,0,0,0.6),
        inset 0 2px 4px rgba(255,255,255,0.1);
    }

    .moughataas-circle[data-sides="4"] {
        box-shadow: 0 0 60px rgba(239, 68, 68, 0.4),
        0 8px 32px rgba(0,0,0,0.6),
        inset 0 2px 4px rgba(255,255,255,0.1);
    }

    .moughataas-circle[data-sides="5"] {
        box-shadow: 0 0 60px rgba(245, 158, 11, 0.4),
        0 8px 32px rgba(0,0,0,0.6),
        inset 0 2px 4px rgba(255,255,255,0.1);
    }

    .moughataas-circle[data-sides="6"] {
        box-shadow: 0 0 60px rgba(34, 197, 94, 0.4),
        0 8px 32px rgba(0,0,0,0.6),
        inset 0 2px 4px rgba(255,255,255,0.1);
    }

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

    .moughataa-label.elegant-border:focus {
        outline: 3px solid rgba(255, 255, 255, 0.8);
        outline-offset: 3px;
    }

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

    .map-row {
        direction: ltr !important;
    }

    .map-row * {
        direction: ltr !important;
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
                    // Correction : utiliser 'fr' au lieu de 'en' comme fallback
                    $titre = $locale === 'ar' ? $slide->title_ar : ($locale === 'fr' ? $slide->title_fr : $slide->title_fr);
                    $description = $locale === 'ar' ? $slide->description_ar : ($locale === 'fr' ? $slide->description_fr : $slide->description_fr);

                    // Correction : définir correctement la direction
                    $direction = $locale === 'ar' ? 'rtl' : 'ltr';
                    $textAlign = $locale === 'ar' ? 'right' : 'left';
                @endphp

                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="carousel-image" style="background-image: url('{{ asset('storage/' . $slide->image_path) }}'); position: relative;">
                        <div class="carousel-caption"
                             style="direction: {{ $direction }}; text-align: center; position: absolute;
            {{ $locale === 'ar' ? 'right: 50%; transform: translateX(50%);' : 'left: 50%; transform: translateX(-50%);' }}
            bottom: 20px; width: 90%; max-width: 900px; padding: 20px; box-sizing: border-box;">
                            <h5 style="color: #ffffff; font-size: 24px; margin: 0; text-shadow: 1px 1px 4px rgba(0,0,0,0.6);">{{ $titre }}</h5>
                            <p style="color: #ffffff; font-size: 16px; margin: 10px 0 0; text-shadow: 1px 1px 4px rgba(0,0,0,0.6);">{{ $description }}</p>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <!-- Correction des boutons de navigation pour RTL -->
        @if(app()->getLocale() === 'ar')
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">{{ __('messages.next') }}</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">{{ __('messages.previous') }}</span>
            </button>
        @else
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">{{ __('messages.previous') }}</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">{{ __('messages.next') }}</span>
            </button>
        @endif
    </div>



    <!-- Map and Moughataas Panel -->
    <div class="row mt-5 map-row">
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
            const locale = @json(app()->getLocale());
            let allLayers = [];
            let currentLayerIndex = 0;
            let animationInterval;
            let currentTooltip = null;
            let isAnimationPaused = false;
            let moughataaLayers = [];

            const moughataaColors = [
                '#38a169', '#d64161', '#38a169', '#fdcb6e',
                '#38a169', '#d64161', '#38a169', '#fdcb6e',
                '#38a169', '#d64161', '#38a169', '#fdcb6e',
            ];

            function getColorByRate(rate) {
                return rate > 50 ? '#38a169' :
                    rate > 30 ? '#ecc94b' :
                        rate > 10 ? '#38a169' : '#e53e3e';
            }

            function clearPreviousAnimation() {
                if (currentTooltip) {
                    map.closeTooltip(currentTooltip);
                    currentTooltip = null;
                }

                allLayers.forEach(l => {
                    const wilayaCode = l.feature.properties.id.replace('MR', '');
                    const wilayaStats = wilayasData.find(w => w.code === wilayaCode);

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

                const wilayaCode = layer.feature.properties.id.replace('MR', '');
                const wilayaStats = wilayasData.find(w => w.code === wilayaCode);
                const wilayaName = locale === 'ar' ?
                    (wilayaStats?.nom_ar || layer.feature.properties.name) :
                    layer.feature.properties.name;
                const wilayaId = wilayaStats ? wilayaStats.id : null;

                console.log(`Highlighting wilaya: ${layer.feature.properties.name}, Code: ${wilayaCode}, Arabic Name: ${wilayaStats?.nom_ar || 'Not found'}, ID: ${wilayaId || 'Not found'}`);

                let tooltipContent = `<div class="custom-tooltip-content"><h6>${wilayaName}</h6>`;
                if (wilayaStats) {
                    const rate = wilayaStats.population > 0 ?
                        ((wilayaStats.participants / wilayaStats.population) * 100).toFixed(2) : 0;
                    tooltipContent += `
            <b>${locale === 'ar' ? 'السكان' : 'Population'}:</b> ${Number(wilayaStats.population).toLocaleString()}<br>
            <b>${locale === 'ar' ? 'المشاركون' : 'Participants'}:</b> ${Number(wilayaStats.participants).toLocaleString()}<br>
            <b>${locale === 'ar' ? 'النسبة' : 'Taux'}:</b> ${rate}%<br><br>
        `;
                    if (wilayaId) {
                        tooltipContent += `
                <div style="text-align: ${locale === 'ar' ? 'right' : 'center'}; margin-top: 10px;">
                    <button onclick="window.openMoughataasPanel(${wilayaId})"
                            class="btn btn-primary btn-sm"
                            style="background-color: var(--deep-blue); border: none; padding: 5px 15px; border-radius: 5px; color: white; cursor: pointer;">
                        ${locale === 'ar' ? 'عرض المقاطعات' : 'Voir les Moughataa'}
                    </button>
                </div>
            `;
                    }
                } else {
                    tooltipContent += `<i>${locale === 'ar' ? 'لا توجد بيانات متاحة' : 'Aucune donnée disponible'}</i>`;
                }
                tooltipContent += `</div>`;

                try {
                    // Get the wilaya's center and map boundaries
                    const center = layer.getBounds().getCenter();
                    const mapBounds = map.getBounds();
                    const mapWidth = map.getSize().x;
                    const mapCenterX = mapWidth / 2;

                    // Determine tooltip direction based on wilaya position
                    let direction = 'auto';
                    let offset = [0, 0];
                    const pixelCenter = map.latLngToContainerPoint(center).x;

                    if (pixelCenter < mapCenterX * 0.4) { // Left side of the map
                        direction = 'right';
                        offset = locale === 'ar' ? [30, 0] : [20, 0]; // Increased offset for left-border wilayas
                    } else if (pixelCenter > mapCenterX * 1.6) { // Right side
                        direction = 'left';
                        offset = locale === 'ar' ? [-30, 0] : [-20, 0];
                    } else if (center.lat > mapBounds.getCenter().lat) { // Top half
                        direction = 'bottom';
                        offset = [0, 20];
                    } else { // Bottom half
                        direction = 'top';
                        offset = [0, -20];
                    }

                    console.log(`Tooltip for ${wilayaName}: Direction=${direction}, Offset=${offset}, PixelX=${pixelCenter}`);

                    currentTooltip = L.tooltip({
                        permanent: true,
                        direction: direction,
                        className: 'custom-tooltip',
                        offset: offset,
                        opacity: 1,
                        interactive: true
                    }).setContent(tooltipContent).setLatLng(center).addTo(map);

                    const tooltipElement = currentTooltip.getElement();
                    if (tooltipElement) {
                        tooltipElement.style.pointerEvents = 'auto';
                        tooltipElement.style.zIndex = '2001';
                        tooltipElement.style.opacity = '1';
                        const buttons = tooltipElement.querySelectorAll('button');
                        buttons.forEach(button => {
                            button.addEventListener('click', function(e) {
                                e.stopPropagation();
                                const wilayaId = this.getAttribute('onclick').match(/\d+/)[0];
                                window.openMoughataasPanel(wilayaId);
                            });
                        });
                    } else {
                        console.error('Tooltip element not found');
                    }
                } catch (error) {
                    console.error('Error creating tooltip:', error);
                }

                document.getElementById('progressIndicator').textContent =
                    `${locale === 'ar' ? 'ولاية' : 'Wilaya'} ${allLayers.indexOf(layer) + 1} ${locale === 'ar' ? 'من' : 'sur'} ${allLayers.length}`;
            }

            function loadMoughataas(wilayaId) {
                fetch(`${baseUrl}/api/wilaya/${wilayaId}/moughataas`)
                    .then(res => res.json())
                    .then(data => {
                        console.log('Moughataas data:', data);
                        const container = document.getElementById('moughataasCircle');
                        container.innerHTML = '';

                        if (!data.moughataas || data.moughataas.length === 0) {
                            container.innerHTML = `<p class="no-moughataas">${locale === 'ar' ? 'لا توجد مقاطعات متاحة' : 'Aucune Moughataa disponible'}</p>`;
                            container.classList.add('show');
                            return;
                        }

                        const totalMoughataas = data.moughataas.length;
                        const containerSize = window.innerWidth <= 768 ? 320 : 400;
                        const center = containerSize / 2;
                        container.setAttribute('data-sides', totalMoughataas);
                        createPolygonBackground(container, totalMoughataas);

                        const polygonPoints = calculatePolygonPointsForLabels(totalMoughataas, center, containerSize);

                        data.moughataas.forEach((moughataa, index) => {
                            const point = polygonPoints[index];
                            const angle = point.angle;
                            const rotation = calculateLabelRotation(angle, totalMoughataas);

                            const label = document.createElement('div');
                            label.className = 'moughataa-label elegant-border';
                            label.setAttribute('lang', locale);

                            label.style.position = 'absolute';
                            label.style.left = `${point.x}px`;
                            label.style.top = `${point.y}px`;
                            label.style.transform = `translate(-50%, -50%) rotate(${rotation}deg)`;
                            label.style.setProperty('--rotation', `${rotation}deg`);
                            label.style.zIndex = '15';
                            label.style.padding = locale === 'ar' ? '12px 16px' : '10px 20px';
                            label.style.borderRadius = '25px';
                            label.style.color = 'white';
                            label.style.fontSize = locale === 'ar' ? '14px' : '13px';
                            label.style.fontWeight = '600';
                            label.style.textAlign = 'center';
                            label.style.minWidth = locale === 'ar' ? '120px' : '100px';
                            label.style.maxWidth = locale === 'ar' ? '180px' : '160px';
                            label.style.transition = 'all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                            label.style.backdropFilter = 'blur(10px)';
                            label.style.whiteSpace = 'nowrap';
                            label.style.overflow = 'hidden';
                            label.style.textOverflow = 'ellipsis';
                            label.style.boxShadow = '0 4px 20px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.2)';
                            label.style.letterSpacing = locale === 'ar' ? '1px' : '0.5px';
                            label.style.textShadow = '0 1px 3px rgba(0,0,0,0.8)';
                            label.style.border = '1px solid rgba(255,255,255,0.3)';

                            if (Math.abs(rotation) === 90 && locale === 'ar') {
                                label.style.writingMode = 'vertical-rl';
                                label.style.textOrientation = 'mixed';
                                label.style.minWidth = '140px';
                                label.style.maxWidth = '200px';
                                label.style.padding = '14px 18px';
                                label.style.fontSize = '13px';
                            }

                            const displayName = locale === 'ar' ? (moughataa.nom_ar || moughataa.nom_fr || `Moughataa ${index + 1}`)
                                : locale === 'en' ? (moughataa.nom_en || moughataa.nom_fr || `Moughataa ${index + 1}`)
                                    : (moughataa.nom_fr || moughataa.nom_ar || `Moughataa ${index + 1}`);

                            console.log(`Moughataa ${index + 1}: ${displayName}, ID: ${moughataa.id || 'Not found'}`);

                            label.textContent = displayName;
                            label.title = displayName;

                            if (moughataa.id) {
                                label.addEventListener('click', () => {
                                    const moughataaRoute = @json(route('moughataas.events', ['id' => ':id']));
                                    const url = moughataaRoute.replace(':id', moughataa.id);
                                    window.location.href = url;
                                });
                                label.style.cursor = 'pointer';

                                const colors = getElegantColors(totalMoughataas);
                                const color = colors[index % colors.length];
                                label.style.background = `linear-gradient(135deg, ${color.primary} 0%, ${color.secondary} 100%)`;
                                label.style.boxShadow = `0 4px 20px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.2), 0 0 0 2px ${color.border}`;

                                label.addEventListener('mouseenter', function() {
                                    this.style.transform = `translate(-50%, -50%) rotate(${rotation}deg) scale(1.15)`;
                                    this.style.zIndex = '25';
                                    this.style.background = `linear-gradient(135deg, ${color.hover} 0%, ${color.hoverSecondary} 100%)`;
                                    this.style.boxShadow = `0 8px 35px rgba(0,0,0,0.6), inset 0 2px 0 rgba(255,255,255,0.4), 0 0 0 3px ${color.border}, 0 0 20px ${color.glow}`;
                                    this.style.letterSpacing = locale === 'ar' ? '1.5px' : '1px';
                                });

                                label.addEventListener('mouseleave', function() {
                                    this.style.transform = `translate(-50%, -50%) rotate(${rotation}deg) scale(1)`;
                                    this.style.zIndex = '15';
                                    this.style.background = `linear-gradient(135deg, ${color.primary} 0%, ${color.secondary} 100%)`;
                                    this.style.boxShadow = `0 4px 20px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.2), 0 0 0 2px ${color.border}`;
                                    this.style.letterSpacing = locale === 'ar' ? '1px' : '0.5px';
                                });
                            }

                            label.style.opacity = '0';
                            label.style.transform = `translate(-50%, -50%) rotate(${rotation}deg) scale(0.3)`;
                            setTimeout(() => {
                                label.style.opacity = '1';
                                label.style.transform = `translate(-50%, -50%) rotate(${rotation}deg) scale(1)`;
                            }, 200 + (index * 150));

                            container.appendChild(label);
                        });

                        const centerLabel = document.createElement('div');
                        centerLabel.className = 'moughataas-center';
                        centerLabel.innerHTML = `
                            <strong>${totalMoughataas}</strong>
                            <span class="shape-name"></span>
                        `;
                        container.appendChild(centerLabel);

                        container.classList.add('show');
                        console.log(`${totalMoughataas} moughataas affichées en ${getPolygonName(totalMoughataas)}`);
                    })
                    .catch(error => {
                        console.error('Erreur lors du chargement des moughataas:', error);
                        const container = document.getElementById('moughataasCircle');
                        container.innerHTML = `<p class="no-moughataas">${locale === 'ar' ? 'خطأ في التحميل' : 'Erreur de chargement'}</p>`;
                        container.classList.add('show');
                    });
            }

            function calculatePolygonPointsForLabels(sides, centerX, containerSize) {
                const points = [];
                const angleStep = (2 * Math.PI) / sides;
                const startAngle = -Math.PI / 2;
                const radius = containerSize * 0.42;

                for (let i = 0; i < sides; i++) {
                    const angle = startAngle + (i * angleStep);
                    const x = centerX + radius * Math.cos(angle);
                    const y = centerX + radius * Math.sin(angle);

                    points.push({
                        x,
                        y,
                        angle: angle * (180 / Math.PI)
                    });
                }

                return points;
            }

            function calculateLabelRotation(angle, sides) {
                let normalizedAngle = ((angle % 360) + 360) % 360;

                if (sides === 4) {
                    if (normalizedAngle > 315 || normalizedAngle <= 45) return 0;
                    if (normalizedAngle > 45 && normalizedAngle <= 135) return locale === 'ar' ? -90 : 90;
                    if (normalizedAngle > 135 && normalizedAngle <= 225) return 180;
                    if (normalizedAngle > 225 && normalizedAngle <= 315) return locale === 'ar' ? 90 : -90;
                }

                let rotation = normalizedAngle + 90;
                if (locale === 'ar') {
                    rotation += 180;
                }
                if (rotation > 180) rotation -= 360;
                if (rotation < -180) rotation += 360;

                return Math.round(rotation);
            }

            function getElegantColors(sides) {
                const elegantSets = {
                    3: [
                        {
                            primary: 'rgba(34, 197, 94, 0.9)',
                            secondary: 'rgba(22, 163, 74, 0.9)',
                            hover: 'rgba(34, 197, 94, 1)',
                            hoverSecondary: 'rgba(22, 163, 74, 1)',
                            border: 'rgba(34, 197, 94, 0.8)',
                            glow: 'rgba(34, 197, 94, 0.6)'
                        },
                        {
                            primary: 'rgba(239, 68, 68, 0.9)',
                            secondary: 'rgba(220, 38, 38, 0.9)',
                            hover: 'rgba(239, 68, 68, 1)',
                            hoverSecondary: 'rgba(220, 38, 38, 1)',
                            border: 'rgba(239, 68, 68, 0.8)',
                            glow: 'rgba(239, 68, 68, 0.6)'
                        },
                        {
                            primary: 'rgba(245, 158, 11, 0.9)',
                            secondary: 'rgba(217, 119, 6, 0.9)',
                            hover: 'rgba(245, 158, 11, 1)',
                            hoverSecondary: 'rgba(217, 119, 6, 1)',
                            border: 'rgba(245, 158, 11, 0.8)',
                            glow: 'rgba(245, 158, 11, 0.6)'
                        }
                    ],
                    4: [
                        {
                            primary: 'rgba(34, 197, 94, 0.9)',
                            secondary: 'rgba(22, 163, 74, 0.9)',
                            hover: 'rgba(34, 197, 94, 1)',
                            hoverSecondary: 'rgba(22, 163, 74, 1)',
                            border: 'rgba(34, 197, 94, 0.8)',
                            glow: 'rgba(34, 197, 94, 0.6)'
                        },
                        {
                            primary: 'rgba(239, 68, 68, 0.9)',
                            secondary: 'rgba(220, 38, 38, 0.9)',
                            hover: 'rgba(239, 68, 68, 1)',
                            hoverSecondary: 'rgba(220, 38, 38, 1)',
                            border: 'rgba(239, 68, 68, 0.8)',
                            glow: 'rgba(239, 68, 68, 0.6)'
                        },
                        {
                            primary: 'rgba(245, 158, 11, 0.9)',
                            secondary: 'rgba(217, 119, 6, 0.9)',
                            hover: 'rgba(245, 158, 11, 1)',
                            hoverSecondary: 'rgba(217, 119, 6, 1)',
                            border: 'rgba(245, 158, 11, 0.8)',
                            glow: 'rgba(245, 158, 11, 0.6)'
                        },
                        {
                            primary: 'rgba(34, 197, 94, 0.9)',
                            secondary: 'rgba(22, 163, 74, 0.9)',
                            hover: 'rgba(34, 197, 94, 1)',
                            hoverSecondary: 'rgba(22, 163, 74, 1)',
                            border: 'rgba(34, 197, 94, 0.8)',
                            glow: 'rgba(34, 197, 94, 0.6)'
                        }
                    ],
                    5: [
                        {
                            primary: 'rgba(239, 68, 68, 0.9)',
                            secondary: 'rgba(220, 38, 38, 0.9)',
                            hover: 'rgba(239, 68, 68, 1)',
                            hoverSecondary: 'rgba(220, 38, 38, 1)',
                            border: 'rgba(239, 68, 68, 0.8)',
                            glow: 'rgba(239, 68, 68, 0.6)'
                        },
                        {
                            primary: 'rgba(245, 158, 11, 0.9)',
                            secondary: 'rgba(217, 119, 6, 0.9)',
                            hover: 'rgba(245, 158, 11, 1)',
                            hoverSecondary: 'rgba(217, 119, 6, 1)',
                            border: 'rgba(245, 158, 11, 0.8)',
                            glow: 'rgba(245, 158, 11, 0.6)'
                        },
                        {
                            primary: 'rgba(34, 197, 94, 0.9)',
                            secondary: 'rgba(22, 163, 74, 0.9)',
                            hover: 'rgba(34, 197, 94, 1)',
                            hoverSecondary: 'rgba(22, 163, 74, 1)',
                            border: 'rgba(34, 197, 94, 0.8)',
                            glow: 'rgba(34, 197, 94, 0.6)'
                        },
                        {
                            primary: 'rgba(239, 68, 68, 0.9)',
                            secondary: 'rgba(220, 38, 38, 0.9)',
                            hover: 'rgba(239, 68, 68, 1)',
                            hoverSecondary: 'rgba(220, 38, 38, 1)',
                            border: 'rgba(239, 68, 68, 0.8)',
                            glow: 'rgba(239, 68, 68, 0.6)'
                        },
                        {
                            primary: 'rgba(245, 158, 11, 0.9)',
                            secondary: 'rgba(217, 119, 6, 0.9)',
                            hover: 'rgba(245, 158, 11, 1)',
                            hoverSecondary: 'rgba(217, 119, 6, 1)',
                            border: 'rgba(245, 158, 11, 0.8)',
                            glow: 'rgba(245, 158, 11, 0.6)'
                        }
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

            function createPolygonBackground(container, sides) {
                const existingStyle = document.getElementById('polygon-style');
                if (existingStyle) {
                    existingStyle.remove();
                }

                const style = document.createElement('style');
                style.id = 'polygon-style';

                const points = calculatePolygonPoints(sides, 50, 45);
                const clipPath = points.map(p => `${p.x}% ${p.y}%`).join(', ');

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

            function getPolygonName(sides) {
                const names = {
                    3: locale === 'ar' ? 'مثلث' : 'triangle',
                    4: locale === 'ar' ? 'مربع' : 'carré',
                    5: locale === 'ar' ? 'خماسي' : 'pentagone',
                    6: locale === 'ar' ? 'سداسي' : 'hexagone',
                    7: locale === 'ar' ? 'سباعي' : 'heptagone',
                    8: locale === 'ar' ? 'ثماني' : 'octogone',
                    9: locale === 'ar' ? 'تساعي' : 'ennéagone',
                    10: locale === 'ar' ? 'عشاري' : 'décagone'
                };
                return names[sides] || (locale === 'ar' ? `متعدد الأضلاع ب${sides} أضلاع` : `polygone à ${sides} côtés`);
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
                    pauseIndicator.textContent = locale === 'ar' ? 'الرسوم المتحركة متوقفة' : 'Animation Pausée';
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
                            const wilayaCode = feature.properties.id.replace('MR', '');
                            const wilayaStats = wilayasData.find(w => w.code === wilayaCode);

                            console.log(`Matching wilaya: ${feature.properties.name}, Code: ${wilayaCode}, Found: ${wilayaStats ? wilayaStats.nom_ar : 'Not found'}`);

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
                            const wilayaCode = feature.properties.id.replace('MR', '');
                            const wilayaStats = wilayasData.find(w => w.code === wilayaCode);
                            const wilayaName = locale === 'ar' ?
                                (wilayaStats?.nom_ar || feature.properties.name) :
                                feature.properties.name;

                            console.log(`Wilaya Label: ${wilayaName}, Code: ${wilayaCode}`);

                            L.tooltip({
                                permanent: true,
                                direction: locale === 'ar' ? 'right' : 'center',
                                className: 'wilaya-label'
                            })
                                .setContent(wilayaName)
                                .setLatLng(center)
                                .addTo(map);

                            layer.on('click', function(e) {
                                clearInterval(animationInterval);
                                currentLayerIndex = allLayers.indexOf(layer);
                                highlightWilaya(layer);
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
                            <h4>${locale === 'ar' ? 'نسبة المشاركة' : 'Taux de Participation'}</h4>
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
