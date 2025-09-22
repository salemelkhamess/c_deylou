@extends('fronts.base')

@section('styles')
    <style>
        .event-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            transition: all 0.3s ease;
            height: 100%;
        }

        .event-card:hover {
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.15);
            transform: translateY(-4px);
        }

        .event-image-container {
            width: 100%;
            height: 300px; /* fixe la hauteur */
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .event-image-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; /* affiche totalement */
        }

        .event-date {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(15, 23, 42, 0.9);
            color: #fff;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
        }

        .event-content {
            padding: 20px;
        }

        .event-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 12px;
            color: #0f172a;
        }

        .event-description {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .event-btn {
            display: inline-block;
            background: #3b82f6;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .event-btn:hover {
            background: #2563eb;
        }
    </style>
@endsection

@section('content')
    @php $locale = app()->getLocale(); @endphp

    <div class="container py-5">

        <!-- Titre -->
        <div class="text-center mb-5">
            <h1 class="fw-bold">
                Les Evenements de la Moughataa   de     {{ $locale == 'ar' ? $moughataa->nom_ar : ($locale == 'en' ? $moughataa->nom_en : $moughataa->nom_fr) }}
            </h1>
            <p class="text-muted">
                {{ __('messages.population') }} :
                {{ number_format($moughataa->population, 0, ',', ' ') }} {{ __('messages.inhabitants') }}
            </p>
        </div>

        <!-- Liste des événements -->
        <div class="row g-4">
            @forelse($moughataa->evenements as $event)
                @php
                    $titre = $locale == 'ar' ? $event->titre_ar : ($locale == 'en' ? $event->titre_en : $event->titre);
                    $description = $locale == 'ar' ? $event->description_ar : ($locale == 'en' ? $event->description_en : $event->description);
                @endphp

                <div class="col-md-6">
                    <div class="event-card position-relative h-100">
                        <!-- Image -->
                        <div class="event-image-container">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}"
                                     alt="{{ $titre }}"
                                     onerror="this.style.display='none'">
                            @else
                                <i class="fas fa-calendar-alt fa-3x text-muted"></i>
                            @endif
                        </div>

                        <!-- Date -->
                        <div class="event-date">
                            <i class="far fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($event->date_evenement)->translatedFormat('d M Y') }}
                        </div>

                        <!-- Contenu -->
                        <div class="event-content">
                            <h3 class="event-title">{{ $titre }}</h3>
                            <p class="event-description">{{ Str::limit($description, 140) }}</p>
                            <a href="{{ route('evenements.show', $event->id) }}" class="event-btn">
                                {{ __('messages.view_detail') }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center p-5 border rounded">
                        <i class="far fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h4>Aucun événement</h4>
                        <p class="text-muted">{{ __('messages.no_events') }}</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
