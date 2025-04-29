@extends('fronts.base')

@section('styles')
    <style>
        .event-card {
            transition: all 0.4s ease;
            border-radius: 15px;
            overflow: hidden;
            border: none;
            background-color: #f9fafb;
        }
        .event-card:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        .event-img {
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .btn-detail {
            background-color: #cfc3db;
            color: white;
            border-radius: 20px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            padding: 8px 20px;
        }
        .btn-detail:hover {
            background-color: #cfc3db;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            padding: 15px;
        }
        .event-date {
            font-size: 0.9rem;
            color: #6b7280;
        }
        .event-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1f2937;
        }
        .event-description {
            font-size: 0.95rem;
            color: #4b5563;
            margin-bottom: 15px;
        }
        .event-card-footer {
            margin-top: auto;
            text-align: center;
        }
        .event-card-footer a {
            text-decoration: none;
        }
        .pagination .page-item.active .page-link {
            background-color: #cfc3db;
            border-color: #cfc3db;
        }
        .pagination .page-link {
            color: #cfc3db;
            border: none;
            font-weight: bold;
        }

        .event-header {
            background-color: #cfc3db;
            color: white;
            padding: 40px 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .event-header h3 {
            font-weight: bold;
            font-size: 2rem;
        }
        .event-header p {
            font-size: 1.1rem;
            margin-top: 10px;
        }

        /* Pour la section des événements */
        .event-card {
            transition: transform 0.3s;
        }
        .event-card:hover {
            transform: scale(1.03);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
        .event-img {
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .btn-detail {
            background-color: #cfc3db;
            color: white;
            border-radius: 20px;
            transition: background-color 0.3s ease;
        }
        .btn-detail:hover {
            background-color: #cfc3db;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5" style="margin-top: 80px;">
        <!-- En-tête sous le carrousel -->
        <div class="event-header mb-4">
            <h3>{{ __('messages.events_header') }}</h3>
            <p>{{ __('messages.events_subheader') }}</p>
        </div>

        <div class="row g-4">
            @foreach($evenements as $event)
                @php
                    $locale = app()->getLocale();
                    $titre = $locale == 'ar' ? $event->titre_ar : ($locale == 'en' ? $event->titre_en : $event->titre);
                    $description = $locale == 'ar' ? $event->description_ar : ($locale == 'en' ? $event->description_en : $event->description);
                @endphp

                <div class="col-md-4" data-aos="fade-up">
                    <div class="card event-card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $event->image) }}" class="event-img" alt="{{ $titre }}">
                        <div class="card-body">
                            <p class="event-date">{{ \Carbon\Carbon::parse($event->date)->format('d M, Y') }}</p>
                            <h5 class="event-title">{{ $titre }}</h5>
                            <p class="event-description">{{ Str::limit($description, 120) }}</p>
                            <div class="event-card-footer">
                                <a href="{{ route('evenements.show', $event->id) }}" class="btn btn-detail btn-sm">{{ __('messages.view_detail') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $evenements->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
